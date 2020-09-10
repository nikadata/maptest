<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
