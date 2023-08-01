<?php

namespace App\Http\Livewire\Auth;

use App\Models\Escuela;

class AlumnoData
{
    private $data;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }


    public function __construct($data)
    {
        $this->data = $data;
        $this->filterData();
    }

    public function filterData(){
        $this->setDefaultValues();
        $this->clearUnusedFields();
        $this->addAdditionalFields();
        $this->normalize();
    }

    public function setDefaultValues(){
        // Si pertenence a unica se asigna el depa que quiere, en caso contrario se le asigna DSA
        $this->data['departamento_id'] = $this->data['pertenencia_unica'] == "1" ? $this->data["departamento_id"] : "1";
    }

    /**
     * Limpiara los campos que no coincidan con su procedencia
     * Si coloca que es externo no tiene un número de cuenta
     * por lo que se coloca como null.
     * @param $data
     */
    private function clearUnusedFields(){
        switch ($this->data["procedencia"]){
            // si es de la fi
            case "1":
                $this->data['escuela'] = 1;
                break;

            // si es de la unam
            case "0":
                $this->data['carrera'] = null;
                break;

            // si es externo
            case "2":
                $escuela_externa = $this->createEscuelaExterna($this->data['escuela_text']);
                $this->data['escuela'] = $escuela_externa->id;
                $this->data['avance_porcentaje'] = null;
                $this->data['creditos_pagados'] = null;
                break;
        }
    }

    public function createEscuelaExterna($escuela){
        // si la escuela existe
        $escuela_externa = Escuela::where('escuela', trim(strtoupper($escuela)))->first();
        // en caso de que no exista se crea un nuevo registro
        if (!$escuela_externa) {
            $escuela_externa = Escuela::create([
                'escuela' => trim(strtoupper($escuela)),
                'is_unam' => false,
            ]);
        }

        return $escuela_externa;
    }


    public function addAdditionalFields(){
        $this->data['fecha_nacimiento'] = $this->getFechaNacimientoWithCurp($this->data["curp"]);
        $this->data['hora_fin'] = RegistrarAlumno::getHoraFin($this->data["hora_inicio"], $this->data["duracion_servicio"]);
    }

    public function getFechaNacimientoWithCurp($curp)
    {
        // inicio en indice 4 cuando termina el nombre
        $anio = implode(array_slice(str_split($curp), 4, 2));
        $mes = implode(array_slice(str_split($curp), 6, 2));
        $dia = implode(array_slice(str_split($curp), 8, 2));
        $fecha_str = strtotime(sprintf("%s-%s-%s", $anio, $mes, $dia));
        $fecha_nacimiento = date("Y-m-d", $fecha_str);

        return $fecha_nacimiento;
    }

    public function normalize(){
        $this->data['name'] = strtolower(trim($this->data["name"]));
        $this->data['apellido_paterno'] =  trim($this->data['apellido_paterno']);
        $this->data['apellido_materno'] = trim($this->data["apellido_materno"]);
        $this->data['email'] = strtolower(trim($this->data["email"]));
        $this->data['curp'] = trim(strtoupper($this->data["curp"]));
        $this->data['telefono_celular'] = trim($this->data["telefono_celular"]);
        $this->data['telefono_alternativo'] = trim($this->data["telefono_alternativo"]);
    }
}
