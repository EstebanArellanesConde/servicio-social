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

    public static function getClaveActiva() : string
    {
        $currentYear = Carbon::now()->year;
        if(!ClaveDGOSE::existsClaveActiva()){
            throw new NoClaveDGOSEException("Aún no se registra una clave DGOSE para el año " . $currentYear);
        }

        return ClaveDGOSE::where('anio', $currentYear)->first()->clave;
    }

    public static function getClaveActivaId() : int
    {
        $currentYear = Carbon::now()->year;
        if(!ClaveDGOSE::existsClaveActiva()){
            throw new NoClaveDGOSEException("Aún no se registra una clave DGOSE para el año " . $currentYear);
        }

        return ClaveDGOSE::where('anio', $currentYear)->first()->anio;
    }



    /**
     * Verifica si existe clave para iniciar los procesos de servicio del
     * año en curso
     * @return bool
     */
    public static function existsClaveActiva() : bool
    {
        $currentYear = Carbon::now()->year;
        $clave = ClaveDGOSE::where('anio', $currentYear)->first();
        // obtiene el registro del año actual y verifica que la clave no sea nula

        if ($clave->clave === null){
            return false;
        }

        return true;
    }

    public function periodos(){
        return $this->hasMany(Periodo::class, 'clave_dgose_id', 'id');
    }
}
