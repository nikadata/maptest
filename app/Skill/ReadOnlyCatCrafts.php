<?php

namespace App\Skill;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyCatCrafts
{
    //
    protected $categoryCrafts = [];

    public function all()
    {
        return $this->categoryCrafts;
    }

    public function get( $id )
    {
        return $this->categoryCrafts[$id];
    }
}
