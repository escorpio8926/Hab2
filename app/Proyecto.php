<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
  public function users()
{
  return $this->belongsToMany(User::class);
}

public function actividades()
{
		return $this->hasMany(Actividade::class);
}
}
