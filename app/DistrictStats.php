<?php

namespace App;
use App\District as District;
use App\DistrictStats as DistrictStat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DistrictStats extends Model
{
  public function update_district_stats()
  {
  $districts = District::all();
  foreach ($districts as $district)
    {
    $data['district_id'] = $district->id;
    $this->insert($data);
    }
  }

}
