<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
  public function users()
{
  return $this->belongsToMany('App\User','proyecto_user')->withPivot('user_id','proyecto_id');
}

public function actividades()
{
		return $this->hasMany(Actividade::class);
}
}
