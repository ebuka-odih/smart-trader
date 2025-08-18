<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApproveDepositMail;
use App\Mail\ApproveWithdrawalMail;
use App\Mail\DeclineDepositMail;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    /**
     * Display all deposits with user and payment method relationships
     */
    public function deposits()
    {
        $deposits = Deposit::with(['user', 'payment_method'])
                          ->latest()
                          ->get();
        return view('admin.transactions.deposits', compact('deposits'));
    }

    /**
     * Get deposit details for modal view
     */
    public function getDepositDetails($id)
    {
        try {
            $deposit = Deposit::with(['user', 'payment_method'])
                             ->findOrFail($id);

            $html = view('admin.partials.deposit-details', compact('deposit'))->render();

            return response()->json([
                'success' => true,
                'html' => $html
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load deposit details'
            ]);
        }
    }

    /**
     * Approve a deposit and credit user's account
     */
    public function approveDeposit($id)
    {
        try {
            $deposit = Deposit::with('user')->findOrFail($id);

            // Check if deposit is already processed
            if ($deposit->status != 0) {
                return redirect()->back()->with('error', 'Deposit has already been processed.');
            }

            // Update deposit status
            $deposit->status = 1;
            $deposit->save();

            // Credit user's account based on wallet type
            $user = $deposit->user;
            switch ($deposit->wallet_type) {
                case 'trading':
                    $user->balance += $deposit->amount;
                    break;
                case 'holding':
                    $user->holding_balance += $deposit->amount;
                    break;
                case 'staking':
                    $user->staking_balance += $deposit->amount;
                    break;
                default:
                    $user->balance += $deposit->amount; // Default to trading balance
            }
            $user->save();

            // Send approval email
            try {
                Mail::to($deposit->user->email)->send(new ApproveDepositMail($deposit));
            } catch (\Exception $e) {
                \Log::error('Failed to send deposit approval email: ' . $e->getMessage());
            }

            return redirect()->back()->with('success', 'Deposit approved successfully! User account has been credited.');

        } catch (\Exception $e) {
            \Log::error('Deposit approval failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to approve deposit. Please try again.');
        }
    }

    /**
     * Decline a deposit
     */
    public function declineDeposit($id)
    {
        try {
            $deposit = Deposit::with('user')->findOrFail($id);

            // Check if deposit is already processed
            if ($deposit->status != 0) {
                return redirect()->back()->with('error', 'Deposit has already been processed.');
            }

            // Update deposit status
            $deposit->status = 2;
            $deposit->save();

            // Send decline email
            try {
                Mail::to($deposit->user->email)->send(new DeclineDepositMail($deposit));
            } catch (\Exception $e) {
                \Log::error('Failed to send deposit decline email: ' . $e->getMessage());
            }

            return redirect()->back()->with('success', 'Deposit declined successfully.');

        } catch (\Exception $e) {
            \Log::error('Deposit decline failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to decline deposit. Please try again.');
        }
    }

    /**
     * Delete a deposit
     */
    public function deleteDeposit($id)
    {
        try {
            $deposit = Deposit::findOrFail($id);

            // Delete proof file if it exists
            if ($deposit->proof && Storage::disk('public')->exists($deposit->proof)) {
                Storage::disk('public')->delete($deposit->proof);
            }

            $deposit->delete();

            return redirect()->back()->with('success', 'Deposit deleted successfully.');

        } catch (\Exception $e) {
            \Log::error('Deposit deletion failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete deposit. Please try again.');
        }
    }

    /**
     * Display all withdrawals
     */
    public function withdrawal()
    {
        $withdrawal = Withdrawal::with('user')->latest()->get();
        return view('admin.transactions.withdrawal', compact('withdrawal'));
    }

    /**
     * Approve a withdrawal
     */
    public function approveWithdrawal($id)
    {
        try {
            $withdraw = Withdrawal::with('user')->findOrFail($id);
            
            if ($withdraw->status != 0) {
                return redirect()->back()->with('error', 'Withdrawal has already been processed.');
            }

            $withdraw->status = 1;
            $withdraw->save();

            try {
                Mail::to($withdraw->user->email)->send(new ApproveWithdrawalMail($withdraw));
            } catch (\Exception $e) {
                \Log::error('Failed to send withdrawal approval email: ' . $e->getMessage());
            }

            return redirect()->back()->with('success', 'Withdrawal approved successfully.');

        } catch (\Exception $e) {
            \Log::error('Withdrawal approval failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to approve withdrawal. Please try again.');
        }
    }

    /**
     * Decline a withdrawal and refund user's balance
     */
    public function declineWithdrawal($id)
    {
        try {
            $withdraw = Withdrawal::with('user')->findOrFail($id);
            
            if ($withdraw->status != 0) {
                return redirect()->back()->with('error', 'Withdrawal has already been processed.');
            }

            $withdraw->status = 2;
            $withdraw->save();

            // Refund user's balance
            $user = $withdraw->user;
            $user->balance += $withdraw->amount;
            $user->save();

            try {
                Mail::to($withdraw->user->email)->send(new ApproveWithdrawalMail($withdraw));
            } catch (\Exception $e) {
                \Log::error('Failed to send withdrawal decline email: ' . $e->getMessage());
            }

            return redirect()->back()->with('success', 'Withdrawal declined and user balance refunded.');

        } catch (\Exception $e) {
            \Log::error('Withdrawal decline failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to decline withdrawal. Please try again.');
        }
    }
}
