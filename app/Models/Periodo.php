<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;
    protected $table = 'periodo';
    protected $fillable = [
        'periodo',
        'fecha_inicio',
        'fecha_fin'
    ];


    public function claveDGOSE(){
        return $this->hasOne(ClaveDGOSE::class);
    }
}
