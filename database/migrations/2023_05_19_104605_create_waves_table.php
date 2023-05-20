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
        Schema::create('waves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_battery');
            $table->unsignedBigInteger('fk_surfer');
            $table->foreign('fk_surfer')->references('id')->on('surfers');
            $table->foreign('fk_battery')->references('id')->on('batteries');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waves');
    }
};
