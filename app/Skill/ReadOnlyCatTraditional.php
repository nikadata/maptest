<?php

namespace App\Skill;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyCatTraditional
{
    //
    protected $categoryTraditional = [];

    public function all()
    {
        return $this->categoryTraditional;
    }

    public function get( $id )
    {
        return $this->categoryTraditional[$id];
    }
}
