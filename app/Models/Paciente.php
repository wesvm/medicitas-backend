<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $fillable = [
        'user_id',
        'nombres',
        'apellidos',
        'edad',
        'fecha_nacimiento',
        'lugar_nacimiento',
        'domicilio',
        'telefono',
        'escuela_profesional',
        'ocupacion',
        'tipo_seguro',
        'telefono_emergencia'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
