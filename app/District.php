<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    public function country()
    {
      return $this->belongsTo(Country::class);

    }
    public function county()
    {
        return $this->hasMany(County::class);

    }
}
