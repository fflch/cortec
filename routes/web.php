<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@step1' );
Route::post('/analysis/tool', 'AnalysisController@toolSelection' );
Route::match(['get', 'post'], '/analysis/process', 'AnalysisController@process' );
Route::post('/analysis/concordanciador', 'AnalysisController@concordanciador' );

Route::get('/corpus/','CorpusController@index');
Route::resource('corpus','CorpusController');
Route::resource('categorias','CategoriaController');

Route::get('/corpus/{disciplina_id}/text/create','CorpusController@createText');

Route::post('/corpus/{corpora}/text','CorpusController@storeText');
Route::get('/corpus/{corpora}/text','CorpusController@indexText');
Route::get('/corpus/{corpora}/text/{text}/edit','CorpusController@editText');
Route::post('/corpus/{corpora}/text/{text}','CorpusController@updateText');
Route::delete('/corpus/{corpora}/text/{text}','CorpusController@destroyText');

Route::get('/locale/{locale}', function ($locale, Request $request) {
    App::setLocale('pt_');
    Session::put('locale', $locale);
    return redirect('/');
});

Route::get('/download/frequencia', 'AnalysisController@freqTable' );
Route::get('/download/concord', 'AnalysisController@concordTable' );
