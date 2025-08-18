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

        $user = $request->get('user_id');
        $amount = $request->input('amount');

        $trade = Trade::create([
            'user_id' => $user,
            'amount' => $amount,
            'status' => 'open',
            'trade_pair_id' => $request->get('trade_pair_id'),
            'leverage' => $request->get('leverage'),
            'duration' => $request->get('duration'),
            'action_type' => $request->get('action_type'),
        ]);

        $user = User::findOrFail($user);
        $user->balance -= $trade->amount;
        $user->save();

        return redirect()->route('admin.openTrades')->with('success', 'Trade placed successfully!');
    }

    public function openTrades(){
        $trades = Trade::latest()->get();
        return view('admin.trade.open-trades', compact('trades'));
    }
    public function closedTrades(){
        $trades = Trade::orderBy('updated_at', 'desc')->get();
        return view('admin.trade.closed-trades', compact('trades'));
    }

    public function closeTrade(Request $request, $id)
    {
        $trade = Trade::findOrFail($id);
        if ($request->action == 'profit')
        {
            $trade->profit_loss = $request->get('profit_loss');
            $trade->status = 'closed';
            $trade->save();
            $user = User::find($trade->user_id);
            $user->balance += $trade->amount;
            $user->save();
        }
        $trade->profit_loss = $request->get('profit_loss');
        $trade->status = 'closed';
        $trade->save();
        $user = User::find($trade->user_id);
        $user->balance -= $trade->amount;
        $user->save();
        return redirect()->route('admin.closedTrades')->with('success', 'Trade closed successfully!');
    }

    public function destroy($id)
    {
        $trades = Trade::findOrFail($id);
        $trades->delete();
        return back()->with('success', 'Trade deleted successfully!');
    }

}
