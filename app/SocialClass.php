<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialClass extends Model
{
    // Testing method
    public static function social(){
      $socialclasses = App\SocialClass::all();
      return $socialclasses;
    }
}
