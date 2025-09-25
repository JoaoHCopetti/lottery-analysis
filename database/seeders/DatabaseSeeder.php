<?php

namespace Database\Seeders;

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
            'name' => 'Mega Sena',
            'slug' => Str::slug('Mega Sena'),
            'numbers_per_result' => 6
        ]]);
    }
}
