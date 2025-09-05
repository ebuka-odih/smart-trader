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
use App\Http\Controllers\Admin\BotTradingController;

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/open-trades', [AdminTradeController::class, 'openTrades'])->name('openTrades');
    Route::get('/closed-trades', [AdminTradeController::class, 'closedTrades'])->name('closedTrades');
    Route::get('/trade-history', [AdminTradeController::class, 'tradeHistory'])->name('trade.history');
    Route::get('/trade-room', [AdminTradeController::class, 'index'])->name('trade.index');
    Route::post('/trade/{id}/edit-pnl', [AdminTradeController::class, 'editPnl'])->name('trade.edit-pnl');
    Route::post('/trade/{id}/close', [AdminTradeController::class, 'closeTrade'])->name('trade.close');
    Route::delete('/trade/{id}', [AdminTradeController::class, 'destroy'])->name('trade.destroy');
    Route::resource('/copy-trader', CopyTraderController::class);

    // Admin users management
    Route::resource('/user', AdminUserController::class)->names('user');
    Route::delete('/user/{id}/delete', [AdminUserController::class, 'deleteUser'])->name('deleteUser');
    Route::post('/user/{id}/update-balance', [AdminUserController::class, 'updateBalance'])->name('updateBalance');
    Route::post('/user/{id}/update-status', [AdminUserController::class, 'updateStatus'])->name('updateStatus');

    Route::resource('/payment-method', AdminPaymentMethodController::class);
    Route::get('/security', [AdminController::class, 'security'])->name('security');

    Route::resource('/plans', AdminPlanController::class)->names('plans');
    Route::post('/plans/{plan}/toggle-status', [AdminPlanController::class, 'toggleStatus'])->name('plans.toggle-status');
    Route::resource('/trade-pair', AdminTradePairController::class);

    Route::get('/transactions/deposits', [AdminTransactionController::class, 'deposits'])->name('transactions.deposits');
    Route::get('/transactions/withdrawals', [AdminTransactionController::class, 'withdrawals'])->name('transactions.withdrawals');
    
    // Deposit management routes
    Route::get('/deposit/{id}/details', [AdminTransactionController::class, 'getDepositDetails'])->name('deposit.details');
    Route::post('/deposit/{id}/approve', [AdminTransactionController::class, 'approveDeposit'])->name('deposit.approve');
    Route::post('/deposit/{id}/decline', [AdminTransactionController::class, 'declineDeposit'])->name('deposit.decline');
    Route::delete('/deposit/{id}/delete', [AdminTransactionController::class, 'deleteDeposit'])->name('deposit.delete');
    
    // Withdrawal management routes
    Route::post('/transactions/withdrawals/{withdrawal}/approve', [AdminTransactionController::class, 'approveWithdrawal'])->name('transactions.withdrawals.approve');
    Route::post('/transactions/withdrawals/{withdrawal}/reject', [AdminTransactionController::class, 'rejectWithdrawal'])->name('transactions.withdrawals.reject');

    Route::resource('/signals', AdminSignalController::class)->names('signals');

    // Bot Trading Management
    Route::resource('/bot-trading', BotTradingController::class)->names('bot-trading')->parameters(['bot-trading' => 'bot']);
    Route::post('/bot-trading/{bot}/stop', [BotTradingController::class, 'stop'])->name('bot-trading.stop');
    Route::post('/bot-trading/{bot}/execute', [BotTradingController::class, 'execute'])->name('bot-trading.execute');
    Route::post('/bot-trading/{bot}/edit-pnl', [BotTradingController::class, 'editPnl'])->name('bot-trading.edit-pnl');
    Route::post('/bot-trading/trade/{trade}/edit-pnl', [BotTradingController::class, 'editTradePnl'])->name('bot-trading.edit-trade-pnl');
    Route::get('/bot-trading/stats', [BotTradingController::class, 'stats'])->name('bot-trading.stats');

    // Copied trades history
    Route::get('/copied-trades', [CopiedTradeController::class, 'index'])->name('copied-trades.index');
    Route::post('/copied-trades/{id}/edit-pnl', [CopiedTradeController::class, 'editPnl'])->name('copied-trades.edit-pnl');
});
