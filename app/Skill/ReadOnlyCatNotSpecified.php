<?php

namespace App\Skill;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyCatNotSpecified
{
    //
    protected $categoryNotSpecified = [];

    public function all()
    {
        return $this->categoryNotSpecified;
    }

    public function get( $id )
    {
        return $this->categoryNotSpecified[$id];
    }
}
