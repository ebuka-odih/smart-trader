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
use App\Http\Controllers\Admin\MiningController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\AiTraderPlanController;
use App\Http\Controllers\Admin\AiTraderController;
use App\Http\Controllers\Admin\AdminSettingsController;

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
    Route::post('/reset-password', [AdminController::class, 'resetPassword'])->name('resetPassword');

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
    Route::post('/bot-trading/{bot}/pause', [BotTradingController::class, 'pause'])->name('bot-trading.pause');
    Route::post('/bot-trading/{bot}/resume', [BotTradingController::class, 'resume'])->name('bot-trading.resume');
    Route::post('/bot-trading/{bot}/start', [BotTradingController::class, 'start'])->name('bot-trading.start');
    Route::post('/bot-trading/{bot}/stop', [BotTradingController::class, 'stop'])->name('bot-trading.stop');
    Route::post('/bot-trading/{bot}/execute', [BotTradingController::class, 'execute'])->name('bot-trading.execute');
    Route::post('/bot-trading/{bot}/create-trade', [BotTradingController::class, 'storeTrade'])->name('bot-trading.create-trade');
    Route::post('/bot-trading/{bot}/edit-pnl', [BotTradingController::class, 'editPnl'])->name('bot-trading.edit-pnl');
    Route::post('/bot-trading/trade/{trade}/edit-pnl', [BotTradingController::class, 'editTradePnl'])->name('bot-trading.edit-trade-pnl');
    Route::get('/bot-trading/stats', [BotTradingController::class, 'stats'])->name('bot-trading.stats');

    // Copied trades history
    Route::get('/copied-trades', [CopiedTradeController::class, 'index'])->name('copied-trades.index');
    Route::post('/copied-trades/{id}/edit-pnl', [CopiedTradeController::class, 'editPnl'])->name('copied-trades.edit-pnl');
    Route::post('/copied-trades/{id}/activate', [CopiedTradeController::class, 'activate'])->name('copied-trades.activate');
    Route::post('/copied-trades/{id}/deactivate', [CopiedTradeController::class, 'deactivate'])->name('copied-trades.deactivate');
    Route::delete('/copied-trades/{id}', [CopiedTradeController::class, 'destroy'])->name('copied-trades.destroy');

    // Mining management
    Route::get('/mining', [MiningController::class, 'index'])->name('mining.index');
    Route::put('/mining/{id}', [MiningController::class, 'update'])->name('mining.update');
    Route::post('/mining/{id}/suspend', [MiningController::class, 'suspend'])->name('mining.suspend');
    Route::post('/mining/{id}/resume', [MiningController::class, 'resume'])->name('mining.resume');
    Route::post('/mining/{id}/cancel', [MiningController::class, 'cancel'])->name('mining.cancel');
    Route::delete('/mining/{id}', [MiningController::class, 'destroy'])->name('mining.destroy');
    Route::get('/mining-statistics', [MiningController::class, 'statistics'])->name('mining.statistics');

    // Notification management
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/send', [NotificationController::class, 'sendNotification'])->name('notifications.send');
    Route::get('/notifications/user-details', [NotificationController::class, 'getUserDetails'])->name('notifications.user-details');
    Route::get('/notifications/stats', [NotificationController::class, 'getStats'])->name('notifications.stats');
    Route::get('/notifications/history', [NotificationController::class, 'getHistory'])->name('notifications.history');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::put('/notifications/{id}', [NotificationController::class, 'update'])->name('notifications.update');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    // AI Trader Management
    Route::resource('/ai-trader-plans', AiTraderPlanController::class)->names('ai-trader-plans');
    Route::post('/ai-trader-plans/{aiTraderPlan}/toggle-status', [AiTraderPlanController::class, 'toggleStatus'])->name('ai-trader-plans.toggle-status');
    
    Route::resource('/ai-traders', AiTraderController::class)->names('ai-traders');
    Route::post('/ai-traders/{aiTrader}/toggle-status', [AiTraderController::class, 'toggleStatus'])->name('ai-traders.toggle-status');
    Route::get('/ai-traders/by-plan/{aiTraderPlan}', [AiTraderController::class, 'getByPlan'])->name('ai-traders.by-plan');
    
    // AI Trader Management & History
    Route::get('/ai-traders-management', [AiTraderController::class, 'management'])->name('ai-traders.management');
    Route::get('/ai-traders-history/{userAiTrader}', [AiTraderController::class, 'traderHistory'])->name('ai-traders.history');
    Route::post('/ai-traders-performance/{userAiTrader}/update', [AiTraderController::class, 'updatePerformance'])->name('ai-traders.update-performance');
    Route::post('/ai-traders-trade/{userAiTrader}/create', [AiTraderController::class, 'createTrade'])->name('ai-traders.create-trade');
    Route::get('/ai-traders-performance/{userAiTrader}/data', [AiTraderController::class, 'getPerformanceData'])->name('ai-traders.performance-data');
    
    // Admin Settings
    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/profile/update', [AdminSettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::post('/settings/system/update', [AdminSettingsController::class, 'updateSystemSettings'])->name('settings.system.update');
    Route::post('/settings/livechat/update', [AdminSettingsController::class, 'updateLivechatSettings'])->name('settings.livechat.update');
    Route::post('/settings/website/update', [AdminSettingsController::class, 'updateWebsiteSettings'])->name('settings.website.update');
});
