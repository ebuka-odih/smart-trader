<?php

namespace App\Http\Controllers;

use App\Mail\AdminDepositMail;
use App\Mail\DepositMail;
use App\Models\Deposit;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DepositController extends Controller
{
    /**
     * Display the deposit page with user's deposit history
     */
     public function deposit()
    {
        $user = Auth::user();
        $wallets = PaymentMethod::all();
        $deposits = Deposit::whereUserId(auth()->id())
                          ->with('payment_method')
                          ->latest()
                          ->get();
        
        return view('dashboard.transactions.deposit', compact('user', 'wallets', 'deposits'));
    }

    /**
     * Process a new deposit submission
     */
    public function payment(Request $request)
    {
        try {
        $validated = $request->validate([
                'amount' => 'required|numeric|min:0.01',
                'payment_method_id' => 'required|exists:payment_methods,id',
                'wallet_type' => 'required|in:trading,holding,staking',
                'proof' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:10240',
            ], [
                'amount.required' => 'Please enter an amount.',
                'amount.numeric' => 'Amount must be a valid number.',
                'amount.min' => 'Amount must be at least $0.01.',
                'payment_method_id.required' => 'Please select a payment method.',
                'payment_method_id.exists' => 'Selected payment method is invalid.',
                'wallet_type.required' => 'Please select a wallet type.',
                'wallet_type.in' => 'Selected wallet type is invalid.',
                'proof.required' => 'Please upload payment proof.',
                'proof.file' => 'Payment proof must be a file.',
                'proof.mimes' => 'Payment proof must be an image (JPEG, PNG, JPG, GIF, SVG) or PDF.',
                'proof.max' => 'Payment proof file size must be less than 10MB.',
            ]);

            // Handle file upload
            $proofPath = null;
        if ($request->hasFile('proof')) {
                $file = $request->file('proof');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $proofPath = $file->storeAs('deposits', $fileName, 'public');
            }

            // Create deposit record
            $deposit = Deposit::create([
                'user_id' => Auth::id(),
                'amount' => $validated['amount'],
                'payment_method_id' => $validated['payment_method_id'],
                'wallet_type' => $validated['wallet_type'],
                'proof' => $proofPath,
                'status' => 0, // Pending by default
            ]);

            // Send email notifications
            try {
        $admin = User::where('role', 'admin')->first();
                if ($admin) {
        Mail::to(auth()->user()->email)->send(new DepositMail($deposit));
        Mail::to($admin->email)->send(new AdminDepositMail($deposit));
                }
            } catch (\Exception $e) {
                // Log email error but don't fail the deposit
                \Log::error('Failed to send deposit emails: ' . $e->getMessage());
            }

            return redirect()->route('user.deposit')->with('success', 'Deposit submitted successfully! Awaiting approval.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('user.deposit')
                           ->withErrors($e->validator)
                           ->withInput()
                           ->with('error', 'Please correct the errors below.');
        } catch (\Exception $e) {
            \Log::error('Deposit creation failed: ' . $e->getMessage());
            return redirect()->route('user.deposit')
                           ->with('error', 'An error occurred while processing your deposit. Please try again.')
                           ->withInput();
        }
    }

    /**
     * Cancel a pending deposit
     */
    public function cancelDeposit($id)
    {
        try {
            $deposit = Deposit::where('user_id', Auth::id())
                             ->where('id', $id)
                             ->where('status', 0) // Only pending deposits can be cancelled
                             ->firstOrFail();

            // Delete the proof file if it exists
            if ($deposit->proof && Storage::disk('public')->exists($deposit->proof)) {
                Storage::disk('public')->delete($deposit->proof);
            }

            $deposit->delete();

            return redirect()->back()->with('success', 'Deposit cancelled successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to cancel deposit. Please try again.');
        }
    }

    /**
     * View deposit proof
     */
    public function viewProof($id)
    {
        try {
            $deposit = Deposit::where('user_id', Auth::id())
                             ->where('id', $id)
                             ->firstOrFail();

            if (!$deposit->proof || !Storage::disk('public')->exists($deposit->proof)) {
                return redirect()->back()->with('error', 'Proof file not found.');
            }

            return Storage::disk('public')->response($deposit->proof);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to view proof. Please try again.');
        }
    }

    /**
     * Generate QR code for wallet address
     */
    public function generateQRCode(Request $request)
    {
                    try {
                $request->validate([
                    'address' => 'required|string|max:255'
                ]);

                $address = $request->input('address');
            
            // Generate QR code as SVG
            $qrCode = QrCode::format('svg')
                           ->size(200)
                           ->margin(1)
                           ->errorCorrection('H')
                           ->generate($address);

            // Convert QR code object to string
            $qrCodeString = (string) $qrCode;

            // Return SVG directly without storing file
            \Log::info('QR Code generated successfully', [
                'address' => $address,
                'format' => 'svg',
                'qr_code_length' => strlen($qrCodeString)
            ]);

            return response()->json([
                'success' => true,
                'qr_code_svg' => $qrCodeString
            ]);

        } catch (\Exception $e) {
            \Log::error('QR Code generation failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate QR code: ' . $e->getMessage()
            ], 500);
        }
    }
}
