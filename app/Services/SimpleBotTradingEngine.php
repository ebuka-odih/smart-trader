<?php

namespace App\Services;

use App\Models\BotTrading;
use App\Models\BotTrade;
use Illuminate\Support\Facades\Log;

class SimpleBotTradingEngine
{
    protected $assetPriceService;

    public function __construct()
    {
        $this->assetPriceService = new AssetPriceService();
    }

    public function executeBot(BotTrading $bot)
    {
        try {
            // Check if bot should be active based on trading hours
            if (!$this->isWithinTradingHours($bot)) {
                Log::info("Bot {$bot->id} outside trading hours");
                return null;
            }
            
            // Check yield target first
            if ($this->shouldStopForYieldTarget($bot)) {
                Log::info("Bot {$bot->id} stopping due to yield target reached");
                $bot->update(['status' => 'stopped']);
                return null;
            }
            
            // Check daily loss limit
            if ($this->hasReachedDailyLossLimit($bot)) {
                Log::info("Bot {$bot->id} stopping due to daily loss limit reached");
                $bot->update(['status' => 'paused']);
                return null;
            }
            
            // Check if trades should be closed based on duration
            $this->closeExpiredTrades($bot);
            
            // Get current price from existing AssetPriceService
            $currentPrice = $this->getCurrentPrice($bot->base_asset);
            
            if ($currentPrice <= 0) {
                Log::warning("Invalid price for bot {$bot->id}: {$currentPrice}");
                return null;
            }

            // Check if we should close existing trades based on stop loss/take profit
            $this->checkStopLossAndTakeProfit($bot, $currentPrice);

            // Simple logic based on strategy
            switch ($bot->strategy) {
                case 'grid':
                    return $this->executeGridStrategy($bot, $currentPrice);
                case 'dca':
                    return $this->executeDCAStrategy($bot, $currentPrice);
                case 'scalping':
                    return $this->executeScalpingStrategy($bot, $currentPrice);
                case 'trend_following':
                    return $this->executeTrendStrategy($bot, $currentPrice);
                default:
                    Log::warning("Unknown strategy for bot {$bot->id}: {$bot->strategy}");
                    return null;
            }
        } catch (\Exception $e) {
            Log::error("Bot execution failed for bot {$bot->id}: " . $e->getMessage());
            return null;
        }
    }

    private function getCurrentPrice($asset)
    {
        try {
            // Get price from Asset model
            $assetModel = \App\Models\Asset::where('symbol', $asset)->first();
            return $assetModel ? $assetModel->current_price : 0;
        } catch (\Exception $e) {
            Log::error("Failed to get price for {$asset}: " . $e->getMessage());
            return 0;
        }
    }







    private function executeTrendStrategy(BotTrading $bot, $currentPrice)
    {
        // Simple trend: Look at last 3 price points
        $recentTrades = $bot->trades()->latest()->limit(3)->get();
        
        if ($recentTrades->count() < 2) {
            return $this->createTrade($bot, 'buy', $currentPrice, $bot->min_trade_amount);
        }
        
        // Simple trend detection
        $prices = $recentTrades->pluck('price')->toArray();
        $trend = $prices[0] > $prices[1] ? 'up' : 'down';
        
        $lastTrade = $recentTrades->first();
        
        if ($trend === 'up' && $lastTrade->type === 'sell') {
            return $this->createTrade($bot, 'buy', $currentPrice, $bot->min_trade_amount);
        } elseif ($trend === 'down' && $lastTrade->type === 'buy') {
            return $this->createTrade($bot, 'sell', $currentPrice, $bot->min_trade_amount);
        }
        
        return null; // No trade
    }

    private function createTrade(BotTrading $bot, $type, $price, $usdAmount)
    {
        // Basic validation
        if (!$this->canTrade($bot, $usdAmount)) {
            return null;
        }
        
        // Apply leverage to position size
        $leveragedAmount = $usdAmount * $bot->leverage;
        $baseAmount = $leveragedAmount / $price;
        
        // Create trade
        $trade = BotTrade::create([
            'bot_trading_id' => $bot->id,
            'user_id' => $bot->user_id,
            'trade_id' => 'TRADE_' . time() . '_' . rand(1000, 9999),
            'type' => $type,
            'base_asset' => $bot->base_asset,
            'quote_asset' => $bot->quote_asset,
            'base_amount' => $baseAmount,
            'quote_amount' => $usdAmount, // This is the USD amount (margin required)
            'price' => $price,
            'status' => 'executed', // Always executed for simplicity
            'execution_type' => 'market',
            'executed_at' => now(),
        ]);
        
        // Update bot stats
        $this->updateBotStats($bot, $trade);
        
        Log::info("Trade created for bot {$bot->id}: {$type} \${$usdAmount} worth of {$baseAmount} {$bot->base_asset} at \${$price} (Leverage: {$bot->leverage}x)");
        
        return $trade;
    }

    private function canTrade(BotTrading $bot, $amount)
    {
        // Check if bot is active
        if ($bot->status !== 'active') {
            return false;
        }
        
        // Check if within trading hours
        if (!$this->isWithinTradingHours($bot)) {
            return false;
        }
        
        // Check max open trades based on bot configuration
        $maxOpenTrades = $bot->max_open_trades ?? 3;
        $openTrades = $bot->trades()->where('status', 'executed')->count();
        if ($openTrades >= $maxOpenTrades) {
            return false;
        }
        
        // Check recent trade frequency to prevent overtrading
        $recentTrades = $bot->trades()->where('created_at', '>=', now()->subMinutes(5))->count();
        $maxTradesPerPeriod = $bot->getStrategyConfig('max_trades_per_period') ?? 2;
        if ($recentTrades >= $maxTradesPerPeriod) {
            return false;
        }
        
        // Check investment limit
        $totalInvested = $bot->trades()->where('type', 'buy')->sum('quote_amount');
        if ($totalInvested + $amount > $bot->max_investment) {
            return false;
        }
        
        // Check if amount is within min/max trade limits
        if ($amount < $bot->min_trade_amount || $amount > $bot->max_trade_amount) {
            return false;
        }
        
        // Check if we have enough available investment
        $availableInvestment = $bot->getAvailableInvestmentAttribute();
        if ($amount > $availableInvestment) {
            return false;
        }
        
        return true;
    }

    private function updateBotStats(BotTrading $bot, BotTrade $trade)
    {
        // Update basic stats
        $bot->increment('total_trades');
        $bot->update(['last_trade_at' => now()]);
        
        // Calculate profit/loss if it's a sell trade
        if ($trade->type === 'sell') {
            $buyTrade = $bot->trades()
                ->where('type', 'buy')
                ->where('id', '<', $trade->id)
                ->latest()
                ->first();
                
            if ($buyTrade) {
                $profit = ($trade->price - $buyTrade->price) * $trade->base_amount;
                $profitPercentage = (($trade->price - $buyTrade->price) / $buyTrade->price) * 100;
                
                $trade->update([
                    'profit_loss' => $profit,
                    'profit_loss_percentage' => $profitPercentage
                ]);
                
                $bot->increment('total_profit', $profit);
                
                // Update success rate
                $successfulTrades = $bot->trades()->where('profit_loss', '>', 0)->count();
                $totalCompletedTrades = $bot->trades()->where('type', 'sell')->count();
                $successRate = $totalCompletedTrades > 0 ? ($successfulTrades / $totalCompletedTrades) * 100 : 0;
                
                $bot->update([
                    'successful_trades' => $successfulTrades,
                    'success_rate' => $successRate
                ]);
            }
        }
        
        // Update total invested
        $totalInvested = $bot->trades()->where('type', 'buy')->sum('quote_amount');
        $bot->update(['total_invested' => $totalInvested]);
    }

    /**
     * Check if bot should stop due to yield target reached
     */
    private function shouldStopForYieldTarget(BotTrading $bot)
    {
        if (!$bot->target_yield_percentage) {
            return false;
        }

        $currentYield = $this->calculateCurrentYield($bot);
        
        if ($currentYield >= $bot->target_yield_percentage) {
            // Transfer profits to user's trading balance before stopping
            $this->transferBotProfitsToUser($bot);
            return true;
        }
        
        return false;
    }

    /**
     * Calculate current yield percentage for the bot
     */
    private function calculateCurrentYield(BotTrading $bot)
    {
        $totalProfit = $bot->total_profit;
        $totalInvested = $bot->total_invested;
        
        if ($totalInvested > 0) {
            return ($totalProfit / $totalInvested) * 100;
        }
        
        return 0;
    }

    /**
     * Transfer bot profits to user's trading balance
     */
    private function transferBotProfitsToUser(BotTrading $bot)
    {
        try {
            if ($bot->total_profit > 0) {
                $user = $bot->user;
                $user->increment('trading_balance', $bot->total_profit);
                
                Log::info("Bot profits transferred to user", [
                    'bot_id' => $bot->id,
                    'user_id' => $user->id,
                    'profit_transferred' => $bot->total_profit,
                    'new_trading_balance' => $user->fresh()->trading_balance
                ]);
            }
        } catch (\Exception $e) {
            Log::error("Failed to transfer bot profits to user: " . $e->getMessage(), [
                'bot_id' => $bot->id,
                'user_id' => $bot->user_id,
                'profit_amount' => $bot->total_profit
            ]);
        }
    }

    /**
     * Close trades that have exceeded their duration
     */
    private function closeExpiredTrades(BotTrading $bot)
    {
        if (!$bot->auto_close) {
            return;
        }
        
        $duration = $this->parseDuration($bot->trade_duration);
        $expiredTrades = $bot->trades()
            ->where('status', 'executed')
            ->where('created_at', '<=', now()->subSeconds($duration))
            ->get();
            
        foreach ($expiredTrades as $trade) {
            if ($trade->type === 'buy') {
                // Auto-sell expired buy trades
                $this->createTrade($bot, 'sell', $this->getCurrentPrice($bot->base_asset), $trade->quote_amount);
            }
            // Mark as closed
            $trade->update(['status' => 'closed']);
        }
    }

    /**
     * Parse duration string to seconds
     */
    private function parseDuration($duration)
    {
        switch ($duration) {
            case '1h':
                return 3600; // 1 hour
            case '4h':
                return 14400; // 4 hours
            case '24h':
                return 86400; // 24 hours
            case '1w':
                return 604800; // 1 week
            case '1m':
                return 2592000; // 1 month (30 days)
            default:
                return 86400; // Default to 24 hours
        }
    }

    /**
     * Check if bot is within trading hours
     */
    private function isWithinTradingHours(BotTrading $bot)
    {
        if ($bot->trading_24_7) {
            return true;
        }

        $now = now();
        $currentTime = $now->format('H:i:s');
        $currentDay = $now->format('l'); // Monday, Tuesday, etc.

        // Check if current day is in trading days
        if (!in_array(strtolower($currentDay), array_map('strtolower', $bot->trading_days ?? []))) {
            return false;
        }

        // Check if current time is within trading hours
        if ($bot->trading_start_time && $bot->trading_end_time) {
            return $currentTime >= $bot->trading_start_time && $currentTime <= $bot->trading_end_time;
        }

        return true;
    }

    /**
     * Check if bot has reached daily loss limit
     */
    private function hasReachedDailyLossLimit(BotTrading $bot)
    {
        if (!$bot->daily_loss_limit) {
            return false;
        }

        $todayStart = now()->startOfDay();
        $todayLosses = $bot->trades()
            ->where('created_at', '>=', $todayStart)
            ->where('profit_loss', '<', 0)
            ->sum('profit_loss');

        return abs($todayLosses) >= $bot->daily_loss_limit;
    }

    /**
     * Check and execute stop loss and take profit
     */
    private function checkStopLossAndTakeProfit(BotTrading $bot, $currentPrice)
    {
        $openTrades = $bot->trades()
            ->where('status', 'executed')
            ->where('type', 'buy')
            ->get();

        foreach ($openTrades as $trade) {
            $entryPrice = $trade->price;
            $priceChange = (($currentPrice - $entryPrice) / $entryPrice) * 100;

            // Check stop loss
            if ($bot->stop_loss_percentage && $priceChange <= -$bot->stop_loss_percentage) {
                Log::info("Stop loss triggered for bot {$bot->id} trade {$trade->id}");
                $this->createTrade($bot, 'sell', $currentPrice, $trade->quote_amount);
                $trade->update(['status' => 'closed', 'close_reason' => 'stop_loss']);
                continue;
            }

            // Check take profit
            if ($bot->take_profit_percentage && $priceChange >= $bot->take_profit_percentage) {
                Log::info("Take profit triggered for bot {$bot->id} trade {$trade->id}");
                $this->createTrade($bot, 'sell', $currentPrice, $trade->quote_amount);
                $trade->update(['status' => 'closed', 'close_reason' => 'take_profit']);
                continue;
            }
        }
    }

    /**
     * Enhanced grid strategy with dynamic grid levels
     */
    private function executeGridStrategy(BotTrading $bot, $currentPrice)
    {
        $lastTrade = $bot->trades()->latest()->first();
        
        if (!$lastTrade) {
            // First trade - buy
            return $this->createTrade($bot, 'buy', $currentPrice, $bot->min_trade_amount);
        }
        
        // Get grid configuration from strategy config
        $gridSpacing = $bot->getStrategyConfig('grid_spacing') ?? 2; // Default 2%
        $gridLevels = $bot->getStrategyConfig('grid_levels') ?? 5; // Default 5 levels
        
        $priceChange = (($currentPrice - $lastTrade->price) / $lastTrade->price) * 100;
        
        // Count current grid positions
        $currentPositions = $bot->trades()->where('status', 'executed')->count();
        
        if ($priceChange <= -$gridSpacing && $lastTrade->type === 'sell' && $currentPositions < $gridLevels) {
            // Price dropped - buy at lower level
            return $this->createTrade($bot, 'buy', $currentPrice, $bot->min_trade_amount);
        } elseif ($priceChange >= $gridSpacing && $lastTrade->type === 'buy') {
            // Price rose - sell at higher level
            return $this->createTrade($bot, 'sell', $currentPrice, $bot->min_trade_amount);
        }
        
        return null; // No trade
    }

    /**
     * Enhanced DCA strategy with dynamic amounts
     */
    private function executeDCAStrategy(BotTrading $bot, $currentPrice)
    {
        $lastTrade = $bot->trades()->latest()->first();
        
        if (!$lastTrade || $lastTrade->created_at->diffInHours(now()) >= 24) {
            // Calculate DCA amount based on strategy config
            $dcaMultiplier = $bot->getStrategyConfig('dca_multiplier') ?? 1.5; // Increase amount by 50%
            $baseAmount = $bot->min_trade_amount;
            
            // If we have previous trades, increase the amount
            $previousTrades = $bot->trades()->where('type', 'buy')->count();
            $dcaAmount = $baseAmount * pow($dcaMultiplier, $previousTrades);
            
            // Cap at max trade amount
            $dcaAmount = min($dcaAmount, $bot->max_trade_amount);
            
            return $this->createTrade($bot, 'buy', $currentPrice, $dcaAmount);
        }
        
        return null; // No trade
    }

    /**
     * Enhanced scalping strategy with dynamic thresholds
     */
    private function executeScalpingStrategy(BotTrading $bot, $currentPrice)
    {
        $lastTrade = $bot->trades()->latest()->first();
        
        if (!$lastTrade) {
            return $this->createTrade($bot, 'buy', $currentPrice, $bot->min_trade_amount);
        }
        
        // Get scalping configuration
        $buyThreshold = $bot->getStrategyConfig('buy_threshold') ?? 0.5; // Buy on 0.5% dip
        $sellThreshold = $bot->getStrategyConfig('sell_threshold') ?? 1.0; // Sell on 1% gain
        
        $priceChange = (($currentPrice - $lastTrade->price) / $lastTrade->price) * 100;
        
        if ($lastTrade->type === 'buy' && $priceChange >= $sellThreshold) {
            // Take profit
            return $this->createTrade($bot, 'sell', $currentPrice, $bot->min_trade_amount);
        } elseif ($lastTrade->type === 'sell' && $priceChange <= -$buyThreshold) {
            // Buy the dip
            return $this->createTrade($bot, 'buy', $currentPrice, $bot->min_trade_amount);
        }
        
        return null; // No trade
    }

    /**
     * Enhanced trend following strategy with technical indicators
     */
    private function executeTrendStrategy(BotTrading $bot, $currentPrice)
    {
        $recentTrades = $bot->trades()->latest()->limit(5)->get();
        
        if ($recentTrades->count() < 3) {
            return $this->createTrade($bot, 'buy', $currentPrice, $bot->min_trade_amount);
        }
        
        // Get trend configuration
        $trendPeriod = $bot->getStrategyConfig('trend_period') ?? 3; // Look at last 3 trades
        $trendThreshold = $bot->getStrategyConfig('trend_threshold') ?? 1.0; // 1% threshold
        
        // Calculate trend strength
        $prices = $recentTrades->take($trendPeriod)->pluck('price')->reverse()->toArray();
        $trendStrength = 0;
        
        for ($i = 1; $i < count($prices); $i++) {
            $change = (($prices[$i] - $prices[$i-1]) / $prices[$i-1]) * 100;
            $trendStrength += $change;
        }
        
        $avgTrendStrength = $trendStrength / (count($prices) - 1);
        $lastTrade = $recentTrades->first();
        
        // Strong uptrend - buy
        if ($avgTrendStrength > $trendThreshold && $lastTrade->type === 'sell') {
            return $this->createTrade($bot, 'buy', $currentPrice, $bot->min_trade_amount);
        }
        // Strong downtrend - sell
        elseif ($avgTrendStrength < -$trendThreshold && $lastTrade->type === 'buy') {
            return $this->createTrade($bot, 'sell', $currentPrice, $bot->min_trade_amount);
        }
        
        return null; // No trade
    }
}
