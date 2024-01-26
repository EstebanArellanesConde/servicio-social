<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colonia extends Model
{
    use HasFactory;
    protected $table = 'colonia';
    public $timestamps = false;

    protected $fillable = [
        'codigo_postal',
        'colonia',
        'municipio',
        'estado'
    ];

}
