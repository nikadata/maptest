<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    //
    public function household()
    {
      return $this->belongsTo(Household::class);
    }
}
