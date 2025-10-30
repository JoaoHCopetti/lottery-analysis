<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class LotteryResult extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'numbers'
    ];

    /**
     * @return array{numbers: 'array', date: 'date:Y-m-d'}
     */
    protected function casts(): array
    {
        return [
            'numbers' => 'array',
            'date' => 'date:Y-m-d'
        ];
    }

    /**
     * @return Attribute<int, null>
     */
    protected function evenCount(): Attribute
    {
        return Attribute::make(
            fn() => count(Arr::where(
                $this->numbers,
                fn(string $num) => intval($num) % 2 === 0
            ))
        );
    }
}
