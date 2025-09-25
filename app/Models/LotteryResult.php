<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LotteryResult extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'numbers'
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'numbers' => 'array'
        ];
    }
}
