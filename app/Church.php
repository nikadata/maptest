<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    //
    public function village()
    {
      return $this->belongsTo(Village::class);
    }
}
