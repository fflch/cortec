<?php

namespace App\Http\Controllers;

use App\Corpora;
use Illuminate\Http\Request;

class CorporaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $corporas = Corpora::all();
        return view('corporas.index', compact('corporas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Corpora  $corpora
     * @return \Illuminate\Http\Response
     */
    public function show(Corpora $corpora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Corpora  $corpora
     * @return \Illuminate\Http\Response
     */
    public function edit(Corpora $corpora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Corpora  $corpora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Corpora $corpora)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Corpora  $corpora
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corpora $corpora)
    {
        //
    }
}
