<?php

namespace App\Http\Controllers\Jefe;

use App\Enums\EstadoReporte;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Jefe;
use App\Models\Reporte;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $reportes = $this->getAllReportesByDepartamento($departamentos, EstadoReporte::REVISION->value);


        return view('jefe.reportes', [
            'reportes' => $reportes
        ]);
    }

    public function getAllReportesByDepartamento(array $departamentos, int $estadoReporte): Collection
    {
        $reportes = Reporte::where('reporte.estado_id', $estadoReporte)
            ->join('alumno_servicio', 'alumno_servicio.id', 'reporte.alumno_servicio_id')
            ->join('alumno', 'alumno.id', 'alumno_servicio.alumno_id')
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

        return $reportes;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $file = Reporte::findOrFail($id);
        return response()->file(storage_path('app/'. $file->path));
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
     * Aceptar y firmar el reporte
     */
    public function aceptar(Request $request)
    {
        $data = $request->only('sign');

        $reporte = Reporte::find($request->id);
        $reporte->estado_id = EstadoReporte::ACEPTADO;
        $reporte->save();

        // recuperar reporte pdf del storage
        $filePath = storage_path('app/' . $reporte->path);
        // el output file sera el mismo que el filePath para que lo sobrescriba
        $outputFilePath = storage_path('app/' . $reporte->path);

        // convertimos el base64 de la firma a pdf y obtenemos la ruta donde se almaceno
        $firmaPath = Helper::saveBase64PNG($data['sign'], Auth::user()->id . '.png');

        // se firma el pdf siendo outputFilePath el pdf que llevara la firma
        Helper::firmarPDF($filePath, $outputFilePath, $firmaPath, 90, 54, 40);

        return response()->file($outputFilePath);
    }

    public function correccion(Request $request){
        $data = $request->only('observaciones');

        $reporte = Reporte::find($request->id);
        $reporte->estado_id = EstadoReporte::CORRECCION;
        $reporte->observaciones = $data['observaciones'];
        $reporte->save();

        return redirect()->back();
    }


}
