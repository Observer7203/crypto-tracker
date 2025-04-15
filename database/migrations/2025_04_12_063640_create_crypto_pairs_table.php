<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('crypto_pairs', function (Blueprint $table) {
            $table->id();
            $table->string('base_currency');
            $table->string('quote_currency');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('update_interval'); // в минутах
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crypto_pairs');
    }
};
