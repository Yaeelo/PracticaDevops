<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('denuncias', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // usuario que crea la denuncia
        $table->string('titulo');
        $table->text('descripcion');
        $table->string('tipo');
        $table->string('evidencia')->nullable(); // ruta del archivo
        $table->string('estatus')->default('pendiente'); // pendiente, atendida, etc.
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncias');
    }
};
