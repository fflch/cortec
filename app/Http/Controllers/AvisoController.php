<?php

namespace App\Http\Controllers;

use App\Aviso;
use Illuminate\Http\Request;

class AvisoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avisos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo'  => 'required|string',
            'texto'   => 'required|string'
        ]);

        $aviso = new Aviso;
        $aviso->titulo = $request->titulo;
        $aviso->texto  = $request->texto;
        $aviso->ativado = false;
        $aviso->save();

        return redirect('/avisos/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $aviso = Aviso::all()->first();
        return view('avisos.edit',compact('aviso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aviso $aviso)
    {
        $validatedData = $request->validate([
            'titulo'  => 'required|string',
            'texto'   => 'required|string',
            'ativado' => 'required|boolean',
        ]);

        $aviso->titulo  = $request->titulo;
        $aviso->texto   = $request->texto;
        $aviso->ativado = $request->ativado;
        $aviso->save();

        return redirect('/avisos/edit');
    }
}
