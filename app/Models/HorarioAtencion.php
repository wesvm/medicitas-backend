<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioAtencion extends Model
{
    use HasFactory;

    protected $table = 'horario_atencion';

    protected $fillable = [
        'hora_inicio',
        'hora_fin',
        'estado',
    ];

    public function especialistas()
    {
        return $this->hasMany(Especialista::class);
    }
}
