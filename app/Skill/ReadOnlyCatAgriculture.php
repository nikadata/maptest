<?php

namespace App\Skill;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyCatAgriculture
{
    //
    protected $categoryAgriculture = [];

    public function all()
    {
        return $this->categoryAgriculture;
    }

    public function get( $id )
    {
        return $this->categoryAgriculture[$id];
    }
}
