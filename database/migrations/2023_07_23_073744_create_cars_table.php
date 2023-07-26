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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->text('description');
            // $table->integer('stock')->unsigned()->default(0)->nullable();
            $table->integer('views')->unsigned()->default(0)->nullable();
            // $table->foreignId('brand_id');
            // $table->foreignId('model_id');
            $table->unsignedBigInteger('brand_id')->nullable();
            // $table->unsignedBigInteger('model_id')->nullable();
            $table->float('price');
            $table->integer('doors');
            $table->integer('passengers');
            $table->text('image');
            $table->integer('status')->nullable();

            $table->timestamps();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();

            $table->foreign('brand_id')->references('id')->on('brands');
            // $table->foreign('model_id')->references('id')->on('models');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
