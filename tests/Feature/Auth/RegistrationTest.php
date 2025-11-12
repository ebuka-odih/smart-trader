<?php

namespace Tests\Feature\Auth;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Referral Code');
    }

    public function test_new_users_receive_referral_code_on_registration(): void
    {
        $response = $this->post('/register', $this->validRegistrationData());

        $response->assertRedirect(route('verification.show', ['email' => 'test@example.com'], absolute: false));
        $this->assertGuest();

        $user = User::where('email', 'test@example.com')->first();
        $this->assertNotNull($user);
        $this->assertNotEmpty($user->referral_code);
        $this->assertNull($user->referred_by);
    }

    public function test_users_can_register_with_referral_code(): void
    {
        $referrer = User::factory()->create();

        $response = $this->post('/register', $this->validRegistrationData([
            'email' => 'invitee@example.com',
            'username' => 'inviteeuser',
            'referral_code' => $referrer->referral_code,
        ]));

        $response->assertRedirect(route('verification.show', ['email' => 'invitee@example.com'], absolute: false));

        $newUser = User::where('email', 'invitee@example.com')->first();
        $this->assertSame($referrer->id, $newUser->referred_by);

        $this->assertDatabaseHas('referrals', [
            'referrer_id' => $referrer->id,
            'referred_user_id' => $newUser->id,
        ]);
    }

    public function test_user_dashboard_displays_referral_details(): void
    {
        $user = User::factory()->create([
            'referral_balance' => 150,
        ]);

        $invitee = User::factory()->create([
            'referral_balance' => 0,
            'referred_by' => $user->id,
        ]);

        Referral::create([
            'referrer_id' => $user->id,
            'referred_user_id' => $invitee->id,
            'reward_amount' => 25,
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee($user->referral_code);
        $response->assertSee('Total Referrals');
        $response->assertSee((string) $user->referrals()->count());
    }

    private function validRegistrationData(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'phone' => '+1234567890',
            'country' => 'United States',
            'currency' => 'USD',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'registration_time' => time() - 10,
            'website' => '',
            'phone_alt' => '',
            'company' => '',
        ], $overrides);
    }
}
