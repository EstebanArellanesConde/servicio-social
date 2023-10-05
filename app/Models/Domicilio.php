<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    use HasFactory;
    protected $table = 'domicilio';
    protected $fillable = [
        'calle',
        'numero_externo',
        'numero_interno',
        'colonia_id',
    ];

    public function colonia(){
        return $this->hasOne(Colonia::class, 'id' ,'colonia_id');
    }
}
