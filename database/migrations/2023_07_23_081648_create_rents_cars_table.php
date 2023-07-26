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
        Schema::create('car_rent', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('rent_id');
            // $table->foreignId('car_id');
            $table->unsignedBigInteger('rent_id');
            $table->unsignedBigInteger('car_id');
            $table->date('booked_start');
            $table->date('booked_end');
            $table->float('car_price')->unsigned()->default(0);
            $table->float('total_price')->unsigned()->default(0);
            // $table->integer('quantity')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('rent_id')->references('id')->on('rents');
            $table->foreign('car_id')->references('id')->on('cars');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_rent', function(Blueprint $table) {
            $table->dropForeign('rents_rent_id_foreign');
            $table->dropForeign('rents_car_id_foreign');
        });
        Schema::dropIfExists('rents_cars');
    }
};
