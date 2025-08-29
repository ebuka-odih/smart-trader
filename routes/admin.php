<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\TradeController as AdminTradeController;
use App\Http\Controllers\Admin\CopyTraderController;
use App\Http\Controllers\Admin\PaymentMethodController as AdminPaymentMethodController;
use App\Http\Controllers\Admin\PlanController as AdminPlanController;
use App\Http\Controllers\Admin\TradePairController as AdminTradePairController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\SignalController as AdminSignalController;
use App\Http\Controllers\Admin\CopiedTradeController;

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/open-trades', [AdminTradeController::class, 'openTrades'])->name('openTrades');
    Route::get('/trade-room', [AdminTradeController::class, 'index'])->name('trade.index');
    Route::resource('/copy-trader', CopyTraderController::class);

    // Admin users management
    Route::resource('/user', AdminUserController::class)->names('user');

    Route::resource('/payment-method', AdminPaymentMethodController::class);
    Route::get('/security', [AdminController::class, 'security'])->name('security');

    Route::resource('/plans', AdminPlanController::class)->names('plans');
    Route::resource('/trade-pair', AdminTradePairController::class);

    Route::get('/transactions/deposits', [AdminTransactionController::class, 'deposits'])->name('transactions.deposits');
    Route::get('/transactions/withdrawals', [AdminTransactionController::class, 'withdrawals'])->name('transactions.withdrawals');
    Route::post('/transactions/withdrawals/{withdrawal}/approve', [AdminTransactionController::class, 'approveWithdrawal'])->name('transactions.withdrawals.approve');
    Route::post('/transactions/withdrawals/{withdrawal}/reject', [AdminTransactionController::class, 'rejectWithdrawal'])->name('transactions.withdrawals.reject');

    Route::resource('/signals', AdminSignalController::class)->names('signals');

    // Copied trades history
    Route::get('/copied-trades', [CopiedTradeController::class, 'index'])->name('copied-trades.index');
});
