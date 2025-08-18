<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopiedTrade extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function copy_trader()
    {
        return $this->belongsTo(CopyTrader::class);
    }
}
