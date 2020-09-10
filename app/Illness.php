<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Illness extends ReadOnlyIllness
{
    //
    protected $illness_array = ['None','Physical illness', 'Mental illness','Disabilities'];
}
