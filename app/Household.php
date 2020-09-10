<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    protected $fillable = [
        'name', 'number', 'fname'
    ];
    public function household()
    {
      return $this->belongsTo(SocialClass::class, Skill::class, Source::class, Village::class, Extended::class);

    }
}
