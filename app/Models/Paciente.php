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

    protected $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'paciente_id', 'user_id');
    }
}
