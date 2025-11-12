<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trade;
use App\Models\TradePair;
use App\Models\User;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    public function index()
    {
        $trades = Trade::all();
        $pairs = TradePair::all();
        $users = User::where('role', 'user')->get();
        return view('admin.trade.trade', compact('trades', 'pairs', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'trade_pair_id' => 'required|exists:trade_pairs,id',
            'leverage' => 'required|integer|min:1|max:100',
            'duration' => 'required|integer|min:1',
            'action_type' => 'required|in:buy,sell',
        ]);

        $userId = $request->get('user_id');
        $amount = $request->input('amount');

        $user = User::findOrFail($userId);
        
        // Check if user has sufficient balance
        if ($user->balance < $amount) {
            return redirect()->back()->with('error', 'Insufficient balance. User balance: $' . number_format($user->balance, 2));
        }

        $trade = Trade::create([
            'user_id' => $userId,
            'amount' => $amount,
            'status' => 'open',
            'trade_pair_id' => $request->get('trade_pair_id'),
            'leverage' => $request->get('leverage'),
            'duration' => $request->get('duration'),
            'action_type' => $request->get('action_type'),
        ]);

        $user->balance -= $trade->amount;
        $user->save();

        $redirectRoute = $request->get('redirect_to') === 'place' ? 'admin.trade.place' : ($request->get('redirect_to') === 'history' ? 'admin.trade.history' : 'admin.openTrades');
        return redirect()->route($redirectRoute)->with('success', 'Trade placed successfully!');
    }

    public function openTrades(){
        $trades = Trade::latest()->get();
        return view('admin.trade.open-trades', compact('trades'));
    }
    public function closedTrades(){
        $trades = Trade::orderBy('updated_at', 'desc')->get();
        return view('admin.trade.closed-trades', compact('trades'));
    }

    public function tradeHistory(){
        $openTrades = Trade::where('status', 'open')->with(['user', 'trade_pair'])->latest()->get();
        $closedTrades = Trade::where('status', 'closed')->with(['user', 'trade_pair'])->orderBy('updated_at', 'desc')->get();
        
        \Log::info('Trade History Data:', [
            'open_trades_count' => $openTrades->count(),
            'closed_trades_count' => $closedTrades->count(),
            'open_trades' => $openTrades->pluck('id', 'status'),
            'closed_trades' => $closedTrades->pluck('id', 'status')
        ]);
        
        return view('admin.trade.history', compact('openTrades', 'closedTrades'));
    }

    public function placeTrade(){
        $users = User::where('role', 'user')->get();
        $pairs = TradePair::all();
        
        return view('admin.trade.place', compact('users', 'pairs'));
    }



    public function editPnl(Request $request, $id)
    {
        $request->validate([
            'profit_loss' => 'required|numeric'
        ]);

        $trade = Trade::findOrFail($id);
        $trade->profit_loss = $request->profit_loss;
        $trade->save();

        return response()->json(['success' => true, 'message' => 'PnL updated successfully']);
    }

    public function closeTrade(Request $request, $id)
    {
        $trade = Trade::findOrFail($id);
        
        if ($request->action == 'profit') {
            $trade->profit_loss = $request->get('profit_loss');
            $trade->status = 'closed';
            $trade->save();
            
            $user = User::find($trade->user_id);
            $user->balance += $trade->amount + $trade->profit_loss;
            $user->save();
        } else {
            $trade->profit_loss = $request->get('profit_loss');
            $trade->status = 'closed';
            $trade->save();
            
            $user = User::find($trade->user_id);
            $user->balance += $trade->amount + $trade->profit_loss;
            $user->save();
        }
        
        return redirect()->route('admin.closedTrades')->with('success', 'Trade closed successfully!');
    }

    public function destroy($id)
    {
        $trade = Trade::findOrFail($id);
        $trade->delete();
        return back()->with('success', 'Trade deleted successfully!');
    }

}
