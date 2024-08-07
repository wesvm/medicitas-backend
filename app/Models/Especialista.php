<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    use HasFactory;

    protected $table = 'especialistas';

    protected $fillable = [
        'user_id',
        'nombres',
        'apellidos',
        'telefono',
        'especialidad_id',
        'horario_atencion_id',
    ];

    protected $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function horarioAtencion()
    {
        return $this->belongsTo(HorarioAtencion::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'especialista_id', 'user_id');
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'especialista_id', 'user_id');
    }
}
