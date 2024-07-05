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
        Schema::create('especialistas', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono')->nullable();
            $table->foreignId('horario_atencion_id')
                ->nullable()
                ->constrained('horario_atencion')
                ->nullOnDelete();
            $table->foreignId('especialidad_id')
                ->nullable()
                ->constrained('especialidades')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especialistas');
    }
};
