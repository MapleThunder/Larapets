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
        Schema::create('pet', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('species');
            $table->string('colour');
            $table->integer('full_hunger');
            $table->integer('current_hunger');
            $table->integer('full_health');
            $table->integer('current_health');
            $table->integer('level')->default(1);
            $table->unsignedBigInteger('experience')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet');
    }
};
