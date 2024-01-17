<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoReporte extends Model
{
    use HasFactory;
    protected $table = 'estado_reporte';
    public $timestamps = false;
}
