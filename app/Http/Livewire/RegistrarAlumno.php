<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\Departamento;
use App\Models\Escuela;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\CurpRule;
use App\Rules\HoraInicioRule;
use App\Rules\NombreRule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            //'numero_cuenta' => 'unique:alumnos,numero_cuenta|digits:9',
            'numero_cuenta' => '',
            'sexo' => ['required', "in:H,M,O"],
            'telefono_alternativo' => 'required|digits:10',
            'telefono_celular' => 'required|digits:10',
            'procedencia' => 'required',
            'escuela' => [],
            'escuela_text' => [],
            'carrera' => [],
            // 'fecha_ingreso_facultad' => ["required", "after:".$this->get_fecha_nacimiento($this->curp), "before:".Carbon::now()],
            //'creditos_pagados' => 'required|min:1',
            'creditos_pagados' => [],
            //'avance_porcentaje' => 'required|max:120',
            'avance_porcentaje' => [],
            'promedio' => 'required|min:0.00|max:10',
            'duracion_servicio' => 'required',
            'hora_inicio' => ['required', new HoraInicioRule($this->hora_inicio, $this->duracion_servicio, $this->get_hora_fin($this->hora_inicio, $this->duracion_servicio))],
            'hora_fin' => ['required'],
            'pertenencia_unica' => ['required', "in:0,1"],
            'departamento_id' => ["numeric", "nullable"],
            'aviso_de_privacidad' => ['accepted'],
        ];
    }

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


    /**
     * Hace la verificación en tiempo real cuando el
     * usuario pasa al siguiente campo
     *
     * @param $propertyName
     * @return bool
     */
    public function updated($propertyName)
    {
       $this->validateOnly($propertyName, [
            'name' => ['required', 'string', 'max:255', new NombreRule()],
            'apellido_paterno' => ['required', 'string', 'max:255', new NombreRule()],
            'apellido_materno' => ['required', 'string', 'max:255', new NombreRule()],
            'curp' => [new CurpRule()],
            'email' => ['email'],
           //'numero_cuenta' => 'unique:alumnos,numero_cuenta|digits:9',
            'numero_cuenta' => '',
            'telefono_alternativo' => ["digits:10"],
            'telefono_celular' => ["digits:10"],
            // 'fecha_ingreso_facultad' => ["required", "after:".$this->get_fecha_nacimiento($this->curp), "before:".Carbon::now()->toDateString()],
            'hora_inicio' => ['required', new HoraInicioRule($this->hora_inicio, $this->duracion_servicio, $this->get_hora_fin($this->hora_inicio, $this->duracion_servicio))],
            'hora_fin' => ['required'],
            //'creditos_pagados' => ['required', 'numeric', 'min:1'],
            //'avance_porcentaje' => ['required', 'numeric', 'min:35', 'max:120'],
            'password' => ['required', 'confirmed', Rules\Password::min(8)->mixedCase()->numbers()->symbols()],
            'aviso_de_privacidad' => ['accepted'],
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
                'name' => trim($data["name"]),
                'apellido_paterno' => trim($data['apellido_paterno']),
                'apellido_materno' => trim($data["apellido_materno"]),
                'email' => strtolower(trim($data["email"])),
                'password' => Hash::make($data["password"]),
            ]);

            // si es 1 es de la fi, 0 para unam y 2 para externos
            /* VALORES POR DEFECTO */
            $escuela_id = 1; // fi por defecto
            $carrera_id = null;
            $numero_cuenta = null;
            $avance_porcentaje = null;
            $creditos_pagados = null;

            /*
             * Limpiara los campos que no coincidan con su procedencia
             * Si coloca que es externo no tiene un número de cuenta
             * por lo que se coloca como null
             */
            switch ($data["procedencia"]){
                // si es de la fi
                case "1":
                    $carrera_id = $data["carrera"];
                    $numero_cuenta = $data["numero_cuenta"];
                    $avance_porcentaje = $data["avance_porcentaje"];
                    $creditos_pagados = $data["creditos_pagados"];
                    break;

                // si es de la unam
                case "0":
                    $escuela_id = $data["escuela"];
                    $numero_cuenta = $data["numero_cuenta"];
                    $avance_porcentaje = $data["avance_porcentaje"];
                    $creditos_pagados = $data["creditos_pagados"];
                    break;

                case "2":
                    // si la escuela existe
                    $escuela_externa = Escuela::where('escuela', trim(strtoupper($this->escuela_text)))->first();

                    // en caso de que no exista se crea un nuevo registro
                    if (!$escuela_externa) {
                        $escuela_externa = Escuela::create([
                            'escuela' => trim(strtoupper($this->escuela_text)),
                            'is_unam' => false,
                        ]);
                    }

                    $escuela_id = $escuela_externa->id;
                    break;
            }

            $alumno = Alumno::create([
                // Alumno
                'user_id' => $user["id"],
                // Alumno datos
                'numero_cuenta' => $numero_cuenta,
                'curp' => trim(strtoupper($data["curp"])),
                'fecha_nacimiento' => $fecha_nacimiento,
                'sexo' => $data["sexo"], // verificar sexo con rule

                'telefono_alternativo' => trim($data["telefono_alternativo"]),
                'telefono_celular' => trim($data["telefono_celular"]),



                'escuela_id' => $escuela_id,
                'carrera_id' => $carrera_id,


                'creditos_pagados' => $creditos_pagados,
                'avance_porcentaje' => $avance_porcentaje,

                'promedio' => $data["promedio"],
                'duracion_servicio' => $data["duracion_servicio"],

                'hora_inicio' => $data["hora_inicio"],
                'hora_fin' => $this->get_hora_fin($data["hora_inicio"], $data["duracion_servicio"]),
                'pertenencia_unica' => $data["pertenencia_unica"],
                /*
                 * Si es parte de unica se asigna el que quiere, en caso contrario se asigna el DSA
                 */
                'departamento_id' => $departamento_id,
                'estado_id' => "3", // pendiente

                /*
                 * Campos pendientes
                 */

                //'fecha_ingreso_facultad' => Carbon::parse($data["fecha_ingreso_facultad"])->format('Y-m-d'), // MAL
                //'fecha_fin' => Carbon::parse("2023-06-01")->addMonths($data["duracion_servicio"])->format('Y-m-d'),
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
        /*
         * quita al id 1 que es ingenieria ya que ya existe en la opcion de procedencia
         * y solo muestra las que sean parte de la UNAM
         */
        $escuelas = Escuela::all()->except(1)->where('is_unam', '==', '1');
        $carreras = Carrera::all();
        $departamentos = Departamento::all();

        return view('livewire.registrar-alumno', [
            'escuelas' => $escuelas,
            'carreras' => $carreras,
            'departamentos' => $departamentos,
        ]);
    }
}
