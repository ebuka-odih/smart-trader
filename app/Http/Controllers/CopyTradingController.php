<?php

namespace App\Http\Controllers;

use App\Models\CopiedTrade;
use App\Models\CopyTrader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CopyTradingController extends Controller
{
    public function index()
    {
        $traders = CopyTrader::all();
        $user = Auth::user();
        $copiedTrades = CopiedTrade::whereUserId(auth()->id())
            ->with('copy_trader')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('dashboard.copy-trade', compact('traders', 'user', 'copiedTrades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'trader_id' => 'required|exists:copy_traders,id',
            'amount' => 'required|numeric|min:1',
        ]);

        try {
            DB::beginTransaction();

            $traderId = $request->trader_id;
            $copyTrader = CopyTrader::findOrFail($traderId);
            $user = Auth::user();

            // Check if user has sufficient balance
            if ($copyTrader->amount > $user->balance) {
                return redirect()->back()->with('error', 'Insufficient balance. You need at least $' . number_format($copyTrader->amount, 2));
            }

            // Check if user is already copying this trader
            $existingCopy = CopiedTrade::where('user_id', $user->id)
                ->where('copy_trader_id', $traderId)
                ->where('status', 1)
                ->first();

            if ($existingCopy) {
                return redirect()->back()->withInput()->with('warning', 'You are already copying this trader.');
            }

            // Create the copied trade
            $copiedTrade = new CopiedTrade();
            $copiedTrade->user_id = $user->id;
            $copiedTrade->copy_trader_id = $traderId;
            $copiedTrade->amount = $request->amount;
            $copiedTrade->status = 1; // Active
            $copiedTrade->save();

            // Deduct amount from user balance
            $user->balance -= $request->amount;
            $user->save();

            DB::commit();

            return redirect()->back()->with('success', 'Successfully started copying ' . $copyTrader->name . ' with $' . number_format($request->amount, 2));

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Copy trading error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again.');
        }
    }

    public function detail($id)
    {
        $copiedTrade = CopiedTrade::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('copy_trader')
            ->firstOrFail();

        // Get trader's recent performance data
        $trader = $copiedTrade->copy_trader;
        
        // Use the actual performance metrics from the copied trade (set by admin)
        $tradeCount = $copiedTrade->trade_count ?? 0;
        $wins = $copiedTrade->win ?? 0;
        $losses = $copiedTrade->loss ?? 0;
        $pnl = $copiedTrade->pnl ?? 0;
        
        // Calculate ROI based on actual PnL
        $roi = $copiedTrade->amount > 0 ? ($pnl / $copiedTrade->amount) * 100 : 0;

        return view('dashboard.copy-trade-detail', compact(
            'copiedTrade', 
            'trader', 
            'tradeCount', 
            'wins', 
            'losses', 
            'pnl', 
            'roi'
        ));
    }

    public function stop($id)
    {
        try {
            DB::beginTransaction();

            $copiedTrade = CopiedTrade::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            if ($copiedTrade->status == 0) {
                return redirect()->back()->with('error', 'This trade is already inactive');
            }

            // Stop the copied trade
            $copiedTrade->status = 0; // Inactive
            $copiedTrade->stopped_at = now();
            $copiedTrade->save();

            // Return amount to user balance
            $user = Auth::user();
            $user->balance += $copiedTrade->amount;
            $user->save();

            DB::commit();

            return redirect()->back()->with('success', 'Successfully stopped copying ' . $copiedTrade->copy_trader->name);

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Stop copy trading error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while stopping the trade. Please try again.');
        }
    }
}
