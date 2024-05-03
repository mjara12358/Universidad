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
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idMateria');
            $table->date('fecha');
            $table->String('tema');
            $table->String('actividad');
            $table->String('recursos', 300);
            $table->String('observaciones');
            $table->String('estrategia');
            $table->timestamps();

            $table->foreign('idMateria')->references('id')->on('materias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clases');
    }
};
