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
        Schema::create('assentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sala_id')->constrained();
            $table->unsignedInteger('numero');
            $table->string('fileira');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assentos');
    }
};
