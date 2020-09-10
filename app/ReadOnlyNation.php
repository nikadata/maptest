<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyNation
{
    //
    protected $nations_array = [];

    public function all()
    {
        return $this->nations_array;
    }

    public function get( $id )
    {
        return $this->nations_array[$id];
    }
}
