<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPlan;
use App\Models\UserStaking;
use App\Models\UserMining;

class PortfolioController extends Controller
{
    /**
     * Show the main portfolio page (Trade tab)
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user's trading plans
        $tradingPlans = $user->userPlans()
            ->whereHas('plan', function($query) {
                $query->where('type', 'trading');
            })
            ->with('plan')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate total balance
        $totalBalance = $user->getTotalBalanceAttribute();
        
        // Calculate trading statistics
        $totalTradingInvestment = $tradingPlans->sum('amount_paid');
        $activeTradingPlans = $tradingPlans->where('status', 'active')->count();
        $expiredTradingPlans = $tradingPlans->where('status', 'expired')->count();

        return view('dashboard.portfolio.trade', compact(
            'user',
            'tradingPlans',
            'totalBalance',
            'totalTradingInvestment',
            'activeTradingPlans',
            'expiredTradingPlans'
        ));
    }

    /**
     * Show staking portfolio page
     */
    public function staking()
    {
        $user = Auth::user();
        
        // Get user's staking activities
        $stakings = $user->stakings()->with('plan')->orderBy('created_at', 'desc')->get();
        
        // Calculate total balance
        $totalBalance = $user->getTotalBalanceAttribute();
        
        // Calculate staking statistics
        $totalStaked = $stakings->sum('amount_staked');
        $activeStakings = $stakings->where('status', 'active')->count();
        $totalRewards = $stakings->sum('total_rewards');
        $currentValue = $stakings->sum('current_value');

        return view('dashboard.portfolio.staking', compact(
            'user',
            'stakings',
            'totalBalance',
            'totalStaked',
            'activeStakings',
            'totalRewards',
            'currentValue'
        ));
    }

    /**
     * Show mining portfolio page
     */
    public function mining()
    {
        $user = Auth::user();
        
        // Get user's mining activities
        $minings = $user->minings()->with('plan')->orderBy('created_at', 'desc')->get();
        
        // Calculate total balance
        $totalBalance = $user->getTotalBalanceAttribute();
        
        // Calculate mining statistics
        $totalInvested = $minings->sum('amount_invested');
        $activeMinings = $minings->where('status', 'active')->count();
        $totalMined = $minings->sum('total_mined');
        $currentValue = $minings->sum('current_value');

        return view('dashboard.portfolio.mining', compact(
            'user',
            'minings',
            'totalBalance',
            'totalInvested',
            'activeMinings',
            'totalMined',
            'currentValue'
        ));
    }

    /**
     * Show holding portfolio page
     */
    public function holding()
    {
        $user = Auth::user();
        
        // Get user's holding balance and related activities
        $holdingBalance = $user->holding_balance;
        
        // Calculate total balance
        $totalBalance = $user->getTotalBalanceAttribute();
        
        // For holding, we'll show the balance and any related activities
        // This could be expanded to show holding history, etc.
        $holdingStats = [
            'current_balance' => $holdingBalance,
            'total_balance' => $totalBalance,
            'percentage' => $totalBalance > 0 ? ($holdingBalance / $totalBalance) * 100 : 0
        ];

        return view('dashboard.portfolio.holding', compact(
            'user',
            'holdingStats',
            'totalBalance'
        ));
    }

    /**
     * Show signal portfolio page
     */
    public function signal()
    {
        $user = Auth::user();
        
        // Get user's signal plans
        $signalPlans = $user->userPlans()
            ->whereHas('plan', function($query) {
                $query->where('type', 'signal');
            })
            ->with('plan')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Calculate total balance
        $totalBalance = $user->getTotalBalanceAttribute();
        
        // Calculate signal statistics
        $totalSignalInvestment = $signalPlans->sum('amount_paid');
        $activeSignalPlans = $signalPlans->where('status', 'active')->count();
        $totalSignalsRemaining = $signalPlans->where('status', 'active')->sum('signal_quantity_remaining');
        $totalSignalsUsed = $signalPlans->sum('daily_signals_used');

        return view('dashboard.portfolio.signal', compact(
            'user',
            'signalPlans',
            'totalBalance',
            'totalSignalInvestment',
            'activeSignalPlans',
            'totalSignalsRemaining',
            'totalSignalsUsed'
        ));
    }
}
