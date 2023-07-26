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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id');
            $table->unsignedBigInteger('user_id');
            $table->string('invoice_number')->nullable();
            $table->integer('duration');
            $table->enum('status',['BOOKED','PAID','ONDUTY','FINISH','CANCEL']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rents', function(Blueprint $table) {
            $table->dropForeign('rents_user_id_foreign');
        });
        Schema::dropIfExists('rents');
    }
};
