<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type', // trading, signal, staking, mining
        'description',
        'price',
        'original_price',
        'min_funding',
        'max_funding',
        'currency',
        'is_active',
        'sort_order',
        
        // Trading plan specific fields
        'pairs',
        'leverage',
        'spreads',
        'swap_fees',
        'minimum_deposit',
        'max_lot_size',
        
        // Signal plan specific fields
        'signal_strength',
        'daily_signals',
        'success_rate',
        'signal_duration',
        
        // Mining plan specific fields
        'hashrate',
        'equipment',
        'downtime',
        'electricity_costs',
        'mining_duration',
        
        // Staking plan specific fields
        'apy_rate',
        'minimum_amount',
        'reward_frequency',
        'lock_period',
        'staking_duration',
        
        // Common fields
        'features',
        'terms_conditions'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'min_funding' => 'decimal:2',
        'max_funding' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'pairs' => 'string',
        'leverage' => 'decimal:2',
        'spreads' => 'decimal:2',
        'swap_fees' => 'decimal:2',
        'minimum_deposit' => 'decimal:2',
        'max_lot_size' => 'string',
        'signal_strength' => 'integer',
        'daily_signals' => 'integer',
        'success_rate' => 'decimal:2',
        'signal_duration' => 'integer',
        'hashrate' => 'string',
        'equipment' => 'string',
        'downtime' => 'string',
        'electricity_costs' => 'string',
        'mining_duration' => 'integer',
        'apy_rate' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'reward_frequency' => 'string',
        'lock_period' => 'integer',
        'staking_duration' => 'integer',
        'features' => 'array',
        'terms_conditions' => 'array',
    ];

    // Plan types constants
    const TYPE_TRADING = 'trading';
    const TYPE_SIGNAL = 'signal';
    const TYPE_STAKING = 'staking';
    const TYPE_MINING = 'mining';

    /**
     * Get all plan types
     */
    public static function getTypes()
    {
        return [
            self::TYPE_TRADING => 'Trading',
            self::TYPE_SIGNAL => 'Signal',
            self::TYPE_STAKING => 'Staking',
            self::TYPE_MINING => 'Mining',
        ];
    }

    /**
     * Scope to get plans by type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to get active plans
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }



    /**
     * Get trading plan specific data
     */
    public function getTradingDataAttribute()
    {
        if ($this->type !== self::TYPE_TRADING) {
            return null;
        }

        return [
            'pairs' => $this->pairs,
            'leverage' => $this->leverage,
            'spreads' => $this->spreads,
            'swap_fees' => $this->swap_fees,
            'minimum_deposit' => $this->minimum_deposit,
            'max_lot_size' => $this->max_lot_size,
        ];
    }

    /**
     * Get signal plan specific data
     */
    public function getSignalDataAttribute()
    {
        if ($this->type !== self::TYPE_SIGNAL) {
            return null;
        }

        return [
            'signal_strength' => $this->signal_strength,
            'daily_signals' => $this->daily_signals,
            'success_rate' => $this->success_rate,
            'signal_duration' => $this->signal_duration,
        ];
    }

    /**
     * Get mining plan specific data
     */
    public function getMiningDataAttribute()
    {
        if ($this->type !== self::TYPE_MINING) {
            return null;
        }

        return [
            'hashrate' => $this->hashrate,
            'equipment' => $this->equipment,
            'downtime' => $this->downtime,
            'electricity_costs' => $this->electricity_costs,
            'mining_duration' => $this->mining_duration,
        ];
    }

    /**
     * Get staking plan specific data
     */
    public function getStakingDataAttribute()
    {
        if ($this->type !== self::TYPE_STAKING) {
            return null;
        }

        return [
            'apy_rate' => $this->apy_rate,
            'minimum_amount' => $this->minimum_amount,
            'reward_frequency' => $this->reward_frequency,
            'lock_period' => $this->lock_period,
            'staking_duration' => $this->staking_duration,
        ];
    }

    /**
     * Get plan features as array
     */
    public function getFeaturesArrayAttribute()
    {
        return $this->features ?? [];
    }

    /**
     * Get plan terms as array
     */
    public function getTermsArrayAttribute()
    {
        return $this->terms_conditions ?? [];
    }

    /**
     * Check if plan is of specific type
     */
    public function isTrading()
    {
        return $this->type === self::TYPE_TRADING;
    }

    public function isSignal()
    {
        return $this->type === self::TYPE_SIGNAL;
    }

    public function isStaking()
    {
        return $this->type === self::TYPE_STAKING;
    }

    public function isMining()
    {
        return $this->type === self::TYPE_MINING;
    }

    /**
     * Check if plan has unlimited funding
     */
    public function hasUnlimitedFunding()
    {
        return $this->max_funding === null || $this->max_funding == 0;
    }

    /**
     * Get formatted funding range
     */
    public function getFundingRangeAttribute()
    {
        if ($this->hasUnlimitedFunding()) {
            return $this->currency . ' ' . number_format($this->min_funding, 2) . ' - Unlimited';
        }
        
        return $this->currency . ' ' . number_format($this->min_funding, 2) . ' - ' . number_format($this->max_funding, 2);
    }

    /**
     * Get minimum funding amount
     */
    public function getMinFundingAmountAttribute()
    {
        return $this->min_funding ?? $this->price;
    }

    /**
     * Get maximum funding amount
     */
    public function getMaxFundingAmountAttribute()
    {
        return $this->hasUnlimitedFunding() ? null : $this->max_funding;
    }

    /**
     * Get formatted price for display
     */
    public function getFormattedPriceAttribute()
    {
        return $this->currency . ' ' . number_format($this->price, 2);
    }

    /**
     * Get formatted original price for display
     */
    public function getFormattedOriginalPriceAttribute()
    {
        return $this->currency . ' ' . number_format($this->original_price, 2);
    }

    /**
     * Check if plan has discount
     */
    public function getHasDiscountAttribute()
    {
        return $this->original_price && $this->original_price > $this->price;
    }

    /**
     * Get discount percentage
     */
    public function getDiscountPercentageAttribute()
    {
        if (!$this->has_discount) {
            return 0;
        }
        
        return round((($this->original_price - $this->price) / $this->original_price) * 100);
    }
}
