<?php

namespace Database\Seeders;

use App\Models\Lottery;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Lottery::create([
            'name' => 'Mega Sena',
            'numbers_per_result' => 6
        ]);
    }
}
