<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyIllness
{
    //
    protected $illness_array = [];

    public function all()
    {
        return $this->illness_array;
    }

    public function get( $id )
    {
        return $this->illness_array[$id];
    }
}
