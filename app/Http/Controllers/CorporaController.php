<?php

namespace App\Http\Controllers;

use App\Corpora;
use App\Corpus;
use App\Categoria;
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
        $categorias = Categoria::paginate(10);
        return view('corporas.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categorias = Categoria::all();

      return view('corporas.create', compact('categorias'));
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
      $corpora->categoria_id = $request->categoria_id;
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
        $categorias = Categoria::all();

        return view('corporas.edit',compact('corpora','categorias'));
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
      $corpora->categoria_id = $request->categoria_id;
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
        return view('corporas.corpuses.create',compact('corpora_id'));
    }

    /**
     * Store a newly created corpus in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCorpus(Request $request, Corpora $corpora)
    {
      $corpus = new Corpus;
      $corpus->idioma = $request->idioma;
      $corpus->conteudo = $request->conteudo;
      $corpus->corpora_id = $corpora->id;

      $corpora->corpuses()->save($corpus);
      return redirect("/corporas/$corpora->id/corpus");
    }

    /**
     * Display a listing of the corpus.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCorpus(Corpora $corpora)
    {
      $corpora->corpuses = Corpus::where('corpora_id', '=', $corpora->id)->paginate(10);
      return view('corporas.corpuses.index', compact('corpora'));
    }

    /**
     * Update the specified corpus in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Corpora  $corpora
     * @return \Illuminate\Http\Response
     */
    public function updateCorpus(Request $request, Corpora $corpora, Corpus $corpus)
    {
      $corpus->conteudo = $request->conteudo;
      $corpus->idioma = $request->idioma;
      $corpus->save();
      return redirect("/corporas/$corpora->id/corpus");
    }

    /**
     * Show the form for editing the specified corpus.
     *
     * @param  \App\Corpora  $corpora
     * @return \Illuminate\Http\Response
     */
    public function editCorpus(Corpora $corpora, Corpus $corpus)
    {
        return view('corporas.corpuses.edit',compact('corpora','corpus'));
    }

    /**
     * Remove the specified corpus from storage.
     *
     * @param  \App\Corpora  $corpora
     * @return \Illuminate\Http\Response
     */
    public function destroyCorpus(Corpora $corpora, Corpus $corpus)
    {
      $corpus->delete();
      return redirect("/corporas/$corpora->id/corpus");
    }

}
