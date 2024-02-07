<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    protected $table = 'departamento';

    public function jefe(){
        return $this->belongsTo(Jefe::class);
    }

    public function alumnos(){
        return $this->hasMany(Alumno::class);
    }
}
