<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    public function usuario(){
        return $this->belongsTo('App\User','id_usuario');
    }

    public function actividad(){
        return $this->belongsTo('App\Actividade','id_actividad');
    }

    
}
