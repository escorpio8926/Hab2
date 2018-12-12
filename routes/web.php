<?php

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

Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function () {


});



Route::get("logout", function(){
    Auth::logout();
    return Redirect::to('login')->with(array('logout' => 'Has cerrado sesión correctamente.'));
});

//agrupamos todas las rutas que necesitan que el usuario este autentificado
Route::group(['middleware' => 'auth'], function () {
  // Rutas para el recurso proyecto básicamente las rutas que hacen ABM y listado de Proyectos
  Route::resource("proyectos","ProyectoController");
  // almacena la tarea nueva
  Route::post("proyectos/{proyectos}/actividade",['as' => 'proyectos.storeActividade','uses'=>'ProyectoController@storeActividade']);
  // elimina una tarea
  Route::delete("proyectos/{proyectos}/actividade/{idActividade}",['as' => 'proyectos.destroyActividade','uses'=>'ProyectoController@destroyActividade']);
  // modifica una tarea el verbo tiene que ser por método put
  Route::put("proyectos/{proyectos}/actividade/{idActividade}",['as' => 'proyectos.updateActividade','uses'=>'ProyectoController@updateActividade']);


}); //Route::group(['middleware' => 'auth'], function ()
