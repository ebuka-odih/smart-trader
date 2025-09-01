<?php

namespace App\Http\Controllers;

use App\Models\LiveTrade;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LiveTradingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $liveTrades = $user->liveTrades()->latest()->get();
        $cryptoAssets = Asset::where('type', 'crypto')->take(10)->get();
        $stockAssets = Asset::where('type', 'stock')->take(10)->get();
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

    public function store(Request $request)
    {
        return response()->json(['success' => true, 'message' => 'Trade placed successfully!']);
    }

    public function cancel(LiveTrade $liveTrade)
    {
        return response()->json(['success' => true, 'message' => 'Trade cancelled successfully!']);
    }

    public function getPrice(Request $request)
    {
        return response()->json(['success' => true, 'price' => 100.00]);
    }
}
