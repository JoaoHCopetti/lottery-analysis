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
     * Summary of casts
     * @return array{numbers: 'array'}
     */
    protected function casts(): array
    {
        return [
            'numbers' => 'array'
        ];
    }
}
