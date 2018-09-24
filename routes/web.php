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

Route::get('/', 'IndexController@index' );

Route::get('/corporas/','CorporaController@index');
Route::resource('corporas','CorporaController');

Route::get('/corporas/{disciplina_id}/corpus/create','CorporaController@createCorpus');

Route::post('/corporas/{corpora}/corpus','CorporaController@storeCorpus');

Route::get('/locale/{locale}', function ($locale, Request $request) {
    App::setLocale('pt_');
    Session::put('locale', $locale);
    return redirect('/corporas');
});
