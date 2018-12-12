<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Proyecto;
use Auth;
use App\Actividade;

class ProyectoController extends Controller
{
  /**
  * Muestra todos los proyectos
  *
  * @return Response
  */
  public function index(Request $request)
  {
    /*
    $q=$request->has('buscar')?'%'.$request->buscar.'%':'%';
    /*
    //primera versión sin incluir los datos de las tareas asociadas
    $proyectos = Proyecto::where('user_id',Auth::user()->id)
                        ->orderBy('id', 'desc')
                        ->paginate(10);
    */
/*
    //segunda versión asociando las tareas pasa de hacer 13 consultas a solo 4
    $proyectos = Proyecto::with('actividades') //obtener los objetos relacionados
                        ->where('user_id',Auth::user()->id) //solo los proyectos del usuario autenticado
                        ->Where('titulo','like',$q) //busca los que contengan en el titulo la palabra buscar
                        ->orderBy('id', 'desc') //en orden descendente por id
                        ->paginate(10); //genere la paginación
/*
    return view('proyectos.index', compact('proyectos'));
  */

  return view('proyectos.index');
  }

  /**
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
    $proyecto = Proyecto::findOrFail($id);
    $actividade = new Actividade();
    $actividade->actividad = $request->input("actividad");
		$actividade->completo = false;
    $proyecto->actividades()->save($actividade);
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
    return view('gantt');
  }
}
