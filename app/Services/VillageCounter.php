<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class VillageCounter
{
  protected $vid;
  private $village, $villages;

  public function getVillages($district=null)
  {
    switch($district)
    {
      case'Ilfov':
      $this->villages = DB::table('villages')
                        ->select('villages.id')
                        ->join('counties','villages.county_id','=','counties.id')
                        ->join('districts', 'counties.district_id','=','districts.id')
                        ->where('districts.district_name','=','Ilfov')
                        ->orderBy('villages.id')
                        ->get();
      break;
      case'Dambovita':
      $this->villages = DB::table('villages')
                        ->select('villages.id')
                        ->join('counties','villages.county_id','=','counties.id')
                        ->join('districts', 'counties.district_id','=','districts.id')
                        ->where('districts.district_name','=','Dambovita')
                        ->orderBy('villages.id')
                        ->get();
      break;
      default:
      $this->villages = DB::table('villages')
                        ->select('villages.id')
                        ->orderBy('villages.id')
                        ->get();
    }
    foreach ($this->villages as $this->village)
    {
      $this->vid[] = $this->village->id;
    }

    return $this->vid;
  }
}
