<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extended extends Model
{
    //
    public function household()
    {
        return $this->hasMany(Household::class);
    }
}
