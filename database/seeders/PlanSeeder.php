<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Trading Plans
        Plan::create([
            'name' => 'Gold Trading Plan',
            'type' => 'trading',
            'description' => 'Premium trading plan with maximum features',
            'price' => 299.99,
            'original_price' => 399.99,
            'currency' => '$',
            'is_active' => true,
            'sort_order' => 1,
            'pairs' => '400+ Pairs',
            'leverage' => 'Leverage up to 1:500',
            'spreads' => 'Spreads from 0.1 pips',
            'swap_fees' => 'No Swap Fees',
            'minimum_deposit' => 1000.00,
            'max_lot_size' => '100 lots',
        ]);

        Plan::create([
            'name' => 'Silver Trading Plan',
            'type' => 'trading',
            'description' => 'Standard trading plan with good features',
            'price' => 149.99,
            'original_price' => 199.99,
            'currency' => '$',
            'is_active' => true,
            'sort_order' => 2,
            'pairs' => '300+ Pairs',
            'leverage' => 'Leverage up to 1:500',
            'spreads' => 'Spreads from 0.8 pips',
            'swap_fees' => 'Standard Swap Fees',
            'minimum_deposit' => 500.00,
            'max_lot_size' => '50 lots',
        ]);

        Plan::create([
            'name' => 'Bronze Trading Plan',
            'type' => 'trading',
            'description' => 'Basic trading plan for beginners',
            'price' => 79.99,
            'original_price' => 99.99,
            'currency' => '$',
            'is_active' => true,
            'sort_order' => 3,
            'pairs' => '200+ Pairs',
            'leverage' => 'Leverage up to 1:500',
            'spreads' => 'Spreads from 1.2 pips',
            'swap_fees' => 'Standard Swap Fees',
            'minimum_deposit' => 250.00,
            'max_lot_size' => '25 lots',
        ]);

        // Signal Plans
        Plan::create([
            'name' => 'Gold Signal Plan',
            'type' => 'signal',
            'description' => 'Premium signal service with high accuracy',
            'price' => 199.99,
            'original_price' => 299.99,
            'currency' => '$',
            'is_active' => true,
            'sort_order' => 1,
            'signal_strength' => 25,
            'daily_signals' => 15,
            'success_rate' => 95.5,
            'signal_duration' => 30,
        ]);

        Plan::create([
            'name' => 'Silver Signal Plan',
            'type' => 'signal',
            'description' => 'Standard signal service with good accuracy',
            'price' => 99.99,
            'original_price' => 149.99,
            'currency' => '$',
            'is_active' => true,
            'sort_order' => 2,
            'signal_strength' => 15,
            'daily_signals' => 10,
            'success_rate' => 88.0,
            'signal_duration' => 30,
        ]);

        Plan::create([
            'name' => 'Bronze Signal Plan',
            'type' => 'signal',
            'description' => 'Basic signal service for beginners',
            'price' => 49.99,
            'original_price' => 79.99,
            'currency' => '$',
            'is_active' => true,
            'sort_order' => 3,
            'signal_strength' => 5,
            'daily_signals' => 5,
            'success_rate' => 80.0,
            'signal_duration' => 30,
        ]);

        // Mining Plans
        Plan::create([
            'name' => 'Gold Mining Plan',
            'type' => 'mining',
            'description' => 'Enterprise mining solution with maximum hashrate',
            'price' => 1845.41,
            'original_price' => 2500.00,
            'currency' => '£',
            'is_active' => true,
            'sort_order' => 1,
            'hashrate' => '1000 TH/s',
            'equipment' => '~ 10 Antminer S19',
            'downtime' => 'No Downtime',
            'electricity_costs' => 'No Electricity Costs',
            'mining_duration' => 30,
        ]);

        Plan::create([
            'name' => 'Silver Mining Plan',
            'type' => 'mining',
            'description' => 'Professional mining solution with good hashrate',
            'price' => 442.90,
            'original_price' => 600.00,
            'currency' => '£',
            'is_active' => true,
            'sort_order' => 2,
            'hashrate' => '250 TH/s',
            'equipment' => '~ 2.5 Antminer S19',
            'downtime' => 'No Downtime',
            'electricity_costs' => 'No Electricity Costs',
            'mining_duration' => 30,
        ]);

        Plan::create([
            'name' => 'Bronze Mining Plan',
            'type' => 'mining',
            'description' => 'Starter mining solution for beginners',
            'price' => 184.54,
            'original_price' => 250.00,
            'currency' => '£',
            'is_active' => true,
            'sort_order' => 3,
            'hashrate' => '100 TH/s',
            'equipment' => '~ 1 Antminer S19',
            'downtime' => 'No Downtime',
            'electricity_costs' => 'No Electricity Costs',
            'mining_duration' => 30,
        ]);

        // Staking Plans
        Plan::create([
            'name' => 'Gold Staking Plan',
            'type' => 'staking',
            'description' => 'Premium staking with highest APY rates',
            'price' => 299.99,
            'original_price' => 399.99,
            'currency' => '$',
            'is_active' => true,
            'sort_order' => 1,
            'apy_rate' => 18.5,
            'minimum_amount' => 1000.00,
            'reward_frequency' => 'Daily',
            'lock_period' => 30,
            'staking_duration' => 365,
        ]);

        Plan::create([
            'name' => 'Silver Staking Plan',
            'type' => 'staking',
            'description' => 'Standard staking with good APY rates',
            'price' => 149.99,
            'original_price' => 199.99,
            'currency' => '$',
            'is_active' => true,
            'sort_order' => 2,
            'apy_rate' => 12.5,
            'minimum_amount' => 500.00,
            'reward_frequency' => 'Weekly',
            'lock_period' => 15,
            'staking_duration' => 180,
        ]);

        Plan::create([
            'name' => 'Bronze Staking Plan',
            'type' => 'staking',
            'description' => 'Basic staking for beginners',
            'price' => 79.99,
            'original_price' => 99.99,
            'currency' => '$',
            'is_active' => true,
            'sort_order' => 3,
            'apy_rate' => 8.0,
            'minimum_amount' => 250.00,
            'reward_frequency' => 'Monthly',
            'lock_period' => 7,
            'staking_duration' => 90,
        ]);
    }
}
