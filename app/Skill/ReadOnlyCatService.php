<?php

namespace App\Skill;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyCatService
{
    //
    protected $categoryService = [];

    public function all()
    {
        return $this->categoryService;
    }

    public function get( $id )
    {
        return $this->categoryService[$id];
    }
}
