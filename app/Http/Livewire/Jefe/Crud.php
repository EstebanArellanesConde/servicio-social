<?php

namespace App\Http\Livewire\Jefe;

use Livewire\Component;

class Crud extends Component
{
    public $alumnos;

    public function mount($alumnos){
        $this->alumnos = $alumnos;
    }

    public function render()
    {
        return view('livewire.jefe.crud', [
            'alumnos' => $this->alumnos,
        ]);
    }
}
