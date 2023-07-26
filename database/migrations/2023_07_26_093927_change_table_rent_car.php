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
        Schema::table('car_rent', function(Blueprint $table) {
            $table->date('cancel_date')->nullable();
            $table->date('return_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_rent', function (Blueprint $table) {
            $table->dropColumn('cancel_date');
            $table->dropColumn('return_date');
        });
    }
};
