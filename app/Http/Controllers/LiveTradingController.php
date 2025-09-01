<?php

namespace App\Http\Controllers;

use App\Models\LiveTrade;
use App\Models\Asset;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LiveTradingController extends Controller
{
    /**
     * Display the live trading dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user's live trades
        $liveTrades = $user->liveTrades()->latest()->get();
        
        // Get available assets for trading
        $cryptoAssets = Asset::where('type', 'crypto')->take(10)->get();
        $stockAssets = Stock::take(10)->get();
        
        // For now, forex assets will be hardcoded (can be replaced with API later)
        $forexAssets = collect([
            ['symbol' => 'EUR/USD', 'name' => 'Euro / US Dollar'],
            ['symbol' => 'GBP/USD', 'name' => 'British Pound / US Dollar'],
            ['symbol' => 'USD/JPY', 'name' => 'US Dollar / Japanese Yen'],
            ['symbol' => 'USD/CHF', 'name' => 'US Dollar / Swiss Franc'],
            ['symbol' => 'AUD/USD', 'name' => 'Australian Dollar / US Dollar'],
            ['symbol' => 'USD/CAD', 'name' => 'US Dollar / Canadian Dollar'],
            ['symbol' => 'NZD/USD', 'name' => 'New Zealand Dollar / US Dollar'],
        ]);
        
        return view('dashboard.live-trading.index', compact(
            'liveTrades',
            'cryptoAssets',
            'stockAssets',
            'forexAssets'
        ));
    }

    /**
     * Place a new live trade
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'asset_type' => 'required|string|in:crypto,stock,forex',
            'symbol' => 'required|string|max:20',
            'order_type' => 'required|string|in:limit,market',
            'side' => 'required|string|in:buy,sell',
            'quantity' => 'nullable|numeric|min:0.00000001',
            'price' => 'nullable|numeric|min:0.00000001',
            'amount' => 'required|numeric|min:1',
            'leverage' => 'nullable|numeric|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        
        // Check if user has sufficient trading balance
        if ($request->amount > $user->trading_balance) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient trading balance. You need at least $' . number_format($request->amount, 2) . ' in your trading balance.'
            ], 400);
        }

        try {
            // For limit orders, validate quantity and price
            if ($request->order_type === 'limit') {
                if (!$request->quantity || !$request->price) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Quantity and price are required for limit orders.'
                    ], 400);
                }
            }

            $liveTrade = LiveTrade::create([
                'user_id' => $user->id,
                'asset_type' => $request->asset_type,
                'symbol' => $request->symbol,
                'order_type' => $request->order_type,
                'side' => $request->side,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'amount' => $request->amount,
                'leverage' => $request->leverage ?? 1.00,
                'status' => 'pending'
            ]);

            // Deduct amount from trading balance
            $user->decrement('trading_balance', $request->amount);

            return response()->json([
                'success' => true,
                'message' => 'Trade order placed successfully!',
                'trade' => $liveTrade
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to place trade: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cancel a live trade
     */
    public function cancel(LiveTrade $liveTrade)
    {
        if ($liveTrade->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access to this trade.'
            ], 403);
        }

        if (!$liveTrade->isPending()) {
            return response()->json([
                'success' => false,
                'message' => 'Only pending trades can be cancelled.'
            ], 400);
        }

        try {
            $liveTrade->update(['status' => 'cancelled']);
            
            // Refund the amount to trading balance
            $user = Auth::user();
            $user->increment('trading_balance', $liveTrade->amount);

            return response()->json([
                'success' => true,
                'message' => 'Trade cancelled successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel trade: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get current price for an asset
     */
    public function getPrice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'asset_type' => 'required|string|in:crypto,stock,forex',
            'symbol' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $price = 0;
            
            if ($request->asset_type === 'crypto') {
                $asset = Asset::where('symbol', $request->symbol)->first();
                $price = $asset ? $asset->current_price : 0;
            } elseif ($request->asset_type === 'stock') {
                $stock = Stock::where('symbol', $request->symbol)->first();
                $price = $stock ? $stock->current_price : 0;
            } elseif ($request->asset_type === 'forex') {
                // For now, return a mock price (can be replaced with forex API)
                $price = rand(100, 200) / 100; // Random price between 1.00 and 2.00
            }

            return response()->json([
                'success' => true,
                'price' => $price,
                'symbol' => $request->symbol,
                'asset_type' => $request->asset_type
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get price: ' . $e->getMessage()
            ], 500);
        }
    }
}
