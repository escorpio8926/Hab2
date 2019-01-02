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

class ProyectoController extends Controller
{
  /**
  * Muestra todos los proyectos
  *
  * @return Response
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
                ->Where('titulo','like',$q)
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


  }
/*
    //segunda versión asociando las tareas pasa de hacer 13 consultas a solo 4
    $proyectos = Proyecto::with('actividades') //obtener los objetos relacionados
                        ->where('user_id',Auth::user()->id) //solo los proyectos del usuario autenticado
                        ->Where('titulo','like',$q) //busca los que contengan en el titulo la palabra buscar
                        ->orderBy('id', 'desc') //en orden descendente por id
                        ->paginate(10); //genere la paginación

    return view('proyectos.index', compact('proyectos'));


  return view('proyectos.index');
  }


  * muestra el formulario para crear un Nuevo proyecto
  *
  * @return Response
  */
  public function create()
  {
    return view('proyectos.create');
  }

  /**
  * almacena un nuevo proyecto.
  *
  * @param Request $request
  * @return Response
  */
  public function store(Request $request)
  {
    $messages=[
      'titulo.required'=>'El Campo Titulo No puede ser Nulo',
      'titulo.required'=>'El Titulo debe Tener mas de 3 Caracteres',
      'descripcion.required'=>'El Campo Descripcion No puede ser Nulo',
      'descripcion.max'=>'El Campo Descripcion NO debe superar los 200 Caracteres'
    ];

    $rules =[
      'titulo' => 'required|min:3',
      'descripcion' => 'required|max:200'
    ];
    $this->validate($request,$rules,$messages);

    $proyecto = new Proyecto();

    $proyecto->titulo = $request->input("titulo");
    $proyecto->descripcion = $request->input("descripcion");
    Auth::user()->proyectos()->save($proyecto);



    return redirect()->route('proyectos.index')->with('message', 'Nuevo Proyecto Guardado!!!');
  }

  /**
  * muestra un Proyecto
  *
  * @param  int  $id
  * @return Response
  */
  public function show($id)
  {
    $proyecto = Proyecto::findOrFail($id);

    return view('proyectos.show', compact('proyecto'));
  }

  /**
  * muestra el formulario para editar el Producto
  *
  * @param  int  $id
  * @return Response
  */
  public function edit($id)
  {
    $proyecto = Proyecto::findOrFail($id);


    return view('proyectos.edit', compact('proyecto'));
  }

  /**
  * Modificar el Proyecto
  *
  * @param  int  $id
  * @param Request $request
  * @return Response
  */
  public function update(Request $request, $id)
  {

    $messages=[
      'titulo.required'=>'El Campo Titulo No puede ser Nulo',
      'titulo.required'=>'El Titulo debe Tener mas de 3 Caracteres',
      'descripcion.required'=>'El Campo Descripcion No puede ser Nulo',
      'descripcion.max'=>'El Campo Descripcion NO debe superar los 200 Caracteres'
    ];

    $rules =[
      'titulo' => 'required|min:3',
      'descripcion' => 'required|max:200'
    ];
    $this->validate($request,$rules,$messages);

    $proyecto = Proyecto::findOrFail($id);

    $proyecto->titulo = $request->input("titulo");
    $proyecto->descripcion = $request->input("descripcion");

    $proyecto->save();

    return redirect()->route('proyectos.index')->with('message', 'Proyecto Actualizado!!!');
  }

  /**
  * Elimina un Proyecto
  *
  * @param  int  $id
  * @return Response
  */
  public function destroy($id)
  {
    $proyecto = Proyecto::findOrFail($id);
    $proyecto->delete();

    return redirect()->route('proyectos.index')->with('message', 'Proyecto Eliminado!!!');
  }
  /**
  * Agrega una nueva Tarea al Proyecto
  *
  * @param  int  $id
  * @return Response
  */
  public function storeActividade(Request $request,$id)
  {

    $messages=[
      'actividad.required'=>'El Campo Actividad No puede ser Nulo',
      'actividad.required'=>'El Campo Actividad debe Tener mas de 3 Caracteres',
    ];

    $rules =[
      'actividad' => 'required|min:3'
    ];
    $this->validate($request,$rules,$messages);

    $proyecto = Proyecto::findOrFail($id);
    $actividade = new Actividade();
    $actividade->actividad = $request->input("actividad");
    $actividade->completo = false;
    $actividade->usuario_id = Auth::id();
    $proyecto->actividades()->save($actividade);
    $permiso = new Permiso();
    $permiso->leer = 1;
    $permiso->escribir = 1;
    $permiso->controltotal = 1;
    $permiso->id_usuario = Auth::id();
    $permiso->id_actividad = $actividade->id;
    $permiso->save();
    return redirect()->route('proyectos.show',$id)->with('message', 'Nueva Actividad Guardada!!!');
  }

  /**
  * Elimina una Tarea
  *
  * @param  int  $id
  * @return Response
  */
  public function destroyActividade($id,$idActividade)
  {
    $actividade=Actividade::findOrFail($idActividade);
    $actividade->delete();
    return redirect()->route('proyectos.show',$id)->with('message', 'Actividad Eliminada!!!');
  }
  /**
  * actualiza una Tarea
  *
  * @param  int  $id
  * @return Response
  */
  public function updateActividade(Request $request,$id,$idActividade)
  {
    $actividade=Actividade::findOrFail($idActividade);
    $actividade->completo=$request->input('completo');
    $actividade->save();
    return view('gantt')->with("idActividade",$idActividade)->with("actividad",$actividade);
  }

  public function verUsuarios(Request $request,$idproyecto, $idActividade){
    //dada una actividad mostrar los usuarios que tienen permiso sobre el mismo

    return view('compartir')->with('idActividade',$idActividade);
  }

  public function cambiarPermiso(Request $request,$idproyecto, $idActividade, $permiso, $idPermiso){
    $mensaje = "";
    if($permiso=="agregar"){
      if((Input::get('usuario')!=0)){
      $nperm = new Permiso; // nperm = nuevo permiso
      $nperm->id_usuario = Input::get('usuario');
      $nperm->id_actividad = $idActividade;
      $nperm->leer = false;
      $nperm->escribir = false;
      $nperm->controltotal = false;
      $nperm->save();
      }
    }else{
    $pac = Permiso::findOrFail($idPermiso); // pac = permiso a cambiar
    if ($permiso == 'leer') {
      $pac->leer = ($pac->leer==1)?0:1;
      if($pac->leer==0){
        $pac->escribir =0;
        $pac->controltotal = 0;
        $mensaje = "Acceso Denegado.";
      }else{
      $mensaje = "Permisos de lectura.";
      }
      $pac->save();
    }
    if ($permiso == 'escribir') {
      $pac->escribir = ($pac->escribir==1)?0:1;
      if ($pac->escribir==1){
        $pac->leer = 1;
        $mensaje = "Permisos de lectura y escritura.";
      }else{
        $pac->controltotal = 0;
        $mensaje = "Permisos de escritura denegado.";
      }
      $pac->save();
    }
    if ($permiso == 'controltotal') {

      $pac->controltotal = ($pac->controltotal==1)?0:1;
      if($pac->controltotal==1){
        $pac->leer = 1;
        $pac->escribir = 1;
        $mensaje = "Permisos de control total obtenidos.";
      }else{
        $mensaje = "Permisos de control total denegados.";
      }
      $pac->save();
    }
    if ($permiso == 'eliminar') {
      $pac->delete();
      $mensaje = "Permisos eliminados.";
    }
    $nombreusuario = Auth::user()->name;
    $nombreactividad = Actividade::find($idActividade)->actividad;
    \Mail::to(User::find($pac->id_usuario))->send(new PermisosModificados($nombreusuario,$nombreactividad,$mensaje));
  }
    return redirect("/proyectos/".$idproyecto."/actividade/".$idActividade."/usuarios");
  }

}
