<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'dni',
        'password',
        'email',
        'rol',
        'estado'
    ];

    public function scopePorRolActivo($query, $rol)
    {
        return $query->where('rol', $rol)->where('estado', true);
    }

    public function desactivar()
    {
        $this->estado = false;
        $this->save();
    }

    public function activar()
    {
        $this->estado = true;
        $this->save();
    }

    public function admin()
    {
        return $this->hasOne(Administrador::class);
    }

    public function especialista()
    {
        return $this->hasOne(Especialista::class);
    }

    public function paciente()
    {
        return $this->hasOne(Paciente::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $hidden = [
        'password',
        'estado',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
