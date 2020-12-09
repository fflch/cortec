<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\CorpusController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ChangeController;
use App\Http\Controllers\StopwordsController;
use App\Http\Controllers\AvisoController;

// Rotas Login
Route::get('login', [LoginController::class, 'redirectToProvider'])->name('login');
Route::get('callback', [LoginController::class, 'handleProviderCallback']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


// Rotas Index
Route::get('/', [IndexController::class, 'index']);


// Rotas Analysis
Route::post('/analysis/tool', [AnalysisController::class, 'toolSelection']);
Route::match(['get', 'post'], '/analysis/process', [AnalysisController::class, 'process']);
Route::post('/analysis/concordanciador', [AnalysisController::class, 'concordanciador']);
Route::post('/analysis/ngramas', [AnalysisController::class, 'ngramas']);
Route::get('/download/frequencia', [AnalysisController::class, 'freqTable']);
Route::get('/download/concord', [AnalysisController::class, 'concordTable']);
Route::get('/download/ngramas', [AnalysisController::class, 'ngramsTable']);


// Rotas Corpus
Route::resource('corpus', CorpusController::class);
//Route::get('/corpus/', [CorpusController::class, 'index']);
Route::get('/corpus/{disciplina_id}/text/create', [CorpusController::class, 'createText']);
Route::post('/corpus/{corpus}/text', [CorpusController::class, 'storeText']);
Route::get('/corpus/{corpus}/text', [CorpusController::class, 'indexText']);
Route::get('/corpus/{corpus}/text/{text}/edit', [CorpusController::class, 'editText']);
Route::post('/corpus/{corpus}/text/{text}', [CorpusController::class, 'updateText']);
Route::delete('/corpus/{corpus}/text/{text}', [CorpusController::class, 'destroyText']);

Route::get('/locale/{locale}', function ($locale, Request $request) {
    App::setLocale('pt_');
    Session::put('locale', $locale);
    return redirect('/');
});


// Rotas Categoria
Route::resource('categorias', CategoriaController::class)->except(['index', 'show'])->middleware('auth');
Route::get('/categorias/{idioma}/{categoria}/{corpus_id?}',[CategoriaController::class, 'show']);


// Rotas Change
Route::get('/changes', [ChangeController::class, 'index']);


// Rotas Stopwords
Route::get('/stopwords/{idioma}', [StopwordsController::class, 'edit']);
Route::post('/stopwords/update', [StopwordsController::class, 'update']);


// Rotas Aviso
Route::get('/avisos/create', [AvisoController::class, 'create']);
Route::get('/avisos/edit', [AvisoController::class, 'edit']);
Route::post('/avisos/{aviso}', [AvisoController::class, 'update']);
Route::post('/avisos', [AvisoController::class, 'store']);
