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
        Schema::create('batteries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_surfer1');
            $table->unsignedBigInteger('fk_surfer2');
            $table->foreign('fk_surfer1')->references('id')->on('surfers');
            $table->foreign('fk_surfer2')->references('id')->on('surfers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batteries');
    }
};
