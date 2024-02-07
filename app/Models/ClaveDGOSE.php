<?php

namespace App\Models;

use App\Exceptions\NoClaveDGOSEException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaveDGOSE extends Model
{
    use HasFactory;
    protected $table = 'clave_dgose';

    protected $fillable = [
        'anio',
        'clave'
    ];

    public function periodos(){
        return $this->hasMany(Periodo::class, 'clave_dgose_id', 'id');
    }
}
