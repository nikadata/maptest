<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wife extends Model
{
    //
    public function household()
    {
      return $this->belongsTo(Household::class);

    }
}
