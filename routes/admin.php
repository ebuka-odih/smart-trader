<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CopyTraderController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\TradePairController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TradeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('user/security/', [AdminController::class, 'security'])->name('security');
    Route::post('change/password', [AdminController::class, 'resetPassword'])->name('resetPassword');

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/show/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('/update/account/user/{id}', [UserController::class, 'updateBalance'])->name('updateBalance');
    Route::delete('delete/user/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');

    Route::get('/transactions/deposits', [TransactionController::class, 'deposits'])->name('transactions.deposits');
Route::get('/deposit/{id}/details', [TransactionController::class, 'getDepositDetails'])->name('deposit.details');
Route::get('/deposit/{id}/approve', [TransactionController::class, 'approveDeposit'])->name('deposit.approve');
Route::get('/deposit/{id}/decline', [TransactionController::class, 'declineDeposit'])->name('deposit.decline');
Route::post('/deposit/{id}/delete', [TransactionController::class, 'deleteDeposit'])->name('deposit.delete');

// Plan Management Routes
Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');
Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
Route::get('/plans/{plan}/edit', [PlanController::class, 'edit'])->name('plans.edit');
Route::put('/plans/{plan}', [PlanController::class, 'update'])->name('plans.update');
Route::delete('/plans/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy');
Route::patch('/plans/{plan}/toggle-status', [PlanController::class, 'toggleStatus'])->name('plans.toggle-status');


    Route::get('/transactions/withdrawal', [TransactionController::class, 'withdrawal'])->name('transactions.withdrawal');
    Route::get('/approve/withdrawal/{id}', [TransactionController::class, 'approveWithdrawal'])->name('approveWithdrawal');
    Route::get('/decline/withdrawal/{id}', [TransactionController::class, 'declineWithdrawal'])->name('declineWithdrawal');

    Route::resource('/copy-trader', CopyTraderController::class);
    Route::resource('/payment-method', PaymentMethodController::class);
    Route::resource('/package', PackageController::class);
    Route::resource('/trade-pair', TradePairController::class);
    Route::resource('/trade', TradeController::class);

    Route::get('open-trades', [TradeController::class, 'openTrades'])->name('openTrades');
    Route::get('closed-trades', [TradeController::class, 'closedTrades'])->name('closedTrades');
    Route::post('close/trade/{id}', [TradeController::class, 'closeTrade'])->name('closeTrade');

});
