<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    //
    public function villages()
    {
        return $this->hasMany(Village::class);

    }
    public function district()
    {
      return $this->belongsTo(District::class);

    }
    public function source()
    {
      return $this->belongsTo(Source::class);

    }
}
