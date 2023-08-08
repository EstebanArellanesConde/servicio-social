<?php

namespace App\View\Components\Jefe;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Opciones extends Component
{
    /**
     * Create a new component instance.
     */
    public $filetype;
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.jefe.opciones');
    }
}
