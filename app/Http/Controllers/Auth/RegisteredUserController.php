<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'password' => Hash::make($request->password),
        ]);

        // Generate verification code
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $user->update([
            'verification_code' => $verificationCode,
            'verification_code_expires_at' => now()->addMinutes(10),
        ]);

        // Send verification email
        $this->sendVerificationEmail($user, $verificationCode);

        event(new Registered($user));

        // Redirect to verification page instead of logging in
        return redirect()->route('verification.show', ['email' => $user->email])->with('success', 'Registration successful! Please check your email for the verification code.');
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

        try {
            Mail::send('emails.verification', $data, function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Verify Your Email Address');
            });
            
            \Log::info('Verification email sent successfully to: ' . $user->email);
        } catch (\Exception $e) {
            \Log::error('Failed to send verification email to: ' . $user->email . ' Error: ' . $e->getMessage());
            throw $e;
        }
    }
}
