<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyFamilyline
{
    //
    protected $family_array = [];

    public function all()
    {
        return $this->family_array;
    }

    public function get( $id )
    {
        return $this->family_array[$id];
    }
}
