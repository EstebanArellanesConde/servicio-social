<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PasswordInput extends Component
{
    public $class;
    public $name;

    public function render()
    {
        return view('livewire.password-input', [
            'class' => $this->class,
            'name' => $this->name
        ]);
    }
}
