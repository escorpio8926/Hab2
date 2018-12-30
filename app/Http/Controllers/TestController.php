<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\NotificacionPermisos;
use App\User;
use App\Mail\PermisosModificados;

class TestController extends Controller
{
    public function welcome()
    {
    
      
     // return User::find(1)->email;
      return view ('welcome');
    }
}
