<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class EstadoAlumno extends Model
{
    use HasFactory;
    protected $table = 'estado_alumno';

    public function historico(){
        return $this->hasMany(HistoricoEstadoAlumno::class);
    }

    /**
     * Obtiene a todos los alumnos con ese estado
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alumnos(){
        return $this->hasMany(Alumno::class, 'estado_id' );
    }

    /**
     * Obtiene al primer alumno con ese estado
     * Util para acceder a alumno desde estado que
     * se llamo desde alumno
     * e.g: $alumno->estado->alumno->numero_cuenta
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function alumno(){
        return $this->hasOne(Alumno::class, 'estado_id' );
    }

    protected function nombre(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
        );
    }
}
