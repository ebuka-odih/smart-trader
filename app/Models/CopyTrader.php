<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CopyTrader extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['name', 'avatar', 'amount', 'win_rate', 'profit_share', 'win', 'loss'];

    public function copied_trades()
    {
        return $this->hasMany(CopiedTrade::class, 'copy_trader_id');
    }

}
