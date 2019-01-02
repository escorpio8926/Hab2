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






Route::get('/sendnotifications/{periodo}','SendNotifications@send');

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
  //ver usuarios con los que se comparte una actividad
  Route::get("proyectos/{proyectos}/actividade/{idActividade}/usuarios", ['as' => 'proyectos.verUsuarios', 'uses'=>'ProyectoController@verUsuarios']);

  Route::get("proyectos/{proyectos}/actividade/{idActividade}/usuarios/{permiso}/{idPermiso}", ['as' => 'proyectos.cambiarPermiso', 'uses'=>'ProyectoController@cambiarPermiso']);
}); //Route::group(['middleware' => 'auth'], function ()


Route::middleware(['auth','admin'])->group(function () {
      Route::get('/admin/index','AdminController@control');
  });
