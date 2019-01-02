<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Proyecto;
use Auth;
use App\Actividade;
use App\User;
use App\Permiso;
use Illuminate\Support\Facades\Input;
use App\Mail\PermisosModificados;

class AdminController extends Controller
{
  /**
  * Muestra todos los proyectos
  *
  * @return Response
  */
 public function control(Request $request)
 {

   $q=$request->has('buscar')?'%'.$request->buscar.'%':'%';

  $pra= DB::table('proyectos')
                       ->Where('titulo','like',$q)
                       ->orderBy('id', 'desc')
                       ->paginate(100);

   return view('admin.index', compact('pra'));

 }

}
