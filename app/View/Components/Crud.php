<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Crud extends Component
{
    /**
     * Create a new component instance.
     */

    private $acciones;
    public $accionesPermitidas;
    public $alumnos;

    public function __construct(
        $alumnos,
        $acciones = [],
    )
    {
        $this->acciones = [
            'rechazar' => new Accion(
                'rechazar',
                'red',
                'jefe.rechazar'
            ),
            'aceptar' => new Accion(
                'aceptar',
                'sky',
                'jefe.aceptar'
            ),
            'finalizar' => new Accion(
                'finalizar',
                'sky',
                'jefe.finalizar'
            ),
            'pendiente' => new Accion(
                'pendiente',
                'sky',
                'jefe.pendiente'
            ),
        ];

        for ($i = 0; $i < count($acciones); $i++) {
            if (array_key_exists($acciones[$i], $this->acciones)) {
                $accionRequerida = $acciones[$i];
                $this->accionesPermitidas[$accionRequerida] = $this->acciones[$accionRequerida];
            }
        }

        $this->alumnos = $alumnos;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.crud', [
            'alumnos' => $this->alumnos,
            'acciones' => $this->accionesPermitidas,
        ]);
    }
}

class Accion{
    public $accion;
    public $color;
    public $route;
    public function __construct($accion, $color, $route)
    {
        $this->accion = ucfirst($accion);
        $this->color = $color;
        $this->route = $route;
    }
}
