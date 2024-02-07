<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartaAceptacion extends Model
{
    use HasFactory;
    protected $table = 'carta_aceptacion';
    protected $fillable = [
        'path',
    ];

    public function servicio(){
        return $this->hasOne(AlumnoServicio::class);
    }
}
