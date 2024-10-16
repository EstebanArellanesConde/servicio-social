<?php

namespace App\Http\Livewire\Alumno;

use App\Enums\EstadoAlumno;
use App\Models\Alumno;
use App\Models\Colonia;
use App\Models\Domicilio;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FormularioDomicilio extends Component
{

    public $calle;
    public $numero_externo;
    public $numero_interno;
    public $codigo_postal;
    public $colonias;
    public $colonia;
    public $municipio;
    public $estado;

    protected $listeners = [
        'getDatosColonia'
    ];

    public function mount(){
        $this->colonias = [];
    }

    public function getDatosColonia(){
        $this->colonias = Colonia::where('codigo_postal', '=', $this->codigo_postal)->get();
        $this->colonia = $this->colonias[0]->id;
        $this->municipio = $this->colonias[0]->municipio;
        $this->estado = $this->colonias[0]->estado;
    }

    public function rules(){
        return [
            'codigo_postal' => ['required'],
            'calle' => ['required'],
            'colonia' => ['required'],
            'numero_externo' => ['required'],
        ];
    }

    public function store(){
        $data = $this->validate();
        DB::beginTransaction();

        try{
            $domicilio = Domicilio::create([
                'calle' => $data['calle'],
                'numero_externo' => $data['numero_externo'],
                'numero_interno' => $data['numero_interno'] ?? null,
                'colonia_id' => $data['colonia'],
            ]);

            $alumno = Alumno::where('user_id', '=', auth()->user()->id)->first();
            $alumno->domicilio_id = $domicilio->id;
            $alumno->estado_id = EstadoAlumno::PREACEPTADO->value;

            $alumno->save();

            DB::commit();
            return redirect(RouteServiceProvider::HOME . "alumno");
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.alumno.formulario-domicilio', [
            'colonias' => $this->colonias,
        ]);
    }
}
