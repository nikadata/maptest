<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    //
    public function county()
    {
        return $this->hasMany(County::class);

    }
}
