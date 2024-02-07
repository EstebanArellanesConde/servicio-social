<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudInicio extends Model
{
    use HasFactory;
    protected $table = 'solicitud_inicio';

    protected $fillable = [
        'path',
    ];

    public function servicio(){
        return $this->hasOne(AlumnoServicio::class);
    }
}
