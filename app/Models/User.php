<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasUuids;

    public function IsAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'balance', // Holding account
        'trading_balance',
        'mining_balance',
        'referral_balance',
        'holding_balance',
        'staking_balance',
        'profit',
        'phone',
        'telegram',
        'avatar',
        'subscription',
        'package_id',
        'trader',
        'trade_count',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'balance' => 'decimal:2',
            'trading_balance' => 'decimal:2',
            'mining_balance' => 'decimal:2',
            'referral_balance' => 'decimal:2',
            'holding_balance' => 'decimal:2',
            'staking_balance' => 'decimal:2',
            'profit' => 'decimal:2',
        ];
    }
    protected $dates = ['last_login_at'];

    public function fullname()
    {
        return $this->name;
    }

    public function status()
    {
        if ($this->status == 'active')
        {
            return '<span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500">Active</span>';
        }
        return '<span class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-orange-100 dark:bg-gray-700 dark:border-orange-300 dark:text-orange-300">InActive</span>';
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function trades()
    {
        return $this->hasMany(Trade::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function withdrawal()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the user's plan subscriptions
     */
    public function userPlans()
    {
        return $this->hasMany(UserPlan::class);
    }

    /**
     * Get the user's active plan subscriptions
     */
    public function activeUserPlans()
    {
        return $this->hasMany(UserPlan::class)->where('status', 'active');
    }

    /**
     * Get the user's current trading plan subscription
     */
    public function currentTradingPlan()
    {
        return $this->hasMany(UserPlan::class)
            ->whereHas('plan', function($query) {
                $query->where('type', 'trading');
            })
            ->where('status', 'active')
            ->latest();
    }

    /**
     * Get the user's staking activities
     */
    public function stakings()
    {
        return $this->hasMany(UserStaking::class);
    }

    /**
     * Get the user's mining activities
     */
    public function minings()
    {
        return $this->hasMany(UserMining::class);
    }

    /**
     * Get total balance across all accounts
     */
    public function getTotalBalanceAttribute()
    {
        return $this->balance + $this->trading_balance + $this->mining_balance + $this->referral_balance + $this->holding_balance + $this->staking_balance;
    }

    /**
     * Get formatted balance for display
     */
    public function getFormattedBalanceAttribute()
    {
        return '$' . number_format($this->balance, 2);
    }

    public function getFormattedTradingBalanceAttribute()
    {
        return '$' . number_format($this->trading_balance, 2);
    }

    public function getFormattedMiningBalanceAttribute()
    {
        return '$' . number_format($this->mining_balance, 2);
    }

    public function getFormattedReferralBalanceAttribute()
    {
        return '$' . number_format($this->referral_balance, 2);
    }

    public function getFormattedHoldingBalanceAttribute()
    {
        return '$' . number_format($this->holding_balance, 2);
    }

    public function getFormattedStakingBalanceAttribute()
    {
        return '$' . number_format($this->staking_balance, 2);
    }

    /**
     * Balance management methods
     */
    public function addToBalance($amount, $type = 'holding')
    {
        switch ($type) {
            case 'trading':
                $this->increment('trading_balance', $amount);
                break;
            case 'mining':
                $this->increment('mining_balance', $amount);
                break;
            case 'referral':
                $this->increment('referral_balance', $amount);
                break;
            case 'holding':
            default:
                $this->increment('balance', $amount);
                break;
        }
    }

    public function deductFromBalance($amount, $type = 'holding')
    {
        switch ($type) {
            case 'trading':
                $this->decrement('trading_balance', $amount);
                break;
            case 'mining':
                $this->decrement('mining_balance', $amount);
                break;
            case 'referral':
                $this->decrement('referral_balance', $amount);
                break;
            case 'holding':
            default:
                $this->decrement('balance', $amount);
                break;
        }
    }

    /**
     * Check if user has sufficient balance
     */
    public function hasSufficientBalance($amount, $type = 'holding')
    {
        switch ($type) {
            case 'trading':
                return $this->trading_balance >= $amount;
            case 'mining':
                return $this->mining_balance >= $amount;
            case 'referral':
                return $this->referral_balance >= $amount;
            case 'holding':
            default:
                return $this->balance >= $amount;
        }
    }

    /**
     * Holding relationships
     */
    public function holdings()
    {
        return $this->hasMany(UserHolding::class);
    }

    public function holdingTransactions()
    {
        return $this->hasMany(HoldingTransaction::class);
    }

    public function fundTransfers()
    {
        return $this->hasMany(FundTransfer::class);
    }

    /**
     * Bot Trading relationships
     */
    public function botTradings()
    {
        return $this->hasMany(BotTrading::class);
    }

    public function botTrades()
    {
        return $this->hasMany(BotTrade::class);
    }
}
