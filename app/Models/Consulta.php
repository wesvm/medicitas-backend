<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $table = 'consultas';

    protected $fillable = [
        'cita_id',
        'motivo_consulta',
        'fecha_hora',
        'diagnostico',
        'tratamiento',
        'observaciones',
        'proxima_cita',
        'paciente_id',
        'especialista_id',
    ];

    protected $dates = [
        'fecha_hora',
        'proxima_cita',
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'user_id');
    }

    public function especialista()
    {
        return $this->belongsTo(Especialista::class, 'especialista_id', 'user_id');
    }
}
