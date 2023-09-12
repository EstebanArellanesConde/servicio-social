<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * Create a new component instance.
     */
    public $dataId;

    public function __construct($dataId)
    {
        $this->dataId = $dataId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal', [
            'dataId' => $this->dataId
        ]);
    }
}
