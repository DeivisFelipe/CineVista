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
        Schema::create('sessao', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('filme_id');
            $table->foreignId('sala_id')->constrained();
            $table->dateTime('inicio');
            $table->dateTime('fim');
            $table->unsignedFloat('preco');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessao');
    }
};
