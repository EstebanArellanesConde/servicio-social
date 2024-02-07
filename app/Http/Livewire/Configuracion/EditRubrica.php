<?php

namespace App\Http\Livewire\Configuracion;

use App\Models\Jefe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class EditRubrica extends Component
{
    public $rubrica;

    public function rules(): array
    {
        return [
            'rubrica' => ['required', 'min:23'],
        ];
    }

    public function store(){
        $data = $this->validateOnly('rubrica');
        $this->saveRubrica($data['rubrica']);

        return session()->flash('message', 'Se ha actualizado la rubrica');
    }

    public function saveRubrica(string $rubrica){
        $filename = Auth::user()->id . '.png';
        $path = 'rubricas/' . $filename;
        Storage::put($path , base64_decode(Str::of($rubrica)->after(',')));

        !$this->savePathDatabase($path);
    }

    public function savePathDatabase(string $path): bool
    {
        $jefe = Jefe::findOrFail(Auth::user()->id);
        $jefe->rubrica_url = $path;
        return $jefe->save();
    }

    public function render()
    {
        $existeRubrica = false;
        $jefe = Jefe::findOrFail(Auth::user()->id);
        if ($jefe->rubrica_url){
            $existeRubrica = true;
        }

        return view('livewire.configuracion.edit-rubrica', [
            'existeRubrica' => $existeRubrica,
        ]);
    }
}
