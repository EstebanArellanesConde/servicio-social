<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Alumno extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'curp',
        'numero_cuenta',
        'fecha_nacimiento',
        'sexo',
        'telefono_alternativo',
        'telefono_celular',

        'interno',
        'carrera_id',
        'fecha_ingreso_facultad',

        'creditos_pagados',
        'avance_porcentaje',

        'promedio',
        'duracion_servicio',

        'horas_semana',
        'hora_inicio',
        'hora_fin',
        'pertenencia_unica',

        'departamento_id',
        'estado_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function estado(){
        return $this->belongsTo(Estado::class);
    }

}
