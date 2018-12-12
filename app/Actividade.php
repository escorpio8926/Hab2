<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividade extends Model
{
  public function proyecto()
{
  return $this->belongsTo(Proyecto::class);
}
}
