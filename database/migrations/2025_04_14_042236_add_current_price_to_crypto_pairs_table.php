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
        Schema::table('crypto_pairs', function (Blueprint $table) {
            $table->decimal('current_price', 20, 10)->nullable()->after('update_interval');
        });
    }
    
    public function down(): void
    {
        Schema::table('crypto_pairs', function (Blueprint $table) {
            $table->dropColumn('current_price');
        });
    }    
};
