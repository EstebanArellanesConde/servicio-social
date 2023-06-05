<?php

namespace App\Http\Controllers;

use App\Models\Jefe;
use Illuminate\Http\Request;

class JefeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jefe.index');
    }


    public function inscritos(){
        return view('jefe.inscritos');
    }


    public function rechazados(){
        return view('jefe.rechazados');
    }

    public function estadisticas(){
        return view('jefe.estadisticas');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Jefe $jefe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jefe $jefe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jefe $jefe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jefe $jefe)
    {
        //
    }
}
