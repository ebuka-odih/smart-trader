<?php

namespace App\Http\Controllers;

use App\Models\CopiedTrade;
use App\Models\CopyTrader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CopyTradingController extends Controller
{
    public function index()
    {
        $traders = CopyTrader::all();
        $user = Auth::user();
        $copiedTrades = CopiedTrade::whereUserId(auth()->id())->get();
        return view('dashboard.copy-trade', compact('traders', 'user', 'copiedTrades'));
    }

    public function store(Request $request)
    {

        $traderId = $request->trader_id;
        $copyTrader = CopyTrader::findOrFail($traderId);
        if ($copyTrader->amoount > \auth()->user()->balance)
        {
            return redirect()->back()->with('error', 'Insufficient balance');
        }
        $cTrade = new CopiedTrade();
        $cTrade->user_id = Auth::id();
        $cTrade->copy_trader_id = $traderId;
        $cTrade->amount = $request->amount;
        $cTrade->status = 1;
        $cTrade->save();
        return redirect()->back()->with('success', 'Trade Copied Successful');
    }
}
