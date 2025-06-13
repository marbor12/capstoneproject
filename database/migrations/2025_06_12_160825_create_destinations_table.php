<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category');
            $table->text('description');
            $table->string('location');
            $table->string('price');
            $table->string('price_range');
            $table->string('image');
            $table->json('facilities');
            $table->string('open_hours');
            $table->string('best_time');
            $table->json('travel_type');
            $table->json('best_months');
            $table->string('duration');
            $table->string('activity_level');
            $table->boolean('is_recommended')->default(false);
            $table->string('csv_source')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('destinations');
    }
};
