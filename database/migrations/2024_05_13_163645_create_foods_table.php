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
        Schema::create('ana_yemekler', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->integer('calorie');
            $table->string('desc')->nullable();
        });

        Schema::create('kahvalti_yemekler', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->integer('calorie');
            $table->string('desc')->nullable();
        });

        Schema::create('corbalar', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->integer('calorie');
            $table->string('desc')->nullable();
        });
        Schema::create('icecekler', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->integer('calorie');
            $table->string('desc')->nullable();
        });
        Schema::create('aksam_yemekler', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->integer('calorie');
            $table->string('desc')->nullable();
        });
        Schema::create('salatalar', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->integer('calorie');
            $table->string('desc')->nullable();
        });
        Schema::create('ara_ogenler', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->integer('calorie');
            $table->string('desc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
