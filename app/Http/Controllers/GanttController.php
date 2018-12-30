<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Link;
use Illuminate\Support\Facades\Input;

class GanttController extends Controller
{
  public function get($idActividade){
    $tasks = new Task();
    $links = new Link();


    return response()->json([
        "data" => $tasks->where('actividad_id',$idActividade)->get(),
        "links" => $links->where('actividad_id',$idActividade)->get()
    ]);
  }
}
