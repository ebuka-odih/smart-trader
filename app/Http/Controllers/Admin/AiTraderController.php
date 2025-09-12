<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiTrader;
use App\Models\AiTraderPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AiTraderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $traders = AiTrader::with('aiTraderPlan')->paginate(10);
        return view('admin.ai-traders.index', compact('traders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plans = AiTraderPlan::where('is_active', true)->get();
        return view('admin.ai-traders.create', compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ai_trader_plan_id' => 'required|exists:ai_trader_plans,id',
            'name' => 'required|string|max:255',
            'trading_strategy' => 'required|in:conservative,moderate,aggressive,scalping,swing,day_trading',
            'ai_model' => 'required|string|max:50',
            'ai_confidence' => 'required|in:low,medium,high,maximum',
            'ai_learning_mode' => 'required|in:conservative,adaptive,aggressive,experimental',
            'stocks_to_trade' => 'required|array|min:1',
            'stocks_to_trade.*' => 'required|string|max:10',
            'risk_tolerance' => 'required|numeric|min:0|max:1',
            'stop_loss_percentage' => 'required|numeric|min:0|max:100',
            'take_profit_percentage' => 'required|numeric|min:0|max:100',
            'max_positions' => 'required|integer|min:1|max:50',
            'position_size_percentage' => 'required|numeric|min:1|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $trader = AiTrader::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'AI Trader created successfully',
            'trader' => $trader->load('aiTraderPlan')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AiTrader $aiTrader)
    {
        $aiTrader->load('aiTraderPlan');
        return response()->json([
            'success' => true,
            'trader' => $aiTrader
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AiTrader $aiTrader)
    {
        $plans = AiTraderPlan::where('is_active', true)->get();
        return view('admin.ai-traders.edit', compact('aiTrader', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AiTrader $aiTrader)
    {
        $validator = Validator::make($request->all(), [
            'ai_trader_plan_id' => 'required|exists:ai_trader_plans,id',
            'name' => 'required|string|max:255',
            'trading_strategy' => 'required|in:conservative,moderate,aggressive,scalping,swing,day_trading',
            'ai_model' => 'required|string|max:50',
            'ai_confidence' => 'required|in:low,medium,high,maximum',
            'ai_learning_mode' => 'required|in:conservative,adaptive,aggressive,experimental',
            'stocks_to_trade' => 'required|array|min:1',
            'stocks_to_trade.*' => 'required|string|max:10',
            'risk_tolerance' => 'required|numeric|min:0|max:1',
            'stop_loss_percentage' => 'required|numeric|min:0|max:100',
            'take_profit_percentage' => 'required|numeric|min:0|max:100',
            'max_positions' => 'required|integer|min:1|max:50',
            'position_size_percentage' => 'required|numeric|min:1|max:100',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $aiTrader->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'AI Trader updated successfully',
            'trader' => $aiTrader->load('aiTraderPlan')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AiTrader $aiTrader)
    {
        $aiTrader->delete();

        return response()->json([
            'success' => true,
            'message' => 'AI Trader deleted successfully'
        ]);
    }

    /**
     * Toggle trader status
     */
    public function toggleStatus(AiTrader $aiTrader)
    {
        $aiTrader->update(['is_active' => !$aiTrader->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'Trader status updated successfully',
            'is_active' => $aiTrader->is_active
        ]);
    }

    /**
     * Get traders by plan
     */
    public function getByPlan(AiTraderPlan $aiTraderPlan)
    {
        $traders = $aiTraderPlan->aiTraders()->get();
        
        return response()->json([
            'success' => true,
            'traders' => $traders
        ]);
    }
}
