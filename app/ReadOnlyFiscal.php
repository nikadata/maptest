<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyFiscal
{
    //
    protected $fiscalvalues_array = [];

    public function all()
    {
        return $this->fiscalvalues_array;
    }

    public function get( $id )
    {
        return $this->fiscalvalues_array[$id];
    }
}
