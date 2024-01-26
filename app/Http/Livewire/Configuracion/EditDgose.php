<?php

namespace App\Http\Livewire\Configuracion;

use App\Models\ClaveDGOSE;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\ItemNotFoundException;
use Livewire\Component;
use function Termwind\render;

class EditDgose extends Component
{
    public $claves;
    public $clave;
    public $anio;
    public function mount(){
        $this->claves = ClaveDGOSE::all()->sortBy('anio');
    }

    protected function rules(){
        return [
            'anio' => ['required', 'max:4', 'min:4'],
            'clave' => ['required'],
        ];
    }

    public function setClave()
    {
        try {
            $this->clave = $this->claves->where('anio', $this->anio)->firstOrFail()->clave;
            // quitar error de año valido
            $this->resetErrorBag('clave');
            if ($this->clave === null){
                return $this->addError('no-clave', 'Aún no se ha asignado una clave para el año ' . $this->anio );
            }
        } catch (ItemNotFoundException){
            $this->resetErrorBag('no-clave');
            return $this->addError('clave', 'Ingrese un año válido');
        }
    }



    public function store(){
        $data = $this->validate();

        $claveAGuardar = $this->claves->where('anio', $data['anio'])->firstOrFail();
        $claveAGuardar->clave = $data['clave'];

        $claveAGuardar->save();

        return session()->flash('message', 'Clave actualizada');
    }

    public function render()
    {
        return view('livewire.configuracion.edit-dgose', [
            'claves' => $this->claves,
        ]);
    }
}
