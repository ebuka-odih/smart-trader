<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\TradePair;
use App\Models\Trade;
use Illuminate\Support\Str;

class CreateTestTradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a test user
        $user = User::where('role', 'user')->first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'testuser@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'balance' => 10000.00,
            ]);
            echo "Created test user: {$user->name} (Balance: $" . number_format($user->balance, 2) . ")\n";
        } else {
            // Ensure user has balance
            if ($user->balance < 1000) {
                $user->balance = 10000.00;
                $user->save();
            }
            echo "Using existing user: {$user->name} (Balance: $" . number_format($user->balance, 2) . ")\n";
        }

        // Get trade pairs
        $cryptoPairs = TradePair::where('type', 'crypto')->take(3)->get();
        $forexPairs = TradePair::where('type', 'forex')->take(2)->get();
        $stockPairs = TradePair::where('type', 'stock')->take(2)->get();
        
        $allPairs = $cryptoPairs->merge($forexPairs)->merge($stockPairs);
        
        if ($allPairs->isEmpty()) {
            echo "No trade pairs found. Please run TradePairSeeder first.\n";
            return;
        }

        $pairs = $allPairs->take(5);
        echo "Using " . $pairs->count() . " trade pairs\n\n";

        $initialBalance = $user->balance;
        $totalDeducted = 0;

        // Create open trades
        echo "Creating open trades...\n";
        $openTrades = [
            [
                'pair' => $pairs[0] ?? $pairs->first(),
                'amount' => 500.00,
                'leverage' => 10,
                'duration' => 60,
                'action_type' => 'buy',
            ],
            [
                'pair' => $pairs[1] ?? $pairs->first(),
                'amount' => 300.00,
                'leverage' => 5,
                'duration' => 120,
                'action_type' => 'sell',
            ],
            [
                'pair' => $pairs[2] ?? $pairs->first(),
                'amount' => 750.00,
                'leverage' => 20,
                'duration' => 1440,
                'action_type' => 'buy',
            ],
            [
                'pair' => $pairs[3] ?? $pairs->first(),
                'amount' => 250.00,
                'leverage' => 15,
                'duration' => 30,
                'action_type' => 'sell',
            ],
        ];

        foreach ($openTrades as $tradeData) {
            $trade = Trade::create([
                'user_id' => $user->id,
                'trade_pair_id' => $tradeData['pair']->id,
                'amount' => $tradeData['amount'],
                'status' => 'open',
                'leverage' => $tradeData['leverage'],
                'duration' => $tradeData['duration'],
                'action_type' => $tradeData['action_type'],
                'profit_loss' => 0,
            ]);
            
            $totalDeducted += $tradeData['amount'];
            echo "  ✓ Created open trade: {$tradeData['action_type']} {$tradeData['pair']->pair} - $" . number_format($tradeData['amount'], 2) . " (Leverage: {$tradeData['leverage']}x)\n";
        }

        // Create closed trades
        echo "\nCreating closed trades...\n";
        $closedTrades = [
            [
                'pair' => $pairs[0] ?? $pairs->first(),
                'amount' => 1000.00,
                'leverage' => 10,
                'duration' => 60,
                'action_type' => 'buy',
                'profit_loss' => 150.50,
            ],
            [
                'pair' => $pairs[1] ?? $pairs->first(),
                'amount' => 600.00,
                'leverage' => 5,
                'duration' => 120,
                'action_type' => 'sell',
                'profit_loss' => -75.25,
            ],
            [
                'pair' => $pairs[2] ?? $pairs->first(),
                'amount' => 800.00,
                'leverage' => 20,
                'duration' => 1440,
                'action_type' => 'buy',
                'profit_loss' => 200.00,
            ],
            [
                'pair' => $pairs[3] ?? $pairs->first(),
                'amount' => 400.00,
                'leverage' => 15,
                'duration' => 30,
                'action_type' => 'sell',
                'profit_loss' => -50.00,
            ],
            [
                'pair' => $pairs[4] ?? $pairs->first(),
                'amount' => 1200.00,
                'leverage' => 25,
                'duration' => 720,
                'action_type' => 'buy',
                'profit_loss' => 300.75,
            ],
        ];

        foreach ($closedTrades as $tradeData) {
            $trade = Trade::create([
                'user_id' => $user->id,
                'trade_pair_id' => $tradeData['pair']->id,
                'amount' => $tradeData['amount'],
                'status' => 'closed',
                'leverage' => $tradeData['leverage'],
                'duration' => $tradeData['duration'],
                'action_type' => $tradeData['action_type'],
                'profit_loss' => $tradeData['profit_loss'],
            ]);
            
            $totalDeducted += $tradeData['amount'];
            $sign = $tradeData['profit_loss'] >= 0 ? '+' : '';
            echo "  ✓ Created closed trade: {$tradeData['action_type']} {$tradeData['pair']->pair} - $" . number_format($tradeData['amount'], 2) . " (PnL: {$sign}$" . number_format($tradeData['profit_loss'], 2) . ")\n";
        }

        // Update user balance (deduct open trades only, closed trades already returned)
        $user->balance = $initialBalance - array_sum(array_column($openTrades, 'amount'));
        $user->save();

        echo "\n" . str_repeat('=', 60) . "\n";
        echo "Summary:\n";
        echo "  Open trades: " . count($openTrades) . "\n";
        echo "  Closed trades: " . count($closedTrades) . "\n";
        echo "  Total trades created: " . (count($openTrades) + count($closedTrades)) . "\n";
        echo "  User balance: $" . number_format($user->balance, 2) . " (deducted $" . number_format(array_sum(array_column($openTrades, 'amount')), 2) . " for open trades)\n";
        echo str_repeat('=', 60) . "\n";
    }
}

