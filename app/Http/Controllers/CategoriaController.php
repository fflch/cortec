<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
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
            'nome' => 'required|string',
        ]);

        $categoria = new Categoria;
        $categoria->nome = $request->nome;
        $categoria->save();

        return redirect('/corpus/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Categoria $categoria)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string',
        ]);

        $categoria->nome = $request->nome;
        $categoria->save();

        return redirect("/corpus/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect('/corpus/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(string $idioma, Categoria $categoria, string $corpus_id = '')
    {
        //Corpuses a serem exibidos
        $corpuses = $categoria->corpuses->filter(function ($corpus, $key) use ($idioma) {
            return (count($corpus->texts) > 0);
        });

        //Corpuses a serem inseridos no formulário
        $corpuses_form = $corpuses->filter(function ($corpus, $key) use ($idioma) {
            return ($corpus->hasTextLang($idioma));
        });

        $corpuses_ids = ($corpus_id === '') ? $corpuses_form->pluck('id') : array($corpus_id);

        return view('categorias.show',compact('categoria', 'corpuses', 'corpuses_ids', 'idioma'));
    }

}
