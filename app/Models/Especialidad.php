<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidades';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'
    ];

    protected $hidden = [
        'estado'
    ];

    public function especialistas()
    {
        return $this->hasMany(Especialista::class);
    }

    public function scopeActivas($query)
    {
        return $query->where('estado', true);
    }

    public function desactivar()
    {
        $this->estado = false;
        return $this->save();
    }
}
