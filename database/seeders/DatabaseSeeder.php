<?php

namespace Database\Seeders;

use App\Enums\LotteriesEnum;
use App\Models\Lottery;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Lottery::query()->insert([[
            'id' => LotteriesEnum::MEGA_SENA->id(),
            'name' => LotteriesEnum::MEGA_SENA->label(),
            'slug' => LotteriesEnum::MEGA_SENA->value,
            'numbers_per_result' => 6
        ]]);
    }
}
