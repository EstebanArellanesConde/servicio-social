<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JefeDocumentacionController extends Controller
{
    public function index(){
        return view('jefe_documentacion.index');
    }

    public function estadisticas(){
        return view('jefe_documentacion.estadisticas');
    }

    public function configuracion(){
        return view('jefe_documentacion.configuracion');
    }
}
