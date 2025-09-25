<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lottery extends Model
{
    public $timestamps = false;

    /**
     * @return HasMany<LotteryResult, $this>
     */
    public function results(): HasMany
    {
        return $this->hasMany(LotteryResult::class);
    }
}
