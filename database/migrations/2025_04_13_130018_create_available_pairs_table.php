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
        Schema::create('available_pairs', function (Blueprint $table) {
            $table->id();
            $table->string('symbol')->unique();       // BTCUSDT
            $table->string('base_asset');             // BTC
            $table->string('quote_asset');            // USDT
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_pairs');
    }
};
