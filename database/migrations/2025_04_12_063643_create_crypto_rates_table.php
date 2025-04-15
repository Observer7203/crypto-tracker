<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('crypto_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crypto_pair_id')->constrained('crypto_pairs')->onDelete('cascade');
            $table->decimal('rate', 20, 10); // высокая точность
            $table->timestamp('timestamp')->useCurrent();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_rates');
    }
};
