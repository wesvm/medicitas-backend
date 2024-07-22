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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_id')
                ->nullable()->constrained('citas')->onDelete('no action');
            $table->string('motivo_consulta');
            $table->datetime('fecha_hora');
            $table->text('diagnostico');
            $table->text('tratamiento');
            $table->text('observaciones')->nullable();
            $table->date('proxima_cita')->nullable();
            $table->foreignId('paciente_id')->constrained('pacientes', 'user_id')->onDelete('cascade');
            $table->foreignId('especialista_id')
                ->nullable()->constrained('especialistas', 'user_id')->onDelete('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
