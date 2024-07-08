<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('from_currencies_id')->constrained('currencies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('to_currencies_id')->constrained('currencies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('rate');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversions');
    }
};
