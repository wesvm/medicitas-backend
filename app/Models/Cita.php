<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'especialista_id',
        'fecha',
        'hora',
        'motivo',
        'estado'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'user_id');
    }

    public function especialista()
    {
        return $this->belongsTo(Especialista::class, 'especialista_id', 'user_id');
    }
}
