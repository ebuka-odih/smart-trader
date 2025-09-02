<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crypto Assets
        $cryptoAssets = [
            ['symbol' => 'BTC', 'name' => 'Bitcoin', 'type' => 'crypto', 'current_price' => 45000.00, 'price_change_24h' => 2.5, 'market_cap' => 850000000000],
            ['symbol' => 'ETH', 'name' => 'Ethereum', 'type' => 'crypto', 'current_price' => 3200.00, 'price_change_24h' => -1.2, 'market_cap' => 380000000000],
            ['symbol' => 'BNB', 'name' => 'Binance Coin', 'type' => 'crypto', 'current_price' => 320.00, 'price_change_24h' => 0.8, 'market_cap' => 48000000000],
            ['symbol' => 'ADA', 'name' => 'Cardano', 'type' => 'crypto', 'current_price' => 0.45, 'price_change_24h' => 3.1, 'market_cap' => 15000000000],
            ['symbol' => 'SOL', 'name' => 'Solana', 'type' => 'crypto', 'current_price' => 95.00, 'price_change_24h' => -0.5, 'market_cap' => 42000000000],
            ['symbol' => 'XRP', 'name' => 'Ripple', 'type' => 'crypto', 'current_price' => 0.52, 'price_change_24h' => 1.8, 'market_cap' => 28000000000],
            ['symbol' => 'DOT', 'name' => 'Polkadot', 'type' => 'crypto', 'current_price' => 7.25, 'price_change_24h' => -2.1, 'market_cap' => 8500000000],
            ['symbol' => 'MATIC', 'name' => 'Polygon', 'type' => 'crypto', 'current_price' => 0.85, 'price_change_24h' => 4.2, 'market_cap' => 8500000000],
            ['symbol' => 'LINK', 'name' => 'Chainlink', 'type' => 'crypto', 'current_price' => 15.80, 'price_change_24h' => -0.7, 'market_cap' => 8500000000],
            ['symbol' => 'UNI', 'name' => 'Uniswap', 'type' => 'crypto', 'current_price' => 8.45, 'price_change_24h' => 1.5, 'market_cap' => 5000000000],
            ['symbol' => 'AVAX', 'name' => 'Avalanche', 'type' => 'crypto', 'current_price' => 35.60, 'price_change_24h' => -1.8, 'market_cap' => 12000000000],
            ['symbol' => 'ATOM', 'name' => 'Cosmos', 'type' => 'crypto', 'current_price' => 12.30, 'price_change_24h' => 2.3, 'market_cap' => 4500000000],
            ['symbol' => 'LTC', 'name' => 'Litecoin', 'type' => 'crypto', 'current_price' => 68.50, 'price_change_24h' => 0.9, 'market_cap' => 4800000000],
            ['symbol' => 'BCH', 'name' => 'Bitcoin Cash', 'type' => 'crypto', 'current_price' => 245.80, 'price_change_24h' => -0.4, 'market_cap' => 4800000000],
            ['symbol' => 'XLM', 'name' => 'Stellar', 'type' => 'crypto', 'current_price' => 0.12, 'price_change_24h' => 1.2, 'market_cap' => 3200000000],
        ];

        // Stock Assets
        $stockAssets = [
            ['symbol' => 'AAPL', 'name' => 'Apple Inc.', 'type' => 'stock', 'current_price' => 175.50, 'price_change_24h' => 1.2, 'market_cap' => 2750000000000],
            ['symbol' => 'GOOGL', 'name' => 'Alphabet Inc.', 'type' => 'stock', 'current_price' => 142.80, 'price_change_24h' => -0.8, 'market_cap' => 1800000000000],
            ['symbol' => 'MSFT', 'name' => 'Microsoft Corporation', 'type' => 'stock', 'current_price' => 330.25, 'price_change_24h' => 0.9, 'market_cap' => 2450000000000],
            ['symbol' => 'TSLA', 'name' => 'Tesla Inc.', 'type' => 'stock', 'current_price' => 245.60, 'price_change_24h' => 2.1, 'market_cap' => 780000000000],
            ['symbol' => 'AMZN', 'name' => 'Amazon.com Inc.', 'type' => 'stock', 'current_price' => 135.40, 'price_change_24h' => -0.3, 'market_cap' => 1400000000000],
        ];

        foreach ($cryptoAssets as $asset) {
            Asset::updateOrCreate(
                ['symbol' => $asset['symbol'], 'type' => $asset['type']],
                $asset
            );
        }

        foreach ($stockAssets as $asset) {
            Asset::updateOrCreate(
                ['symbol' => $asset['symbol'], 'type' => $asset['type']],
                $asset
            );
        }

        $this->command->info('Assets seeded successfully!');
    }
}
