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
        $corporas = Corpora::paginate(10);
        return view('corporas.index', compact('corporas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('corporas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $corpora = new Corpora;
      $corpora->titulo = $request->titulo;
      $corpora->descricao = $request->descricao;
      $corpora->save();
      return redirect('/corporas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Corpora  $corpora
     * @return \Illuminate\Http\Response
     */
    public function show(Corpora $corpora)
    {
        return view('corporas.show',compact('corpora'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Corpora  $corpora
     * @return \Illuminate\Http\Response
     */
    public function edit(Corpora $corpora)
    {
        return view('corporas.edit',compact('corpora'));
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
      $corpora->titulo = $request->titulo;
      $corpora->descricao = $request->descricao;
      $corpora->save();
      return redirect("/corporas/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Corpora  $corpora
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corpora $corpora)
    {
      $corpora->delete();
      return redirect('/corporas/');
    }

    /**
     * Show the form for creating a new corpus.
     *
     * @return \Illuminate\Http\Response
     */
     public function createCorpus($corpora_id)
    {
        return view('corpora.corpuses.create',compact('corpora_id'));
    }

    /**
     * Store a newly created corpus in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCorus(Request $request)
    {
      $corpus = new \App\Corpus;
      $corpus->conteudo = $request->conteudo;
      $corpus->corpora_id = $corpora->id;

      $corpora->corpuses()->save($corpus);
      return redirect("/corporas/$corpora->id");
    }
}
