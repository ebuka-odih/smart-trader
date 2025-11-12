<?php

namespace Tests\Feature;

use App\Models\Trade;
use App\Models\TradePair;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTradeCreationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create an admin user
        $this->admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);
        
        // Create a regular user with balance
        $this->user = User::factory()->create([
            'role' => 'user',
            'email' => 'user@test.com',
            'balance' => 1000.00,
        ]);
        
        // Create a trade pair (using create method which handles UUID generation)
        $this->tradePair = TradePair::create([
            'type' => 'crypto',
            'pair' => 'BTC/USDT',
            'current_price' => 50000.00,
            'price_change_24h' => 2.5,
        ]);
    }

    /** @test */
    public function admin_can_place_trade_for_user()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.trade.store'), [
            'user_id' => $this->user->id,
            'trade_pair_id' => $this->tradePair->id,
            'amount' => 100.00,
            'leverage' => 10,
            'duration' => 60,
            'action_type' => 'buy',
            'redirect_to' => 'place',
        ]);

        $response->assertRedirect(route('admin.trade.place'));
        $response->assertSessionHas('success', 'Trade placed successfully!');

        // Verify trade was created
        $this->assertDatabaseHas('trades', [
            'user_id' => $this->user->id,
            'trade_pair_id' => $this->tradePair->id,
            'amount' => 100.00,
            'leverage' => 10,
            'duration' => 60,
            'action_type' => 'buy',
            'status' => 'open',
        ]);

        // Verify user balance was deducted
        $this->user->refresh();
        $this->assertEquals(900.00, (float) $this->user->balance);
    }

    /** @test */
    public function admin_can_place_sell_trade_for_user()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.trade.store'), [
            'user_id' => $this->user->id,
            'trade_pair_id' => $this->tradePair->id,
            'amount' => 50.00,
            'leverage' => 5,
            'duration' => 30,
            'action_type' => 'sell',
            'redirect_to' => 'place',
        ]);

        $response->assertRedirect(route('admin.trade.place'));
        $response->assertSessionHas('success', 'Trade placed successfully!');

        // Verify trade was created with sell action
        $this->assertDatabaseHas('trades', [
            'user_id' => $this->user->id,
            'action_type' => 'sell',
            'amount' => 50.00,
        ]);

        // Verify user balance was deducted
        $this->user->refresh();
        $this->assertEquals(950.00, (float) $this->user->balance);
    }

    /** @test */
    public function trade_creation_fails_with_insufficient_balance()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.trade.store'), [
            'user_id' => $this->user->id,
            'trade_pair_id' => $this->tradePair->id,
            'amount' => 1500.00, // More than user's balance
            'leverage' => 10,
            'duration' => 60,
            'action_type' => 'buy',
            'redirect_to' => 'place',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');

        // Verify trade was NOT created
        $this->assertDatabaseMissing('trades', [
            'user_id' => $this->user->id,
            'amount' => 1500.00,
        ]);

        // Verify user balance was NOT changed
        $this->user->refresh();
        $this->assertEquals(1000.00, (float) $this->user->balance);
    }

    /** @test */
    public function trade_creation_validates_required_fields()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.trade.store'), [
            // Missing required fields
        ]);

        $response->assertSessionHasErrors(['user_id', 'amount', 'trade_pair_id', 'leverage', 'duration', 'action_type']);
    }

    /** @test */
    public function trade_creation_validates_user_exists()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.trade.store'), [
            'user_id' => 'non-existent-uuid',
            'trade_pair_id' => $this->tradePair->id,
            'amount' => 100.00,
            'leverage' => 10,
            'duration' => 60,
            'action_type' => 'buy',
        ]);

        $response->assertSessionHasErrors(['user_id']);
    }

    /** @test */
    public function trade_creation_validates_trade_pair_exists()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.trade.store'), [
            'user_id' => $this->user->id,
            'trade_pair_id' => 'non-existent-uuid',
            'amount' => 100.00,
            'leverage' => 10,
            'duration' => 60,
            'action_type' => 'buy',
        ]);

        $response->assertSessionHasErrors(['trade_pair_id']);
    }

    /** @test */
    public function trade_creation_validates_amount_minimum()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.trade.store'), [
            'user_id' => $this->user->id,
            'trade_pair_id' => $this->tradePair->id,
            'amount' => 0.001, // Less than minimum 0.01
            'leverage' => 10,
            'duration' => 60,
            'action_type' => 'buy',
        ]);

        $response->assertSessionHasErrors(['amount']);
    }

    /** @test */
    public function trade_creation_validates_leverage_range()
    {
        $this->actingAs($this->admin);

        // Test leverage too low
        $response = $this->post(route('admin.trade.store'), [
            'user_id' => $this->user->id,
            'trade_pair_id' => $this->tradePair->id,
            'amount' => 100.00,
            'leverage' => 0, // Invalid
            'duration' => 60,
            'action_type' => 'buy',
        ]);

        $response->assertSessionHasErrors(['leverage']);

        // Test leverage too high
        $response = $this->post(route('admin.trade.store'), [
            'user_id' => $this->user->id,
            'trade_pair_id' => $this->tradePair->id,
            'amount' => 100.00,
            'leverage' => 101, // Invalid
            'duration' => 60,
            'action_type' => 'buy',
        ]);

        $response->assertSessionHasErrors(['leverage']);
    }

    /** @test */
    public function trade_creation_validates_action_type()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.trade.store'), [
            'user_id' => $this->user->id,
            'trade_pair_id' => $this->tradePair->id,
            'amount' => 100.00,
            'leverage' => 10,
            'duration' => 60,
            'action_type' => 'invalid', // Invalid action type
        ]);

        $response->assertSessionHasErrors(['action_type']);
    }

    /** @test */
    public function trade_redirects_to_history_when_specified()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.trade.store'), [
            'user_id' => $this->user->id,
            'trade_pair_id' => $this->tradePair->id,
            'amount' => 100.00,
            'leverage' => 10,
            'duration' => 60,
            'action_type' => 'buy',
            'redirect_to' => 'history',
        ]);

        $response->assertRedirect(route('admin.trade.history'));
    }

    /** @test */
    public function trade_redirects_to_open_trades_by_default()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.trade.store'), [
            'user_id' => $this->user->id,
            'trade_pair_id' => $this->tradePair->id,
            'amount' => 100.00,
            'leverage' => 10,
            'duration' => 60,
            'action_type' => 'buy',
            // No redirect_to specified
        ]);

        $response->assertRedirect(route('admin.openTrades'));
    }
}

