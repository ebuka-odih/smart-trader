<?php

namespace App\Services;

use App\Models\Asset;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AssetPriceService
{
    private $coinMarketCapApi;
    private $alphaVantageApi = 'https://www.alphavantage.co/query';
    private $alphaVantageKey;
    private $coinMarketCapKey;

    public function __construct()
    {
        $this->alphaVantageKey = config('services.alpha_vantage.key');
        $this->coinMarketCapKey = config('services.coinmarketcap.key');
        $this->coinMarketCapApi = config('services.coinmarketcap.base_url');
    }

    public function updateCryptoPrices(): void
    {
        try {
            $cryptoAssets = Asset::where('type', 'crypto')
                ->where('is_active', true)
                ->get();
            
            if ($cryptoAssets->isEmpty()) {
                Log::info('No crypto assets found to update');
                return;
            }
            
            // Group assets by chunks to avoid rate limits
            $chunks = $cryptoAssets->chunk(100); // CoinMarketCap allows up to 100 symbols per request
            
            foreach ($chunks as $chunk) {
                $symbols = $chunk->pluck('symbol')->toArray();
                $this->updateCryptoBatch($symbols);
                
                // Rate limiting - be conservative with CoinMarketCap
                sleep(1);
            }
            
            Log::info('Crypto prices updated successfully', ['count' => $cryptoAssets->count()]);
        } catch (\Exception $e) {
            Log::error('Failed to update crypto prices: ' . $e->getMessage());
        }
    }

    public function updateStockPrices(): void
    {
        try {
            $stockAssets = Asset::where('type', 'stock')
                ->where('is_active', true)
                ->get();
            
            if ($stockAssets->isEmpty()) {
                Log::info('No stock assets found to update');
                return;
            }
            
            foreach ($stockAssets as $asset) {
                $this->updateStockPrice($asset);
                
                // Rate limiting for Alpha Vantage (5 calls per minute)
                sleep(12);
            }
            
            Log::info('Stock prices updated successfully', ['count' => $stockAssets->count()]);
        } catch (\Exception $e) {
            Log::error('Failed to update stock prices: ' . $e->getMessage());
        }
    }

    private function updateCryptoBatch(array $symbols): void
    {
        try {
            if (!$this->coinMarketCapKey) {
                Log::warning('CoinMarketCap API key not configured');
                return;
            }

            $response = Http::timeout(30)
                ->withHeaders([
                    'X-CMC_PRO_API_KEY' => $this->coinMarketCapKey,
                    'Accept' => 'application/json'
                ])
                ->get($this->coinMarketCapApi . '/cryptocurrency/quotes/latest', [
                    'symbol' => implode(',', $symbols),
                    'convert' => 'USD'
                ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['data'])) {
                    foreach ($data['data'] as $symbol => $cryptoData) {
                        $asset = Asset::where('symbol', $symbol)->first();
                        if ($asset && isset($cryptoData['quote']['USD'])) {
                            $quote = $cryptoData['quote']['USD'];
                            
                            $asset->update([
                                'current_price' => $quote['price'] ?? 0,
                                'price_change_24h' => $quote['volume_change_24h'] ?? 0,
                                'price_change_percentage_24h' => $quote['percent_change_24h'] ?? 0,
                                'market_cap' => $quote['market_cap'] ?? 0,
                                'volume_24h' => $quote['volume_24h'] ?? 0,
                                'last_updated' => now(),
                            ]);
                        }
                    }
                }
            } else {
                Log::warning('CoinMarketCap API request failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error updating crypto batch: ' . $e->getMessage());
        }
    }

    private function updateStockPrice(Asset $asset): void
    {
        try {
            if (!$this->alphaVantageKey) {
                Log::warning('Alpha Vantage API key not configured');
                return;
            }

            $response = Http::timeout(30)->get($this->alphaVantageApi, [
                'function' => 'GLOBAL_QUOTE',
                'symbol' => $asset->symbol,
                'apikey' => $this->alphaVantageKey
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['Global Quote'])) {
                    $quote = $data['Global Quote'];
                    
                    $asset->update([
                        'current_price' => $quote['05. price'] ?? 0,
                        'price_change_24h' => $quote['09. change'] ?? 0,
                        'price_change_percentage_24h' => $quote['10. change percent'] ?? 0,
                        'volume_24h' => $quote['06. volume'] ?? 0,
                        'last_updated' => now(),
                    ]);
                }
            } else {
                Log::warning('Alpha Vantage API request failed', [
                    'symbol' => $asset->symbol,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error updating stock price for ' . $asset->symbol . ': ' . $e->getMessage());
        }
    }

    public function getCryptoAssets(): array
    {
        try {
            if (!$this->coinMarketCapKey) {
                Log::warning('CoinMarketCap API key not configured');
                return [];
            }

            $response = Http::timeout(30)
                ->withHeaders([
                    'X-CMC_PRO_API_KEY' => $this->coinMarketCapKey,
                    'Accept' => 'application/json'
                ])
                ->get($this->coinMarketCapApi . '/cryptocurrency/map', [
                    'limit' => 100,
                    'sort' => 'cmc_rank'
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['data'] ?? [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching crypto assets: ' . $e->getMessage());
        }

        return [];
    }

    public function getCryptoMetadata(string $symbol): ?array
    {
        try {
            if (!$this->coinMarketCapKey) {
                return null;
            }

            $response = Http::timeout(30)
                ->withHeaders([
                    'X-CMC_PRO_API_KEY' => $this->coinMarketCapKey,
                    'Accept' => 'application/json'
                ])
                ->get($this->coinMarketCapApi . '/cryptocurrency/info', [
                    'symbol' => $symbol
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['data'][$symbol] ?? null;
            }
        } catch (\Exception $e) {
            Log::error('Error fetching crypto metadata for ' . $symbol . ': ' . $e->getMessage());
        }

        return null;
    }

    public function populateCryptoAssets(): void
    {
        try {
            Log::info('Starting crypto assets population from CoinMarketCap');
            
            $cryptoAssets = $this->getCryptoAssets();
            
            if (empty($cryptoAssets)) {
                Log::warning('No crypto assets received from CoinMarketCap');
                return;
            }
            
            $count = 0;
            foreach ($cryptoAssets as $crypto) {
                $symbol = $crypto['symbol'];
                $name = $crypto['name'];
                
                // Check if asset already exists
                $existingAsset = Asset::where('symbol', $symbol)->first();
                
                if (!$existingAsset) {
                    Asset::create([
                        'symbol' => $symbol,
                        'name' => $name,
                        'type' => 'crypto',
                        'current_price' => 0, // Will be updated by price update
                        'is_active' => true,
                    ]);
                    $count++;
                }
            }
            
            Log::info('Crypto assets populated successfully', ['new_assets' => $count]);
            
            // Update prices for all crypto assets
            $this->updateCryptoPrices();
            
        } catch (\Exception $e) {
            Log::error('Error populating crypto assets: ' . $e->getMessage());
        }
    }
}
