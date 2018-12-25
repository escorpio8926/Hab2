<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Link;

class GanttController extends Controller
{
  public function get(){
    $tasks = new Task();
    $links = new Link();

    return response()->json([
        "data" => $tasks->all(),
        "links" => $links->all()
    ]);
  }
}
