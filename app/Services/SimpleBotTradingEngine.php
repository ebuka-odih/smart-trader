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
            // Check yield target first
            if ($this->shouldStopForYieldTarget($bot)) {
                Log::info("Bot {$bot->id} stopping due to yield target reached");
                $bot->update(['status' => 'stopped']);
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

    private function executeGridStrategy(BotTrading $bot, $currentPrice)
    {
        // Simple grid: Buy when price drops 2%, Sell when price rises 2%
        $lastTrade = $bot->trades()->latest()->first();
        
        if (!$lastTrade) {
            // First trade - buy
            return $this->createTrade($bot, 'buy', $currentPrice, $bot->min_trade_amount);
        }
        
        $priceChange = (($currentPrice - $lastTrade->price) / $lastTrade->price) * 100;
        
        if ($priceChange <= -2 && $lastTrade->type === 'sell') {
            // Price dropped 2% after selling - buy
            return $this->createTrade($bot, 'buy', $currentPrice, $bot->min_trade_amount);
        } elseif ($priceChange >= 2 && $lastTrade->type === 'buy') {
            // Price rose 2% after buying - sell
            return $this->createTrade($bot, 'sell', $currentPrice, $bot->min_trade_amount);
        }
        
        return null; // No trade
    }

    private function executeDCAStrategy(BotTrading $bot, $currentPrice)
    {
        // Simple DCA: Buy every 24 hours
        $lastTrade = $bot->trades()->latest()->first();
        
        if (!$lastTrade || $lastTrade->created_at->diffInHours(now()) >= 24) {
            return $this->createTrade($bot, 'buy', $currentPrice, $bot->min_trade_amount);
        }
        
        return null; // No trade
    }

    private function executeScalpingStrategy(BotTrading $bot, $currentPrice)
    {
        // Simple scalping: Buy on small dips, sell on small gains
        $lastTrade = $bot->trades()->latest()->first();
        
        if (!$lastTrade) {
            return $this->createTrade($bot, 'buy', $currentPrice, $bot->min_trade_amount);
        }
        
        $priceChange = (($currentPrice - $lastTrade->price) / $lastTrade->price) * 100;
        
        if ($lastTrade->type === 'buy' && $priceChange >= 1) {
            // 1% gain - sell
            return $this->createTrade($bot, 'sell', $currentPrice, $bot->min_trade_amount);
        } elseif ($lastTrade->type === 'sell' && $priceChange <= -0.5) {
            // 0.5% dip - buy
            return $this->createTrade($bot, 'buy', $currentPrice, $bot->min_trade_amount);
        }
        
        return null; // No trade
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
        
        // Check max open trades (simplified)
        $recentTrades = $bot->trades()->where('created_at', '>=', now()->subMinutes(5))->count();
        if ($recentTrades >= 3) { // Max 3 trades per 5 minutes
            return false;
        }
        
        // Check investment limit
        $totalInvested = $bot->trades()->where('type', 'buy')->sum('quote_amount');
        if ($totalInvested + $amount > $bot->max_investment) {
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
}
