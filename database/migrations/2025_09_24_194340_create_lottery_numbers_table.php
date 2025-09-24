<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lottery_numbers', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('number');
            $table->unsignedInteger('occurrences');
            $table->decimal('weight', 5, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lottery_numbers');
    }
};
