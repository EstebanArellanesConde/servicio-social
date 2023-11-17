<?php

namespace App\Http\Livewire\Jefe;

use App\Models\Periodo;
use App\Rules\NombreRule;
use Livewire\Component;

class FormularioPeriodo extends Component
{
    public $periodos;
    public $periodo;
    public $fecha_inicio;
    public $fecha_fin;
    public function mount(){
        $this->periodos = Periodo::all()->sortBy('periodo');
    }

    protected function rules(){
        return [
            'periodo' => ['required'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date', 'after:fecha_inicio'],
        ];
    }

    public function setFechas(){
        if (intval($this->periodo) !== 0){
            $this->fecha_inicio = $this->periodos[intval($this->periodo) - 1]->fecha_inicio;
            $this->fecha_fin = $this->periodos[intval($this->periodo) - 1]->fecha_fin;
        }

    }

    public function store(){
        $data = $this->validate();
        $periodoModificar = Periodo::find($data['periodo']);
        $periodoModificar->fecha_inicio = $data['fecha_inicio'];
        $periodoModificar->fecha_fin = $data['fecha_fin'];
        $periodoModificar->save();

        return redirect(route('jefe.configuracion'))->with('success', 'Se actualizo el periodo ' . $periodoModificar->periodo . ' exitosamente');
    }

    public function render()
    {
        return view('livewire.jefe.formulario-periodo', [
            'periodos' => $this->periodos,
        ]);
    }
}
