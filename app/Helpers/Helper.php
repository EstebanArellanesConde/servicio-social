<?php

namespace App\Helpers;

use App\Exceptions\NoClaveDGOSEException;
use App\Models\ClaveDGOSE;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

class Helper
{
    public static function concatenarNombre(){
        $args = func_get_args();
        return implode(" ", $args);
    }

    public static function capitalize(string $string) : string
    {
        return ucwords(mb_strtolower($string));
    }


    /**
     * Verifica si existe clave para iniciar los procesos de servicio del
     * año en curso
     * @throws NoClaveDGOSEException si no existe clave dgose activa
 */
    public static function getClaveActiva(): string
    {
        $clave = DB::table('clave_dgose', 'cd')
            ->join('periodo', 'cd.id', '=', 'periodo.clave_dgose_id')
            ->groupBy(['cd.anio', 'cd.clave'])
            ->havingRaw('now() between min(periodo.fecha_inicio) and max(periodo.fecha_fin) and clave is not null')
            ->select('clave')
            ->first()
        ;

        if (!$clave){
            throw new NoClaveDGOSEException('No existe una clave activa DGOSE para el servicio social');
        }

        return $clave->clave;
    }
    public static function getClaveActivaId(): int|null
    {
        $claveId = DB::table('clave_dgose', 'cd')
            ->join('periodo', 'cd.id', '=', 'periodo.clave_dgose_id')
            ->groupBy(['cd.id', 'cd.anio', 'cd.clave'])
            ->havingRaw('now() between min(periodo.fecha_inicio) and max(periodo.fecha_fin) and clave is not null')
            ->select('cd.id')
            ->first()
        ;

        if (!$claveId) throw new NoClaveDGOSEException('No existe una clave activa DGOSE para el servicio social');

        return $claveId->id;
    }


    public static function saveBase64PNG(string $base64, string $filename){
        $extension = explode('/', explode(':', substr($base64, 0, strpos($base64, ';')))[1])[1];
        $replace = substr($base64, 0, strpos($base64, ',')+1);

        // find substring fro replace here eg: data:image/png;base64,
        $image = str_replace($replace, '', $base64);
        $image = str_replace(' ', '+', $image);

        Storage::put('firmas/' . $filename, base64_decode($image));

        return 'firmas/' . $filename;
    }

    public static function firmarPDF(
        $inFile,
        $outFilePath,
        $signPath,
        $x,
        $y,
        $w
    )
    {
        $fpdi = new FPDI;

        $count = $fpdi->setSourceFile($inFile);
        for ($i=1; $i<=$count; $i++) {
            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);

            $signPathFromStorage = storage_path('app/' . $signPath);
            $fpdi->Image($signPathFromStorage, $size['width'] - $x, $size['height'] - $y, $w);
        }

        return $fpdi->Output($outFilePath, 'F');
    }
}
