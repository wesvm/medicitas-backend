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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nombres');
            $table->string('apellidos');
            $table->integer('edad');
            $table->date('fecha_nacimiento');
            $table->string('lugar_nacimiento')->nullable();
            $table->string('domicilio');
            $table->string('telefono')->nullable();
            $table->string('escuela_profesional')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('tipo_seguro');
            $table->string('telefono_emergencia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
