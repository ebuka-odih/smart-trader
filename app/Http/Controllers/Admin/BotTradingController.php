<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BotTrading;
use App\Models\BotTrade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BotTradingController extends Controller
{
    /**
     * Display a listing of all bots
     */
    public function index()
    {
        $bots = BotTrading::with(['user', 'trades'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'total_bots' => BotTrading::count(),
            'active_bots' => BotTrading::where('status', 'active')->count(),
            'paused_bots' => BotTrading::where('status', 'paused')->count(),
            'stopped_bots' => BotTrading::where('status', 'stopped')->count(),
            'total_profit' => BotTrading::sum('total_profit'),
            'total_invested' => BotTrading::sum('total_invested'),
            'total_trades' => BotTrade::count(),
        ];

        return view('admin.bot-trading.index', compact('bots', 'stats'));
    }

    /**
     * Display the specified bot
     */
    public function show(BotTrading $bot)
    {
        $bot->load(['user', 'trades' => function($query) {
            $query->latest()->limit(50);
        }]);

        $recentTrades = $bot->trades()->latest()->limit(20)->get();
        
        // Get current asset price
        $asset = \App\Models\Asset::where('symbol', $bot->base_asset)->first();
        
        // Calculate additional stats
        $stats = [
            'total_trades' => $bot->trades()->count(),
            'buy_trades' => $bot->trades()->where('type', 'buy')->count(),
            'sell_trades' => $bot->trades()->where('type', 'sell')->count(),
            'profitable_trades' => $bot->trades()->where('profit_loss', '>', 0)->count(),
            'loss_trades' => $bot->trades()->where('profit_loss', '<', 0)->count(),
            'avg_trade_amount' => $bot->trades()->avg('quote_amount'),
            'largest_profit' => $bot->trades()->max('profit_loss'),
            'largest_loss' => $bot->trades()->min('profit_loss'),
        ];

        return view('admin.bot-trading.show', compact('bot', 'recentTrades', 'asset', 'stats'));
    }

    /**
     * Show the form for editing the specified bot
     */
    public function edit(BotTrading $bot)
    {
        $bot->load('user');
        return view('admin.bot-trading.edit', compact('bot'));
    }

    /**
     * Update the specified bot
     */
    public function update(Request $request, BotTrading $bot)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,paused,stopped',
            'leverage' => 'required|numeric|min:1.00|max:100.00',
            'trade_duration' => 'required|string|in:1h,4h,24h,1w,1m',
            'target_yield_percentage' => 'nullable|numeric|min:0.1|max:100',
            'auto_close' => 'nullable',
            'max_investment' => 'required|numeric|min:10|max:1000000',
            'min_trade_amount' => 'required|numeric|min:1',
            'max_trade_amount' => 'required|numeric|min:1|gte:min_trade_amount',
            'max_open_trades' => 'required|integer|min:1|max:50',
            'stop_loss_percentage' => 'nullable|numeric|min:0.1|max:50',
            'take_profit_percentage' => 'nullable|numeric|min:0.1|max:1000',
            'daily_loss_limit' => 'nullable|numeric|min:1',
            'trading_24_7' => 'nullable',
            'auto_restart' => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $bot->update([
                'name' => $request->name,
                'status' => $request->status,
                'leverage' => $request->leverage,
                'trade_duration' => $request->trade_duration,
                'target_yield_percentage' => $request->target_yield_percentage,
                'auto_close' => $request->boolean('auto_close', true),
                'max_investment' => $request->max_investment,
                'min_trade_amount' => $request->min_trade_amount,
                'max_trade_amount' => $request->max_trade_amount,
                'max_open_trades' => $request->max_open_trades,
                'stop_loss_percentage' => $request->stop_loss_percentage,
                'take_profit_percentage' => $request->take_profit_percentage,
                'daily_loss_limit' => $request->daily_loss_limit,
                'trading_24_7' => $request->boolean('trading_24_7', true),
                'auto_restart' => $request->boolean('auto_restart', false),
            ]);

            // Update timestamps based on status
            if ($request->status === 'active' && $bot->status !== 'active') {
                $bot->update(['started_at' => now()]);
            } elseif ($request->status === 'stopped' && $bot->status !== 'stopped') {
                $bot->update(['stopped_at' => now()]);
            }

            Log::info("Admin updated bot {$bot->id} by user " . auth()->id());

            return redirect()->route('admin.bot-trading.show', $bot)
                ->with('success', 'Bot updated successfully!');
        } catch (\Exception $e) {
            Log::error("Admin bot update failed: " . $e->getMessage());
            return back()->with('error', 'Failed to update bot: ' . $e->getMessage());
        }
    }

    /**
     * Stop the specified bot
     */
    public function stop(BotTrading $bot)
    {
        try {
            $bot->update([
                'status' => 'stopped',
                'stopped_at' => now()
            ]);

            Log::info("Admin stopped bot {$bot->id} by user " . auth()->id());

            return response()->json([
                'success' => true,
                'message' => 'Bot stopped successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error("Admin bot stop failed: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to stop bot: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Edit PnL for a specific bot
     */
    public function editPnl(Request $request, BotTrading $bot)
    {
        $validator = Validator::make($request->all(), [
            'total_profit' => 'required|numeric',
            'total_invested' => 'required|numeric|min:0',
            'successful_trades' => 'required|integer|min:0',
            'success_rate' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $bot->update([
                'total_profit' => $request->total_profit,
                'total_invested' => $request->total_invested,
                'successful_trades' => $request->successful_trades,
                'success_rate' => $request->success_rate,
            ]);

            Log::info("Admin updated PnL for bot {$bot->id} by user " . auth()->id(), [
                'old_profit' => $bot->getOriginal('total_profit'),
                'new_profit' => $request->total_profit,
                'old_invested' => $bot->getOriginal('total_invested'),
                'new_invested' => $request->total_invested,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'PnL updated successfully!',
                'bot' => $bot->fresh()
            ]);
        } catch (\Exception $e) {
            Log::error("Admin PnL update failed: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update PnL: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Edit PnL for a specific trade
     */
    public function editTradePnl(Request $request, BotTrade $trade)
    {
        $validator = Validator::make($request->all(), [
            'profit_loss' => 'required|numeric',
            'profit_loss_percentage' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $oldProfit = $trade->profit_loss;
            
            $trade->update([
                'profit_loss' => $request->profit_loss,
                'profit_loss_percentage' => $request->profit_loss_percentage,
            ]);

            // Update bot's total profit
            $bot = $trade->bot;
            $profitDifference = $request->profit_loss - $oldProfit;
            $bot->increment('total_profit', $profitDifference);

            Log::info("Admin updated trade PnL for trade {$trade->id} by user " . auth()->id(), [
                'old_profit' => $oldProfit,
                'new_profit' => $request->profit_loss,
                'difference' => $profitDifference,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Trade PnL updated successfully!',
                'trade' => $trade->fresh(),
                'bot' => $bot->fresh()
            ]);
        } catch (\Exception $e) {
            Log::error("Admin trade PnL update failed: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update trade PnL: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified bot
     */
    public function destroy(BotTrading $bot)
    {
        try {
            // Delete all associated trades first
            $bot->trades()->delete();
            
            // Delete the bot
            $bot->delete();

            Log::info("Admin deleted bot {$bot->id} by user " . auth()->id());

            return response()->json([
                'success' => true,
                'message' => 'Bot deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error("Admin bot deletion failed: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete bot: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get bot statistics for dashboard
     */
    public function stats()
    {
        $stats = [
            'total_bots' => BotTrading::count(),
            'active_bots' => BotTrading::where('status', 'active')->count(),
            'paused_bots' => BotTrading::where('status', 'paused')->count(),
            'stopped_bots' => BotTrading::where('status', 'stopped')->count(),
            'total_profit' => BotTrading::sum('total_profit'),
            'total_invested' => BotTrading::sum('total_invested'),
            'total_trades' => BotTrade::count(),
            'profitable_trades' => BotTrade::where('profit_loss', '>', 0)->count(),
            'loss_trades' => BotTrade::where('profit_loss', '<', 0)->count(),
        ];

        return response()->json($stats);
    }
}
