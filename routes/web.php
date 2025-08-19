<?php

use App\Http\Controllers\CopyTradingController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\UserPlanController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('index');
Route::view('products', 'pages.products')->name('products');
Route::view('market-caps', 'pages.market')->name('market');
Route::view('about', 'pages.about')->name('about');
Route::get('loading', [UserController::class, 'loading'])->name('loading');

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function(){
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('update/profile/{id}', [UserController::class, 'updateProfile'])->name('updateProfile');
    Route::post('update/password/', [UserController::class, 'updatePassword'])->name('updatePassword');

    Route::get('trade', [TradeController::class, 'index'])->name('trade.index');
    Route::get('trade/{id}', [TradeController::class, 'trade'])->name('trade');
    Route::post('place/buy/trade', [TradeController::class, 'placeBuyTrade'])->name('placeBuyTrade');
    Route::post('place/sell/trade', [TradeController::class, 'placeSellTrade'])->name('placeSellTrade');
    Route::get('close/trade/{id}', [TradeController::class, 'closeTrade'])->name('closeTrade');

    Route::get('deposit', [DepositController::class, 'deposit'])->name('deposit');
    Route::post('deposit/payment/', [DepositController::class, 'payment'])->name('payment');
    Route::post('deposit/cancel/{id}', [DepositController::class, 'cancelDeposit'])->name('deposit.cancel');
    Route::get('deposit/proof/{id}', [DepositController::class, 'viewProof'])->name('deposit.proof');

    Route::get('withdrawal/', [WithdrawalController::class, 'withdrawal'])->name('withdrawal');
    Route::post('store/withdrawal/', [WithdrawalController::class, 'withdrawalStore'])->name('withdrawalStore');

    Route::get('subscription/plans', [SubscriptionController::class, 'index'])->name('sub.plans');
    Route::post('activate/plan', [SubscriptionController::class, 'store'])->name('activatePlan');

    // Plan routes
    Route::get('plan/trading', [SubscriptionController::class, 'trading'])->name('plan.trading');
    Route::get('plan/signal', [SubscriptionController::class, 'signal'])->name('plan.signal');
    Route::get('plan/mining', [SubscriptionController::class, 'mining'])->name('plan.mining');
    Route::get('plan/staking', [SubscriptionController::class, 'staking'])->name('plan.staking');

    // User Plan Management Routes
    Route::get('plans', [UserPlanController::class, 'index'])->name('plans.index');
    Route::get('plans/create', [UserPlanController::class, 'create'])->name('plans.create');
    Route::post('plans', [UserPlanController::class, 'store'])->name('plans.store');
    Route::get('plans/{userPlan}', [UserPlanController::class, 'show'])->name('plans.show');
    Route::get('plans/{userPlan}/edit', [UserPlanController::class, 'edit'])->name('plans.edit');
    Route::put('plans/{userPlan}', [UserPlanController::class, 'update'])->name('plans.update');
    Route::delete('plans/{userPlan}', [UserPlanController::class, 'destroy'])->name('plans.destroy');
    Route::post('plans/{userPlan}/cancel', [UserPlanController::class, 'cancel'])->name('plans.cancel');
    Route::post('plans/{userPlan}/reactivate', [UserPlanController::class, 'reactivate'])->name('plans.reactivate');
    Route::post('plans/subscribe/{plan}', [UserPlanController::class, 'subscribe'])->name('plans.subscribe');
    Route::get('my-plans', [UserPlanController::class, 'myPlans'])->name('plans.my-plans');
    Route::get('plans/history', [UserPlanController::class, 'history'])->name('plans.history');

    Route::get('copy-trading', [CopyTradingController::class, 'index'])->name('copyTrading.index');
    Route::post('store/copy-trading', [CopyTradingController::class, 'store'])->name('copyTrading.store');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
