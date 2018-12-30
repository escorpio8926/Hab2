<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Link;
use App\Actividade;
use App\Proyecto;
use App\Permiso;
use App\User;
use App\Mail\TareaTerminada;
use Illuminate\Support\Facades\Input;

class SendNotifications extends Controller
{

    public function send(Request $request, $periodo){
        date_default_timezone_set("America/Argentina/Tucuman");
        $tasks = Task::all();
        $ahora = new \DateTime("now");
        $mensaje = "";
        foreach ($tasks as $task){
            if($periodo==1){ //cada 24 horas, revisa si en las ultimas 24 horas, alguna tarea terminó
                if(date('Y-m-d', strtotime($task->start_date.' + '.$task->duration.' days'))==$ahora->format('Y-m-d')){
                    $actividad = Actividade::find($task->actividad_id);
                    $proyecto = Proyecto::find($actividad->proyecto_id);
                    $permisos = Permiso::where('id_actividad','=',$task->actividad_id)->get();
                    foreach($permisos as $permiso){
                    \Mail::to(User::find($permiso->id_usuario))->send(new TareaTerminada($task->text,$proyecto->titulo,$actividad->actividad,date('Y-m-d', strtotime($task->start_date.' + '.$task->duration.' days'))));
                    $mensaje .= "enviado a ".User::find($permiso->id_usuario)->name."<br>";
                    }

                }
                
            }
       // $mensaje .= $ahora;

           // $mensaje = $task->start_date."$$$".date('Y-m-d', strtotime($task->start_date.' + '.$task->duration.' days'))."$$$".$ahora->format('Y-m-d');
        }
        // date('Y-m-d', strtotime($task->start_date.' + '.$task->duration.' days'))
        return $mensaje;
    }
}

?>