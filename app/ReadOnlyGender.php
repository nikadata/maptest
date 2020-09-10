<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyGender
{
    //
    protected $genderattrs_array = [];

    public function all()
    {
        return $this->genderattrs_array;
    }

    public function get( $id )
    {
        return $this->genderattrs_array[$id];
    }
}
