<?php

namespace App\Http\Controllers\Jefe;

use App\Enums\EstadoReporte;
use App\Http\Controllers\Controller;
use App\Models\Jefe;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jefe = $this->getJefeByUserId(auth()->user()->id);
        $departamentos = $this->getJefeDepartamentos($jefe);

        $reportes = Reporte::where('reporte.estado_id', EstadoReporte::REVISION)
            ->join('alumno', 'alumno.id', 'reporte.alumno_id')
            ->join('departamento', 'departamento.id', 'alumno.departamento_id')
            ->where(function ($query) use ($departamentos) {
                foreach ($departamentos as $departamento)
                {
                    $query->orWhere('departamento.abreviatura_departamento', $departamento);
                }
            })
            ->select('reporte.*')
            ->get()
        ;


        return view('jefe.reportes', [
            'reportes' => $reportes
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $file = Reporte::findOrFail($id);
        return response()->file(storage_path($file->path));
    }

    private function getJefeByUserId($userId) {
        return Jefe::where('user_id', '=', $userId)->first();
    }

    private function getJefeDepartamentos($jefe){
        $departamentos = [];
        foreach($jefe->abreviaturaDepartamentos->toArray() as $departamento){
            $departamentos[] = $departamento['abreviatura_departamento'];
        }

        return $departamentos;
    }

    /**
     * Update the specified resource in storage.
     */
    public function aceptar(Request $request)
    {
        $data = $request->all();

        $reporte = Reporte::find($request->id);
        $reporte->estado_id = EstadoReporte::ACEPTADO;
        $reporte->save();

        $filePath = storage_path($reporte->path);
        $outputFilePath = storage_path($reporte->path);
        $this->fillPDFFile($filePath, $outputFilePath, $data['sign']);

        return response()->file($outputFilePath);
    }

    public function correccion(Request $request){
        $data = $request->all();

        $reporte = Reporte::find($request->id);
        $reporte->estado_id = EstadoReporte::CORRECCION;
        $reporte->observaciones = $data['observaciones'];
        $reporte->save();

        return redirect()->back();
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
