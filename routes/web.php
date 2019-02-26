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

Route::get('login', 'Auth\LoginController@redirectToProvider')->name('login');
Route::get('callback', 'Auth\LoginController@handleProviderCallback');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'IndexController@step1' );
Route::post('/analysis/tool', 'AnalysisController@toolSelection' );
Route::match(['get', 'post'], '/analysis/process', 'AnalysisController@process' );
Route::post('/analysis/concordanciador', 'AnalysisController@concordanciador' );
Route::post('/analysis/ngramas', 'AnalysisController@ngramas' );

Route::get('/corpus/','CorpusController@index');
Route::resource('corpus','CorpusController');
Route::resource('categorias','CategoriaController');

Route::get('/corpus/{disciplina_id}/text/create','CorpusController@createText');

Route::post('/corpus/{corpus}/text','CorpusController@storeText');
Route::get('/corpus/{corpus}/text','CorpusController@indexText');
Route::get('/corpus/{corpus}/text/{text}/edit','CorpusController@editText');
Route::post('/corpus/{corpus}/text/{text}','CorpusController@updateText');
Route::delete('/corpus/{corpus}/text/{text}','CorpusController@destroyText');

Route::get('/locale/{locale}', function ($locale, Request $request) {
    App::setLocale('pt_');
    Session::put('locale', $locale);
    return redirect('/');
});

Route::get('/download/frequencia', 'AnalysisController@freqTable' );
Route::get('/download/concord', 'AnalysisController@concordTable' );
Route::get('/download/ngramas', 'AnalysisController@ngramsTable' );

Route::get('/changes','ChangeController@index');

Route::get('/stopwords/{idioma}','StopwordsController@edit');
Route::post('/stopwords/update','StopwordsController@update');
