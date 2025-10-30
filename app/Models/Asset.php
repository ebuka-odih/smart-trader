<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'symbol', 'name', 'type', 'current_price', 'market_cap',
        'volume_24h', 'price_change_24h', 'price_change_percentage_24h',
        'is_active'
    ];

    protected $casts = [
        'current_price' => 'decimal:8',
        'market_cap' => 'decimal:2',
        'volume_24h' => 'decimal:2',
        'price_change_24h' => 'decimal:4',
        'price_change_percentage_24h' => 'decimal:4',
        'is_active' => 'boolean',
        'last_updated' => 'datetime',
    ];

    public function holdings(): HasMany
    {
        return $this->hasMany(UserHolding::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(HoldingTransaction::class);
    }

    /**
     * Get a canonical short symbol to display for the asset.
     * For crypto, use the full ticker (e.g., BTC, ETH), not first 2 letters.
     */
    public function getShortSymbol(): string
    {
        return strtoupper($this->symbol ?? '');
    }

    /**
     * Get the recommended icon color for the asset based on its symbol.
     * Returns a hex color string. Falls back to a neutral color if unknown.
     */
    public function getIconColor(): string
    {
        $symbol = strtoupper($this->symbol ?? '');

        // Only map well-known crypto brand colors
        $cryptoColors = [
            'BTC' => '#F7931A', // Bitcoin orange
            'ETH' => '#3C3C3D', // Ethereum gray
            'BNB' => '#F3BA2F', // BNB yellow
            'ADA' => '#0033AD', // Cardano blue
            'SOL' => '#14F195', // Solana mint
            'XRP' => '#23292F', // XRP black
            'DOT' => '#E6007A', // Polkadot pink
            'MATIC' => '#8247E5', // Polygon purple
            'LINK' => '#2A5ADA', // Chainlink blue
            'UNI' => '#FF007A', // Uniswap pink
            'LTC' => '#345C9C', // Litecoin blue
            'DOGE' => '#C2A633', // Dogecoin gold
            'TRX' => '#C40000', // TRON red
            'AVAX' => '#E84142', // Avalanche red
            'SHIB' => '#F00500', // Shiba red
            'ATOM' => '#2E3148', // Cosmos dark
            'ETC' => '#328332', // Ethereum Classic green
            'FIL' => '#0090FF', // Filecoin blue
            'NEAR' => '#000000', // NEAR black
            'APT' => '#08E89A', // Aptos green
            'ARB' => '#28A0F0', // Arbitrum blue
            'OP' => '#FF0420', // Optimism red
            'ALGO' => '#000000', // Algorand black
            'XLM' => '#14B6E7', // Stellar blue
            'TON' => '#0098EA', // TON blue
            'SUI' => '#6FBCF0', // Sui blue
            'PEPE' => '#22C55E', // Pepe green
            'INJ' => '#0C0C0C', // Injective dark
            'TIA' => '#3B82F6', // Celestia blue
        ];

        return $cryptoColors[$symbol] ?? '#475569'; // default: slate-600
    }
}
