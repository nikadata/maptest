<?php

namespace App\Skill;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyCatMusicians
{
    //
    protected $categoryMusicians = [];

    public function all()
    {
        return $this->categoryMusicians;
    }

    public function get( $id )
    {
        return $this->categoryMusicians[$id];
    }
}
