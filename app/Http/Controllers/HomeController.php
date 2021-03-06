<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Proyecto;
use Auth;
use App\Actividade;
use App\User;
use App\Permiso;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


     public function index(Request $request)
     {

       $q=$request->has('buscar')?'%'.$request->buscar.'%':'%';

       //primera versión sin incluir los datos de las tareas asociadas


      $pro= DB::table('proyecto_user')
                           ->where('user_id',Auth::user()->id)
                           ->orderBy('id', 'desc')
                           ->paginate(100);

      $pra=Proyecto::with('actividades')
                   ->get();

  //obtener actividades compartidas conmigo
  $permisos = Permiso::where('id_usuario','=',Auth::id())->get();
  $compartidos = [];
  foreach($permisos as $permiso){
      if(Actividade::findOrFail($permiso->id_actividad)->usuario_id!=Auth::id()){
          array_push($compartidos,$permiso);
      }
  }
  $permisos = $compartidos;


  

  //fin obtener actividades compartidas

return view('proyectos.index', compact('pro','pra','permisos'));
  

  //fin obtener actividades compartidas

return view('proyectos.index', compact('pro','pra','permisos'));



     }

}
