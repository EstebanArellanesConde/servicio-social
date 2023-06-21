<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\Departamento;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\CurpRule;
use App\Rules\HoraInicioRule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Validation\Rules;

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
    public $fecha_nacimiento;
    public $sexo;
    public $telefono_alternativo;
    public $telefono_celular;
    public $interno;
    public $carrera;
    public $escuela;
    public $fecha_ingreso_facultad;
    public $creditos_pagados;
    public $avance_porcentaje;
    public $promedio;
    public $duracion_servicio;
    public $hora_inicio;
    public $hora_fin;
    public $pertenencia_unica;
    public $departamento_id;


    protected $rules = [
        'name' => ['required', 'string', 'max:255', 'alpha_spaces'],
        'apellido_paterno' => ['required', 'string', 'max:255', "alpha_spaces"],
        'apellido_materno' => ['required', 'string', 'max:255', "alpha_spaces"],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'confirmed'],

        // Alumno
        'curp' => ['required', 'unique:alumnos,curp'],
        'numero_cuenta' => 'required|unique:alumnos,numero_cuenta|digits:9',
        'fecha_nacimiento' => 'required',
        'sexo' => 'required',

        'telefono_alternativo' => 'required|digits:10',
        'telefono_celular' => 'required|digits:10',

        'interno' => ['required', "in:0,1"],
        'carrera' => [],
        'fecha_ingreso_facultad' => ["required"],

        'creditos_pagados' => 'required',
        'avance_porcentaje' => 'required',

        'promedio' => 'required|min:0.00|max:10',
        'duracion_servicio' => 'required',

        'hora_inicio' => 'required',
        'hora_fin' => ['required'],
        'pertenencia_unica' => 'required',

        'departamento_id' => 'required',
    ];

    public function verificar_duracion(){
        if($this->duracion_servicio == "6" && $this->hora_inicio != ""){
            $this->hora_fin = Carbon::parse($this->hora_inicio)->addHour(4)->format("H:i");
        }
        else if ($this->duracion_servicio == "12" && $this->hora_inicio != ""){
            $this->hora_fin = Carbon::parse($this->hora_inicio)->addHour(2)->format("H:i");
        }
    }

    public function get_fecha_nacimiento($curp)
    {
        // inicio en indice 4 cuando termina el nombre
        $anio = implode(array_slice(str_split($curp), 4, 2));
        $mes = implode(array_slice(str_split($curp), 6, 2));
        $dia = implode(array_slice(str_split($curp), 8, 2));
        $fecha_str = strtotime(sprintf("%s-%s-%s", $anio, $mes, $dia));
        $fecha_nacimiento = date("Y-m-d", $fecha_str);

        return $fecha_nacimiento;
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'alpha_spaces'],
            'apellido_paterno' => ['required', 'string', 'max:255', "alpha_spaces"],
            'apellido_materno' => ['required', 'string', 'max:255', "alpha_spaces"],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::min(12)->letters()->numbers()->symbols()],

            // Alumno
            'curp' => ['required', 'unique:alumnos,curp', new CurpRule()],
            'numero_cuenta' => 'required|unique:alumnos,numero_cuenta|digits:9',
            'sexo' => ['required', "in:H,M,O"],

            'telefono_alternativo' => 'required|digits:10',
            'telefono_celular' => 'required|digits:10',

            'interno' => 'required',
            'carrera' => [],
            'fecha_ingreso_facultad' => ["required", "after:".$this->get_fecha_nacimiento($this->curp), "before:".Carbon::now()],

            'creditos_pagados' => 'required|min:1',
            'avance_porcentaje' => 'required|max:120',

            'promedio' => 'required|min:0.00|max:10',
            'duracion_servicio' => 'required',

            'hora_inicio' => ['required', new HoraInicioRule($this->hora_inicio, $this->duracion_servicio, $this->get_hora_fin($this->hora_inicio, $this->duracion_servicio))],
            'hora_fin' => ['required'],
            'pertenencia_unica' => ['required', "in:0,1"],
            'departamento_id' => ["numeric", "nullable"],
        ];
    }

    public function get_hora_fin($hora_inicio, $duracion){
        $hora_inicio = Carbon::parse($hora_inicio);
        if ($duracion == "12"){
            $hora_fin = $hora_inicio->addHours(2);
        }
        else{
            $hora_fin = $hora_inicio->addHours(4);
        }

        return $hora_fin->format("H:i");
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            /* alpha_spaces es una regla personalizada para solo aceptar letras y espacios */
            'name' => ['required', 'string', 'max:255', 'alpha_spaces'],
            'apellido_paterno' => ['required', 'string', 'max:255', "alpha_spaces"],
            'apellido_materno' => ['required', 'string', 'max:255', "alpha_spaces"],
            'curp' => [new CurpRule()],
            'email' => ['email'],
            'numero_cuenta' => ["digits:9"],
            'telefono_alternativo' => ["digits:10"],
            'telefono_celular' => ["digits:10"],
            'fecha_ingreso_facultad' => ["required", "after:".$this->get_fecha_nacimiento($this->curp), "before:".Carbon::now()->toDateString()],
            'hora_inicio' => ['required', new HoraInicioRule($this->hora_inicio, $this->duracion_servicio, $this->get_hora_fin($this->hora_inicio, $this->duracion_servicio))],
            'hora_fin' => ['required'],
            'creditos_pagados' => ['required', 'numeric', 'min:1'],
            'avance_porcentaje' => ['required', 'numeric', 'min:35', 'max:120'],
            'password' => ['required', 'confirmed', Rules\Password::min(12)->letters()->numbers()->symbols()],
        ]);
    }

    public function store()
    {
        $data = $this->validate();
        $fecha_nacimiento = $this->get_fecha_nacimiento($data["curp"]);
        /*
         * Si pertenence a unica se asigna el depa que quiere, en caso contrario se le asigna DSA
         */
        $departamento_id = $this->pertenencia_unica == "1" ? $data["departamento_id"] : "1";

        /* Crear transaccion si es que algo falla al registrar al alumno
         * y el usuario, en tal caso da un rollback borrando el registro
         * y posteriormente levanta la excepcion, este debe contener en
         * desarrollo un dd y en produccion y mensaje al usuario y generar
         * un log
         */
        DB::beginTransaction();

        try{
            $user = User::create([
                'name' => $data["name"],
                'apellido_paterno' => $data['apellido_paterno'],
                'apellido_materno' => $data["apellido_materno"],
                'email' => $data["email"],
                'password' => Hash::make($data["password"]),
            ]);

            $alumno = Alumno::create([
                // Alumno
                'user_id' => $user["id"],
                // Alumno datos
                'numero_cuenta' => $data["numero_cuenta"],
                'curp' => strtoupper($data["curp"]),
                'fecha_nacimiento' => $fecha_nacimiento,
                'sexo' => $data["sexo"], // verificar sexo con rule

                'telefono_alternativo' => $data["telefono_alternativo"], // verificar celular
                'telefono_celular' => $data["telefono_celular"],

                'interno' => $data["interno"],
                'carrera_id' => $data["carrera"],
                'fecha_ingreso_facultad' => Carbon::parse($data["fecha_ingreso_facultad"])->format('Y-m-d'), // MAL

                'creditos_pagados' => $data["creditos_pagados"],
                'avance_porcentaje' => $data["avance_porcentaje"],

                'promedio' => $data["promedio"],
                'duracion_servicio' => $data["duracion_servicio"],

                'hora_inicio' => $data["hora_inicio"],
                'hora_fin' => $this->get_hora_fin($data["hora_inicio"], $data["duracion_servicio"]),
                //'fecha_fin' => Carbon::parse("2023-06-01")->addMonths($data["duracion_servicio"])->format('Y-m-d'),
                'pertenencia_unica' => $data["pertenencia_unica"],
                /*
                 * Si es parte de unica se asigna el que quiere, en caso contrario se asigna el DSA
                 */
                'departamento_id' => $departamento_id,
                'estado_id' => "3", // pendiente
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
        // Obtener carreras
        $carreras = Carrera::all();
        $departamentos = Departamento::all();

        return view('livewire.registrar-alumno', [
            'carreras' => $carreras,
            'departamentos' => $departamentos,
        ]);
    }
}
