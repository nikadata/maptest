<?php

namespace App\Skill;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyCatHigherStatus
{
    //
    protected $categoryHigherStatus = [];

    public function all()
    {
        return $this->categoryHigherStatus;
    }

    public function get( $id )
    {
        return $this->categoryHigherStatus[$id];
    }
}
