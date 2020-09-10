<?php

namespace App\Skill;

use Illuminate\Database\Eloquent\Model;

class SkillCatNotSpecified extends ReadOnlyCatNotSpecified
{
    protected $categoryNotSpecified = ['Achari','Begger','Concubine','None','Spinner'];
}
