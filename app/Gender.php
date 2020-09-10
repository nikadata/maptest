<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends ReadOnlyGender
{
    //
    protected $genderattrs_array = ['Male', 'Female'];
}
