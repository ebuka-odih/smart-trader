<?php

use App\Http\Controllers\BotTradingController;
use App\Http\Controllers\CopyTradingController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\UserPlanController;
use App\Http\Controllers\UserSignalController;
use App\Http\Controllers\SignalSubscriptionController;
use App\Http\Controllers\UserStakingController;
use App\Http\Controllers\UserMiningController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\HoldingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\LiveTradingController;
use App\Http\Controllers\OverviewController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.index')->name('index');
Route::view('products', 'pages.products')->name('products');
Route::view('market', 'pages.market')->name('market');
Route::view('about', 'pages.about')->name('about');
Route::view('contact', 'pages.contact')->name('contact');
Route::get('loading', [UserController::class, 'loading'])->name('loading');

// Email template preview route (for development/testing)
Route::view('email-preview', 'email-preview')->name('email.preview');

Route::group(['middleware' => ['auth'], 'prefix' => 'user', 'as' => 'user.'], function(){
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('update/profile/{id}', [UserController::class, 'updateProfile'])->name('updateProfile');
    Route::post('update/password/', [UserController::class, 'updatePassword'])->name('updatePassword');

    // Notification routes
    Route::get('notifications', [\App\Http\Controllers\User\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{id}/read', [\App\Http\Controllers\User\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('notifications/mark-all-read', [\App\Http\Controllers\User\NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
    Route::delete('notifications/{id}', [\App\Http\Controllers\User\NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('notifications/clear-all', [\App\Http\Controllers\User\NotificationController::class, 'clearAll'])->name('notifications.clearAll');
    Route::get('notifications/unread-count', [\App\Http\Controllers\User\NotificationController::class, 'getUnreadCount'])->name('notifications.unreadCount');
    Route::get('notifications/recent', [\App\Http\Controllers\User\NotificationController::class, 'getRecent'])->name('notifications.recent');

    Route::get('trade', [TradeController::class, 'index'])->name('trade.index');
    Route::get('trade/{id}', [TradeController::class, 'trade'])->name('trade');
    Route::post('place/buy/trade', [TradeController::class, 'placeBuyTrade'])->name('placeBuyTrade');
    Route::post('place/sell/trade', [TradeController::class, 'placeSellTrade'])->name('placeSellTrade');
    Route::get('close/trade/{id}', [TradeController::class, 'closeTrade'])->name('closeTrade');

    Route::get('deposit', [DepositController::class, 'deposit'])->name('deposit');
    Route::post('deposit/payment/', [DepositController::class, 'payment'])->name('payment');
    Route::post('deposit/cancel/{id}', [DepositController::class, 'cancelDeposit'])->name('deposit.cancel');
    Route::get('deposit/proof/{id}', [DepositController::class, 'viewProof'])->name('deposit.proof');
    Route::post('generate/qrcode', [DepositController::class, 'generateQRCode'])->name('generate.qrcode');

    Route::get('withdrawal/', [WithdrawalController::class, 'withdrawal'])->name('withdrawal');
Route::post('store/withdrawal/', [WithdrawalController::class, 'withdrawalStore'])->name('withdrawalStore');
Route::post('transfer-funds', [WithdrawalController::class, 'transferFunds'])->name('transfer.funds');
Route::get('withdrawal/history', [WithdrawalController::class, 'getWithdrawalHistory'])->name('withdrawal.history');
Route::get('transfer/history', [WithdrawalController::class, 'getTransferHistory'])->name('transfer.history');
Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('kyc', [KycController::class, 'index'])->name('kyc.index');
Route::post('kyc', [KycController::class, 'store'])->name('kyc.store');

    Route::post('activate/plan', [SubscriptionController::class, 'store'])->name('activatePlan');

    // Plan routes
    Route::get('plan/trading', [SubscriptionController::class, 'trading'])->name('plan.trading');
    Route::get('plan/signal', [SubscriptionController::class, 'signal'])->name('plan.signal');
    // Route::get('plan/mining', [SubscriptionController::class, 'mining'])->name('plan.mining'); // Removed - using new mining module
    // Route::get('plan/staking', [SubscriptionController::class, 'staking'])->name('plan.staking'); // Removed - using new staking module

    // User Plan Management Routes
    Route::get('plans', [UserPlanController::class, 'index'])->name('plans.index');
    Route::get('plans/create', [UserPlanController::class, 'create'])->name('plans.create');
    Route::post('plans', [UserPlanController::class, 'store'])->name('plans.store');
    Route::get('plans/history', [UserPlanController::class, 'history'])->name('plans.history');
    Route::get('plans/{userPlan}', [UserPlanController::class, 'show'])->name('plans.show');
    Route::get('plans/{userPlan}/edit', [UserPlanController::class, 'edit'])->name('plans.edit');
    Route::put('plans/{userPlan}', [UserPlanController::class, 'update'])->name('plans.update');
    Route::delete('plans/{userPlan}', [UserPlanController::class, 'destroy'])->name('plans.destroy');
    Route::post('plans/{userPlan}/cancel', [UserPlanController::class, 'cancel'])->name('plans.cancel');
    Route::post('plans/{userPlan}/reactivate', [UserPlanController::class, 'reactivate'])->name('plans.reactivate');
    Route::post('plans/subscribe/{plan}', [UserPlanController::class, 'subscribe'])->name('plans.subscribe');
    Route::get('my-plans', [UserPlanController::class, 'myPlans'])->name('plans.my-plans');

    // Signal Routes
Route::get('signals', [UserSignalController::class, 'index'])->name('signals.index');
Route::get('signals/{signal}', [UserSignalController::class, 'show'])->name('signals.show');
Route::post('signals/{signal}/copy', [UserSignalController::class, 'copySignal'])->name('signals.copy');
Route::get('signals/statistics', [UserSignalController::class, 'statistics'])->name('signals.statistics');

// Signal Subscription Routes
Route::get('signal-subscriptions', [SignalSubscriptionController::class, 'index'])->name('signal-subscriptions.index');
Route::get('signal-subscriptions/create', [SignalSubscriptionController::class, 'create'])->name('signal-subscriptions.create');
Route::post('signal-subscriptions', [SignalSubscriptionController::class, 'store'])->name('signal-subscriptions.store');
Route::get('signal-subscriptions/{subscription}', [SignalSubscriptionController::class, 'show'])->name('signal-subscriptions.show');
Route::get('signal-subscriptions/{subscription}/edit', [SignalSubscriptionController::class, 'edit'])->name('signal-subscriptions.edit');
Route::put('signal-subscriptions/{subscription}', [SignalSubscriptionController::class, 'update'])->name('signal-subscriptions.update');
Route::delete('signal-subscriptions/{subscription}', [SignalSubscriptionController::class, 'cancel'])->name('signal-subscriptions.cancel');
Route::post('signal-subscriptions/{subscription}/renew', [SignalSubscriptionController::class, 'renew'])->name('signal-subscriptions.renew');
Route::get('signal-subscriptions/active', [SignalSubscriptionController::class, 'active'])->name('signal-subscriptions.active');
Route::get('signal-subscriptions/history', [SignalSubscriptionController::class, 'history'])->name('signal-subscriptions.history');

// Staking Routes
Route::get('staking', [UserStakingController::class, 'index'])->name('staking.index');
Route::get('staking/create', [UserStakingController::class, 'create'])->name('staking.create');
Route::post('staking', [UserStakingController::class, 'store'])->name('staking.store');
Route::get('staking/{staking}', [UserStakingController::class, 'show'])->name('staking.show');
Route::post('staking/{staking}/cancel', [UserStakingController::class, 'cancel'])->name('staking.cancel');
Route::post('staking/{staking}/withdraw', [UserStakingController::class, 'withdraw'])->name('staking.withdraw');
Route::get('staking/statistics', [UserStakingController::class, 'statistics'])->name('staking.statistics');

// Mining Routes
Route::get('mining', [UserMiningController::class, 'index'])->name('mining.index');
Route::get('mining/create', [UserMiningController::class, 'create'])->name('mining.create');
Route::post('mining', [UserMiningController::class, 'store'])->name('mining.store');
Route::get('mining/{mining}', [UserMiningController::class, 'show'])->name('mining.show');
Route::post('mining/{mining}/cancel', [UserMiningController::class, 'cancel'])->name('mining.cancel');
Route::post('mining/{mining}/suspend', [UserMiningController::class, 'suspend'])->name('mining.suspend');
Route::post('mining/{mining}/resume', [UserMiningController::class, 'resume'])->name('mining.resume');
Route::post('mining/{mining}/withdraw', [UserMiningController::class, 'withdraw'])->name('mining.withdraw');
Route::get('mining/statistics', [UserMiningController::class, 'statistics'])->name('mining.statistics');

// Portfolio Routes
Route::get('portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('portfolio/trade', [PortfolioController::class, 'index'])->name('portfolio.trade');
Route::get('portfolio/staking', [PortfolioController::class, 'staking'])->name('portfolio.staking');
Route::get('portfolio/mining', [PortfolioController::class, 'mining'])->name('portfolio.mining');
Route::get('portfolio/holding', [HoldingController::class, 'index'])->name('portfolio.holding');
Route::get('portfolio/signal', [PortfolioController::class, 'signal'])->name('portfolio.signal');

// Holding Routes
Route::get('holding', [HoldingController::class, 'index'])->name('holding.index');
Route::get('holding/buy-assets', [HoldingController::class, 'buyAssets'])->name('holding.buy-assets');
Route::get('holding/chart/{symbol}', [HoldingController::class, 'assetChart'])->name('holding.asset-chart');
Route::post('holding/buy', [HoldingController::class, 'buy'])->name('holding.buy');
Route::post('holding/sell', [HoldingController::class, 'sell'])->name('holding.sell');
Route::get('holding/search', [HoldingController::class, 'searchAssets'])->name('holding.search');
Route::get('holding/list', [HoldingController::class, 'getHoldings'])->name('holding.list');
        Route::get('holding/assets', [HoldingController::class, 'getAssets'])->name('holding.assets');
        Route::get('holding/transactions', [HoldingController::class, 'getTransactions'])->name('holding.transactions');
        Route::get('holding/balance', [HoldingController::class, 'getBalance'])->name('holding.balance');



    Route::get('copy-trading', [CopyTradingController::class, 'index'])->name('copyTrading.index');
    Route::post('store/copy-trading', [CopyTradingController::class, 'store'])->name('copyTrading.store');
    Route::get('copy-trading/{id}', [CopyTradingController::class, 'detail'])->name('copyTrading.detail');
    Route::post('copy-trading/{id}/stop', [CopyTradingController::class, 'stop'])->name('copyTrading.stop');

    // Bot Trading Routes
    Route::get('bot-trading', [BotTradingController::class, 'index'])->name('botTrading.index');
    Route::get('bot-trading/create', [BotTradingController::class, 'create'])->name('botTrading.create');
    Route::post('bot-trading', [BotTradingController::class, 'store'])->name('botTrading.store');
    Route::get('bot-trading/{bot}', [BotTradingController::class, 'show'])->name('botTrading.show');
    Route::get('bot-trading/{bot}/edit', [BotTradingController::class, 'edit'])->name('botTrading.edit');
    Route::put('bot-trading/{bot}', [BotTradingController::class, 'update'])->name('botTrading.update');
    Route::delete('bot-trading/{bot}', [BotTradingController::class, 'destroy'])->name('botTrading.destroy');
    
    // Bot Control Routes
    Route::post('bot-trading/{bot}/start', [BotTradingController::class, 'start'])->name('botTrading.start');
    Route::post('bot-trading/{bot}/pause', [BotTradingController::class, 'pause'])->name('botTrading.pause');
    Route::post('bot-trading/{bot}/stop', [BotTradingController::class, 'stop'])->name('botTrading.stop');
    
    // Bot Data Routes
    Route::get('bot-trading/{bot}/trades', [BotTradingController::class, 'trades'])->name('botTrading.trades');
    Route::get('bot-trading/{bot}/performance', [BotTradingController::class, 'performance'])->name('botTrading.performance');
    Route::post('bot-trading/{bot}/execute', [BotTradingController::class, 'execute'])->name('botTrading.execute');

    // Live Trading Routes
    Route::get("live-trading", [LiveTradingController::class, "index"])->name("liveTrading.index");
    Route::get("live-trading/trade", [LiveTradingController::class, "trade"])->name("liveTrading.trade");
    Route::post("live-trading", [LiveTradingController::class, "store"])->name("liveTrading.store");
    Route::post("live-trading/{liveTrade}/cancel", [LiveTradingController::class, "cancel"])->name("liveTrading.cancel");
    Route::get("live-trading/price", [LiveTradingController::class, "getPrice"])->name("liveTrading.price");
    Route::post("live-trading/refresh-prices", [LiveTradingController::class, "refreshPrices"])->name("liveTrading.refreshPrices");
    Route::get("live-trading/history", [LiveTradingController::class, "history"])->name("liveTrading.history");

    // Overview Routes
    Route::get("overview", [OverviewController::class, "index"])->name("overview.index");

});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

    // Test email route
    Route::get('/test-email', function () {
        try {
            Mail::send('emails.verification', [
                'name' => 'Test User',
                'code' => '123456',
                'expires_at' => now()->addMinutes(10)->format('H:i'),
            ], function ($message) {
                $message->to('test@example.com')
                        ->subject('Test Verification Email');
            });
            return 'Email sent successfully!';
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    });

    // Test notification route
    Route::get('/test-notification', function () {
        if (!auth()->check()) {
            return 'Please login first';
        }
        
        $user = auth()->user();
        
        // Create a test notification
        \App\Models\UserNotification::create([
            'user_id' => $user->id,
            'type' => 'system',
            'title' => 'Test Notification',
            'message' => 'This is a test notification created at ' . now()->format('H:i:s') . ' for user: ' . $user->name,
            'data' => ['test' => true, 'timestamp' => now()->toISOString(), 'user_id' => $user->id]
        ]);
        
        return 'Test notification created successfully for ' . $user->name . '! Check your notification dropdown.';
    });

    // Test notification count route (no auth required for testing)
    Route::get('/test-notification-count', function () {
        $adminUserId = '916b7fbf-290b-4fb8-9383-bc7d159571b4';
        $count = \App\Models\UserNotification::where('user_id', $adminUserId)
            ->whereNull('read_at')
            ->count();
        
        return response()->json([
            'user_id' => $adminUserId,
            'unread_count' => $count,
            'total_notifications' => \App\Models\UserNotification::where('user_id', $adminUserId)->count()
        ]);
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
