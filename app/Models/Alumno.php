<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use HighSolutions\EloquentSequence\Sequence;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\ModelStatus\HasStatuses;
use Spatie\Permission\Traits\HasRoles;

class Alumno extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Sequence;

    /**
     * @var \App\Enums\Departamento|mixed
     */
    public mixed $departamento_id;
    protected $table = 'alumno';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'user_id',
        'numero_cuenta',
        'curp',
        'fecha_nacimiento',
        'sexo',
        'genero',
        'telefono_alternativo',
        'telefono_celular',
        'escuela_id',
        'carrera_id',
        //'fecha_ingreso_facultad',
        'creditos_pagados',
        'avance_porcentaje',

        'promedio',
        'duracion_servicio',

        'hora_inicio',
        'hora_fin',
        'pertenencia_unica',

        'departamento_id',
        'domicilio_id',
        'estado_id',
        'fecha_estado',
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

    public function sequence(){
        return [
            'group' => 'clave_dgose_id',
            'fieldName' => 'num_alumno',
            'orderFrom1' => true,
            'notUpdateOnDelete' => true,
            'disableTimestamps' => false
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function escuela(){
        return $this->belongsTo(Escuela::class);
    }

    public function carrera(){
        return $this->belongsTo(Carrera::class);
    }

    public function departamento(){
        return $this->belongsTo(Departamento::class);
    }

    public function domicilio(){
        return $this->belongsTo(Domicilio::class);
    }

    public function estado(){
        return $this->hasOne(EstadoAlumno::class, 'id', 'estado_id');
    }

    public function estados(){
        return $this->hasMany(HistoricoEstadoAlumno::class);
    }

    public function domiclio(){
        return $this->hasOne(Domicilio::class);
    }

    public function reportes(){
        return $this->hasMany(Reporte::class);
    }

    protected function direccion(): Attribute
    {
        try {
            $calle = $this->domicilio->calle;
            $numeroExterno = $this->domicilio->numero_externo;
            $codigoPostal = $this->domicilio->colonia->codigo_postal;
            $colonia = $this->domicilio->colonia->nombre;
            $municipio = $this->domicilio->colonia->municipio->nombre;
            $estado = $this->domicilio->colonia->municipio->estado->nombre;
            return Attribute::make(
                get: fn(mixed $value, array $attributes) => $calle . ' ' . $numeroExterno . ' ' . $codigoPostal . ' ' .
                    $colonia . ' ' . $municipio . ' ' . $estado
            );
        } catch (\ErrorException $ex){
            return Attribute::make(
                get: fn(mixed $value, array $attributes) => ''
            );
        }
    }

    public function setEstado(string $estado)
    {
        DB::beginTransaction();
        try{
            // verificar estado
            if (! $this->isEstadoValido($estado)) throw new \ValueError("Estado " . $estado . " invalido");

            // Asignar nuevo id
            $estadoId = $this->getEstadoId($estado);
            $this->estado_id = $estadoId;
            // Actualizar fecha
            $fechaEstadoNueva = now();
            $this->fecha_estado = $fechaEstadoNueva;


            // crear nuevo historico
            $nuevoHistorico = new HistoricoEstadoAlumno;
            $nuevoHistorico->alumno_id = $this->id;
            $nuevoHistorico->estado_id = $this->estado_id;
            $nuevoHistorico->fecha_estado = $fechaEstadoNueva;

            // guardar alumno e historico
            $this->save();
            $nuevoHistorico->save();
            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            return false;
        }

        return true;
    }

    public function getEstado(){
        return $this->estado->nombre;
    }

    public function hasEstado(string $estado){
        if (! $this->isEstadoValido($estado)){
            return false;
        } else if ($this->getEstado() === strtoupper($estado)){
            return true;
        }

        return false;
    }


    public function getEstadoId(string $estadoString)
    {
        return EstadoAlumno::where('nombre', '=', strtoupper($estadoString))->first()->id;
    }

    public function isEstadoValido($estado): bool
    {
        return EstadoAlumno::where('nombre', '=', strtoupper($estado))->exists();
    }
}
