<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $available_villages;
    
    public function county()
    {

      return $this->belongsTo(County::class);

    }
    public function village_stat()
    {

        return $this->hasMany(Village_stat::class);

    }
    public function villageskill()
    {

        return $this->hasMany(VillageSkill::class);

    }

    public function getAvailableVillages($country)
    {
      return $available_villages = DB::table('villages');
    }
}
