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

Route::get('/', function () {
    \App::setLocale(\Session::get('idioma'));
    return view('layout');
});

Auth::routes([ 'register' => false ]);

Route::post('/albuns', 'AlbumsController@load');
Route::get('/album/{id}', 'AlbumsController@loadAlbum');
Route::post('/contato', 'ContatoController@index')->name('contato');

Route::get('/{idioma}/lang', 'AlbumsController@changeLang');



Route::get('/novoAlbum', function() {
    return view('auth.Album');
})->middleware('auth');

Route::post('/novoAlbumSave','AlbumsController@save')->name('novoAlbumSave')->middleware('auth');
Route::patch('{id}/atualizarAlbum','AlbumsController@atualizarAlbum')->name('atualizarAlbum')->middleware('auth');
Route::get('{id}/editarAlbuns', 'AlbumsController@editar')->middleware('auth');
Route::get('/admin', 'AlbumsController@index')->name('home')->middleware('auth');
Route::get('/home', 'AlbumsController@index')->name('home')->middleware('auth');
Route::delete('/album/delete/{id}','AlbumsController@deleteAlbum')->middleware('auth');
Route::delete('/imagem/delete/{id}','AlbumsController@deleteImagem')->middleware('auth');
Route::get("/status/{status}/{id}", "AlbumsController@publicao")->middleware('auth');

