<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VillageSkill extends Model
{
  public function village()
  {

    return $this->belongsTo(Village::class);

  }
}
