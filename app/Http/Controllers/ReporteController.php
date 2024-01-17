<?php

namespace App\Http\Controllers;

use App\Enums\EstadoReporte;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

class ReporteController extends Controller
{

    public function show($id){
        $file = Reporte::findOrFail($id);
        return response()->file(storage_path($file->path));
    }

    public function aceptar(Request $request){

        $data = $request->all();

        $reporte = Reporte::find($request->id);
        $reporte->estado_id = EstadoReporte::ACEPTADO;
        $reporte->save();

        $filePath = storage_path($reporte->path);
        $outputFilePath = storage_path($reporte->path);
        $this->fillPDFFile($filePath, $outputFilePath, $data['sign']);

        return response()->file($outputFilePath);
//        return redirect()->back();
    }

    public function correccion(Request $request){
        $data = $request->all();

        $reporte = Reporte::find($request->id);
        $reporte->estado_id = EstadoReporte::CORRECCION;
        $reporte->observaciones = $data['observaciones'];
        $reporte->save();

        return redirect()->back();
    }

    public function download($id){
        $reporte = Reporte::find($id);
        return Storage::download($reporte->path);
    }

    public function firmar(){
        $filePath = storage_path("app/reportes/11.pdf");
        $outputFilePath = storage_path("app/reportes/11_out.pdf");
        $this->fillPDFFile($filePath, $outputFilePath);

        return response()->file($outputFilePath);
    }

    public function saveBase64PNG(string $base64, string $filename){
        $extension = explode('/', explode(':', substr($base64, 0, strpos($base64, ';')))[1])[1];   // .jpg .png .pdf
        $replace = substr($base64, 0, strpos($base64, ',')+1);

        // find substring fro replace here eg: data:image/png;base64,
        $image = str_replace($replace, '', $base64);
        $image = str_replace(' ', '+', $image);

        return Storage::put('firmas/' . $filename, base64_decode($image));
    }

    public function fillPDFFile($file, $outputFilePath, $signBase64)
    {
        $fpdi = new FPDI;

        $this->saveBase64PNG($signBase64, '1.png');
        $count = $fpdi->setSourceFile($file);

        // firmar todas las paginas
        for ($i=1; $i<=$count; $i++) {

            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);

            $fpdi->Image(storage_path('app/firmas/' . '1.png'), $size['width'] - 90, $size['height'] - 54, 40);
        }

        return $fpdi->Output($outputFilePath, 'F');
    }

}
