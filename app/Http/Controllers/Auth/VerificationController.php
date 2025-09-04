<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VerificationController extends Controller
{
    /**
     * Display the verification page.
     */
    public function show(): View
    {
        return view('auth.verify');
    }

    /**
     * Verify the verification code.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $user = User::where('verification_code', $request->code)
                   ->where('verification_code_expires_at', '>', now())
                   ->first();

        if (!$user) {
            return back()->withErrors(['code' => 'Invalid or expired verification code.']);
        }

        // Mark email as verified and clear verification code
        $user->update([
            'email_verified_at' => now(),
            'verification_code' => null,
            'verification_code_expires_at' => null,
        ]);

        // Log the user in
        auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'Email verified successfully! Welcome to your dashboard.');
    }

    /**
     * Resend verification code.
     */
    public function resend(Request $request): RedirectResponse
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        if ($user->email_verified_at) {
            return back()->withErrors(['email' => 'Email is already verified.']);
        }

        // Generate new verification code
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $user->update([
            'verification_code' => $verificationCode,
            'verification_code_expires_at' => now()->addMinutes(10),
        ]);

        // Send verification email
        $this->sendVerificationEmail($user, $verificationCode);

        return back()->with('success', 'Verification code has been resent to your email.');
    }

    /**
     * Send verification email.
     */
    private function sendVerificationEmail(User $user, string $code): void
    {
        $data = [
            'name' => $user->name,
            'code' => $code,
            'expires_at' => now()->addMinutes(10)->format('H:i'),
        ];

        Mail::send('emails.verification', $data, function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Verify Your Email Address');
        });
    }
}
