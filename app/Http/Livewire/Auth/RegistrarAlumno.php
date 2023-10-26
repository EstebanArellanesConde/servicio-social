<?php

namespace App\Http\Livewire\Auth;

use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\Departamento;
use App\Models\Escuela;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\CurpRule;
use App\Rules\EscuelaExternaRule;
use App\Rules\HoraInicioRule;
use App\Rules\NombreRule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;

class RegistrarAlumno extends Component
{
    public $message;
    public $name;
    public $apellido_paterno;
    public $apellido_materno;
    public $email;
    public $password;
    public $password_confirmation;
    public $curp;
    public $numero_cuenta;
    public $sexo;
    public $telefono_alternativo;
    public $telefono_celular;
    public $creditos_pagados;
    public $promedio;
    public $avance_porcentaje;
    public $procedencia;
    public $escuela;
    public $carrera;
    public $duracion_servicio;
    public $hora_inicio;
    public $hora_fin;
    public $pertenencia_unica;
    public $escuela_text;
    public $departamento_id;
    public $aviso_de_privacidad;

    /**
     * Permite mensajes de error personalizados
     *
     * @return array
     */


    protected function messages(){
        return [
            'aviso_de_privacidad' => [
                'accepted' => 'Debes aceptar el aviso de privacidad para continuar',
            ],
        ];
    }
    protected function rules()
    {
         return [
            // Usuario
            'name' => ['required', 'string', 'max:255', new NombreRule()],
            'apellido_paterno' => ['required', 'string', 'max:255', new NombreRule()],
            'apellido_materno' => ['required', 'string', 'max:255', new NombreRule()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::min(8)->mixedCase()->numbers()->symbols()],
            // Alumno
            'curp' => ['required', 'unique:alumnos,curp', new CurpRule()],
            'sexo' => ['required', "in:H,M,O"],
            'telefono_alternativo' => 'required|digits:10',
            'telefono_celular' => 'required|digits:10',
            'procedencia' => 'required',
            'promedio' => 'required|min:0.00|max:10',
            'duracion_servicio' => 'required',
            'hora_inicio' => ['required', new HoraInicioRule($this->hora_inicio, $this->duracion_servicio, $this->getHoraFin($this->hora_inicio, $this->duracion_servicio))],
            'hora_fin' => ['required'],
            'pertenencia_unica' => ['required', "in:0,1"],
            'departamento_id' => ["numeric", "nullable"],
            'aviso_de_privacidad' => ['accepted'],
            'escuela' => ['required_if:procedencia,0'],
            'carrera' => ['required_if:procedencia,1'],
            'escuela_text' => ['required_if:procedencia,2', new EscuelaExternaRule()],
            'numero_cuenta' => ['required_without:escuela_text', 'unique:alumnos,numero_cuenta' ,'digits:9', 'nullable'],
            'creditos_pagados' => ['required_unless:procedencia,2', 'numeric', 'min:1', 'nullable'],
            'avance_porcentaje' => ['required_unless:procedencia,2', 'numeric', 'max:100', 'nullable'],
        ];
    }

    public static function getHoraFin($hora_inicio, $duracion){
        $hora_inicio = Carbon::parse($hora_inicio);
        if ($duracion == "12"){
            $hora_fin = $hora_inicio->addHours(2);
        }
        else{
            $hora_fin = $hora_inicio->addHours(4);
        }

        return $hora_fin->format("H:i");
    }


    /**
     * Hace la verificación en tiempo real cuando el
     * usuario pasa al siguiente campo
     *
     * @param $propertyName
     */
    public function updated($propertyName)
    {
       $this->validateOnly($propertyName, [
            'name' => ['required', 'string', 'max:255', new NombreRule()],
            'apellido_paterno' => ['required', 'string', 'max:255', new NombreRule()],
            'apellido_materno' => ['required', 'string', 'max:255', new NombreRule()],
            'curp' => [new CurpRule()],
            'email' => ['email'],
            'telefono_alternativo' => ["digits:10"],
            'telefono_celular' => ["digits:10"],
            'hora_inicio' => ['required', new HoraInicioRule($this->hora_inicio, $this->duracion_servicio, $this->getHoraFin($this->hora_inicio, $this->duracion_servicio))],
            'hora_fin' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::min(8)->mixedCase()->numbers()->symbols()],
            'procedencia' => 'required',
            'numero_cuenta' => ['required_without:escuela_text', 'digits:9', 'nullable'],
            'creditos_pagados' => ['required_unless:procedencia,2', 'numeric', 'min:1', 'nullable'],
            'avance_porcentaje' => ['required_unless:procedencia,2', 'numeric', 'max:100', 'nullable'],
            'aviso_de_privacidad' => ['accepted'],
        ]);
    }

    public function store()
    {
        $data = $this->validate();
        $alumnoData = new AlumnoData($data);
        $filteredData = $alumnoData->getData();

        /* Crear transaccion si es que algo falla al registrar al alumno
         * y el usuario, en tal caso da un rollback borrando el registro
         * y posteriormente levanta la excepcion, este debe contener en
         * desarrollo un dd y en produccion y mensaje al usuario y generar
         * un log
         */
        DB::beginTransaction();


        try{
            $user = User::create([
                'name' => trim($filteredData["name"]),
                'apellido_paterno' => trim($filteredData['apellido_paterno']),
                'apellido_materno' => trim($filteredData["apellido_materno"]),
                'email' => strtolower(trim($filteredData["email"])),
                'password' => Hash::make($filteredData["password"]),
            ]);

            $alumno = Alumno::create([
                'user_id' => $user["id"],
                'numero_cuenta' => $filteredData['numero_cuenta'],
                'curp' => $filteredData["curp"],
                'fecha_nacimiento' => $filteredData['fecha_nacimiento'],
                'sexo' => $filteredData["sexo"],
                'telefono_alternativo' => $filteredData["telefono_alternativo"],
                'telefono_celular' => $filteredData["telefono_celular"],
                'escuela_id' => $filteredData['escuela'],
                'carrera_id' => $filteredData['carrera'],
                'creditos_pagados' => $filteredData['creditos_pagados'],
                'avance_porcentaje' => $filteredData['avance_porcentaje'],
                'promedio' => $filteredData["promedio"],
                'duracion_servicio' => $filteredData["duracion_servicio"],
                'hora_inicio' => $filteredData["hora_inicio"],
                'hora_fin' => $filteredData['hora_fin'],
                'pertenencia_unica' => $filteredData["pertenencia_unica"],
                'departamento_id' => $filteredData['departamento_id'],
                'fecha_estado' => now(),
                'estado_id' => 3,
            ]);


            DB::commit();
            $user->assignRole('alumno');
            event(new Registered($user));

            Auth::login($user);

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
        /*
         * quita al id 1 que es ingenieria ya que ya existe en la opcion de procedencia
         * y solo muestra las que sean parte de la UNAM
         */
        $escuelas = Escuela::all()->except(1)->where('is_unam', '==', '1');
        $carreras = Carrera::all();
        $departamentos = Departamento::all();


        return view('livewire.auth.registrar-alumno', [
            'escuelas' => $escuelas,
            'carreras' => $carreras,
            'departamentos' => $departamentos,
        ]);
    }

    /**
     * Setea la hora de fin a partir de la hora de inicio y la duración
     * del servicio social. Utilizada por la vista.
     * @return void
     */
    public function verificarDuracion(){
        if($this->duracion_servicio == "6" && $this->hora_inicio != ""){
            $this->hora_fin = Carbon::parse($this->hora_inicio)->addHour(4)->format("H:i");
        }
        else if ($this->duracion_servicio == "12" && $this->hora_inicio != ""){
            $this->hora_fin = Carbon::parse($this->hora_inicio)->addHour(2)->format("H:i");
        }
    }

}
