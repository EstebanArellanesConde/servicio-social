<?php

namespace App\View\Components\Jefe;

use App\Models\Departamento;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Opciones extends Component
{
    /**
     * Create a new component instance.
     */
    public $filetype;
    public $departamentosAbreviaturas;
    public function __construct()
    {
        $this->departamentosAbreviaturas = Departamento::all()->pluck('abreviatura_departamento')->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.jefe.opciones', [
            'departamentosAbreviaturas' => $this->departamentosAbreviaturas,
        ]);
    }
}
