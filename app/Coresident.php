<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coresident extends Model
{
    //
    public function household()
    {
    return $this->belongsTo(Household::class);
    }
}
