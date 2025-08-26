<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CopiedTrade;

class CopiedTradeController extends Controller
{
    public function index()
    {
        $copiedTrades = CopiedTrade::with(['user', 'copy_trader'])->orderBy('created_at','desc')->paginate(20);
        return view('admin.copy-trade.index', compact('copiedTrades'));
    }
}
