<?php

namespace App\Http\Controllers;

use App\Events\WithdrawalSubmitted;
use App\Mail\WithdrawalRequestMail;
use App\Mail\TransferActionMail;
use App\Models\User;
use App\Models\Withdrawal;
use App\Models\FundTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class WithdrawalController extends Controller
{
    public function withdrawal()
    {
        $user = Auth::user();
        $withdrawals = Withdrawal::whereUserId(auth()->id())->latest()->get();
        $transfers = FundTransfer::whereUserId(auth()->id())->latest()->get();
        return view('dashboard.transactions.withdrawal', compact('user', 'withdrawals', 'transfers'));
    }

    public function transferFunds(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_account' => 'required|string|in:balance,trading_balance,mining_balance',
            'to_account' => 'required|string|in:balance,trading_balance,mining_balance|different:from_account',
            'amount' => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user = Auth::user();
        $fromAccount = $request->from_account;
        $toAccount = $request->to_account;
        $amount = $request->amount;

        // Check if user has sufficient balance
        if ($user->$fromAccount < $amount) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient balance in ' . str_replace('_', ' ', $fromAccount)
            ], 422);
        }

        try {
            // Deduct from source account
            $user->$fromAccount -= $amount;
            
            // Add to destination account
            $user->$toAccount += $amount;
            
            $user->save();

            // Record the transfer
            $transfer = FundTransfer::create([
                'user_id' => $user->id,
                'from_account' => $fromAccount,
                'to_account' => $toAccount,
                'amount' => $amount,
                'status' => 'completed',
                'description' => 'Internal transfer from ' . str_replace('_', ' ', $fromAccount) . ' to ' . str_replace('_', ' ', $toAccount)
            ]);

            // Send email notification
            Mail::to($user->email)->send(new TransferActionMail($transfer));

            return response()->json([
                'success' => true,
                'message' => 'Transfer completed successfully',
                'new_balances' => [
                    'from_account' => $user->$fromAccount,
                    'to_account' => $user->$toAccount
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Transfer failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function withdrawalStore(Request $request)
    {
        // Ensure we always return JSON for AJAX requests
        if ($request->expectsJson() || $request->ajax()) {
            try {
                return $this->processWithdrawal($request);
            } catch (\Exception $e) {
                \Log::error('Withdrawal processing error', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                    'request_data' => $request->all()
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'An unexpected error occurred. Please try again.'
                ], 500);
            }
        }
        
        // Fallback for non-AJAX requests
        return $this->processWithdrawal($request);
    }
    
    private function processWithdrawal(Request $request)
    {
        $rules = [
            'from_account' => 'required|string|in:balance,trading_balance,mining_balance',
            'payment_method' => 'required|string|in:crypto,bank,paypal',
            'amount' => 'required|numeric|min:0.01',
        ];

        // Add conditional validation based on payment method
        if ($request->payment_method === 'crypto') {
            $rules['wallet'] = 'required';
            $rules['address'] = 'required';
        } elseif ($request->payment_method === 'bank') {
            $rules['bank_name'] = 'required';
            $rules['acct_name'] = 'required';
            $rules['acct_number'] = 'required';
        } elseif ($request->payment_method === 'paypal') {
            $rules['paypal'] = 'required|email';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            \Log::info('Withdrawal validation failed', [
                'errors' => $validator->errors()->toArray(),
                'request_data' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user = Auth::user();
        $fromAccount = $request->from_account;
        $amount = $request->amount;

        // Check if user has sufficient balance
        if ($user->$fromAccount < $amount) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient balance in ' . str_replace('_', ' ', $fromAccount)
            ], 422);
        }

        // Check minimum withdrawal amount
        $minWithdrawal = 10; // $10 minimum
        if ($amount < $minWithdrawal) {
            return response()->json([
                'success' => false,
                'message' => 'Minimum withdrawal amount is $' . $minWithdrawal
            ], 422);
        }

        try {
            $admin = User::where('role', 'admin')->first();
            $withdraw = new Withdrawal();
            $withdraw->amount = $amount;
            $withdraw->user_id = Auth::id();
            $withdraw->payment_method = $request->payment_method;
            $withdraw->from_account = $fromAccount;

            if ($request->payment_method == 'crypto') {
                $withdraw->address = $request->address;
                $withdraw->wallet = $request->wallet;
            } elseif ($request->payment_method == 'bank') {
                $withdraw->bank = json_encode([
                    'bank_name' => $request->bank_name,
                    'acct_name' => $request->acct_name,
                    'acct_number' => $request->acct_number
                ]);
            } else {
                $withdraw->paypal = $request->paypal;
            }

            $withdraw->save();

            // Create notification directly
            auth()->user()->createNotification(
                'withdrawal_submitted',
                'Withdrawal Submitted',
                "Your withdrawal request of " . auth()->user()->formatAmount($amount) . " from your " . ucfirst(str_replace('_', ' ', $fromAccount)) . " has been submitted and is pending approval.",
                [
                    'amount' => $amount,
                    'from_account' => $fromAccount,
                    'withdrawal_id' => $withdraw->id,
                    'status' => 'pending'
                ]
            );

            // Deduct from user's account
            $user->$fromAccount -= $amount;
            $user->save();

            // Send email notification to user
            Mail::to(auth()->user()->email)->send(new WithdrawalRequestMail($withdraw));

            \Log::info('Withdrawal request submitted successfully', [
                'user_id' => $user->id,
                'amount' => $amount,
                'payment_method' => $request->payment_method,
                'from_account' => $fromAccount
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Withdrawal request submitted successfully',
                'new_balance' => $user->$fromAccount
            ]);

        } catch (\Exception $e) {
            \Log::error('Withdrawal creation error', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'request_data' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Withdrawal request failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getWithdrawalHistory()
    {
        $withdrawals = Withdrawal::whereUserId(auth()->id())
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'withdrawals' => $withdrawals
        ]);
    }

    public function getTransferHistory()
    {
        $transfers = FundTransfer::whereUserId(auth()->id())
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'transfers' => $transfers
        ]);
    }
}
