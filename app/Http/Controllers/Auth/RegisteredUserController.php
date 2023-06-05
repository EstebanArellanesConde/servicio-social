<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\CurpRule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido_paterno' => ['required', 'string', 'max:255'],
            'apellido_materno' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // Alumno
            'curp' => ['required', 'unique:alumnos,curp', new CurpRule()],
            'numero_cuenta' => 'required|unique:alumnos,numero_cuenta|digits:9',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',

            'telefono_casa' => 'required|digits:10',
            'telefono_celular' => 'required|digits:10',

            'procedencia' => 'required',
            'carrera' => ['required'],
            'fecha_ingreso_facultad' => 'required',

            'creditos_pagados' => 'required',
            'avance_porcentaje' => 'required',

            'promedio' => 'required|min:0.00|max:10',
            'duracion_servicio' => 'required',

            'hora_inicio' => 'required',
            'hora_fin' => 'required', // quitar y calcular automaticamente
            'fecha_inicio' => 'required',
            'pertenencia_unica' => 'required',

            'departamento_id' => 'required',
        ]);

        $horas_semana = $request->duracion_servicio == 12 ? 10 : 20;
        //Si el alumno es de la Fac buscamos su carrera en la bd
        $isInterno = (strcmp($request->procedencia, 'interno') == 0);

        /* Crear transaccion si es que algo falla al registrar al alumno
         * y el usuario, en tal caso da un rollback borrando el registro
         * y posteriormente levanta la excepcion, este debe contener en
         * desarrollo un dd y en produccion y mensaje al usuario y generar
         * un log
         */
        DB::beginTransaction();

        try{
            $user = User::create([
                'name' => $request->name,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $alumno = Alumno::create([
                // Alumno
                'user_id' => $user->id,
                // Alumno datos
                'numero_cuenta' => $request->numero_cuenta,
                'curp' => $request->curp,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'genero' => $request->genero, // verificar genero con rule

                'telefono_casa' => $request->telefono_casa, // verificar celular
                'telefono_celular' => $request->telefono_celular,

                'procedencia' => $isInterno, // verificar
                'carrera_id' => 1, // MAL
                'fecha_ingreso_facultad' => Carbon::parse($request->fecha_ingreso_facultad)->format('Y-m-d'), // MAL

                'creditos_pagados' => $request->creditos_pagados,
                'avance_porcentaje' => $request->avance_porcentaje,

                'promedio' => $request->promedio,
                'duracion_servicio' => $request->duracion_servicio,
                'horas_semana' => $horas_semana,

                'hora_inicio' => $request->hora_inicio,
                'hora_fin' => $request->hora_fin, // quitar y calcular automaticamente
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => Carbon::parse($request->fecha_inicio)->addMonth($request->duracion_servicio)->format('Y-m-d'),
                'pertenencia_unica' => $request->pertenencia_unica,
                'departamento_id' => 1,
            ]);

            DB::commit();
        }
        catch (\Exception $e)
        {
            DB::rollBack();
        }

        $user->assignRole('alumno');


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME . "alumno");
    }
}
