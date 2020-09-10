<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\StatsCounter;
use Illuminate\Support\Facades\DB;
use App\Village_stat as Villagestat;

use App\Village;

class Ilfovstat extends Model
{
  protected $villages;

  public function __construct()
  {
    $this->roms =   app(StatsCounter::class)->getRoms(); //Roms attribute from service container
  }

  public function getStats()
  {
    return $this->villages = DB::table('villages')
                          ->join('counties','villages.county_id','=','counties.id')
                          ->join('districts', 'counties.district_id','=','districts.id')
                          ->where('districts.district_name','=','Ilfov')
                          ->select('villages.id', 'villages.village_name', 'counties.county_name')
                          ->orderBy('village_name')
                          ->get();
  }

  public function resetStats()
  {
    DB::table('ilfovstats')->truncate();
  }

  public function saveStats($villages, $villageStat)
  {

    foreach ($villages as $village)
    {
      $ilfov = new Ilfovstat;

      $ilfov->village_id = $village->id;

      $ilfov->village_name = $village->village_name;


      $ilfov->subdistrict = $village->county_name;
      //Find village in VillageStats
      $villageStatIlfov = $villageStat->find($village->id); //Find villagestats with village_id

      $ilfov->households = $villageStatIlfov->households_count;

      $ilfov->households_avg = $villageStatIlfov->households_avgsize;

      $ilfov->romhouseholds = $villageStatIlfov->rom_households_count;

      $ilfov->romhouseholds_percent = $villageStatIlfov->rom_households_procent;

      $ilfov->roms = $villageStatIlfov->roms_count;

      //Save to db
      $ilfov->save();
    }

  }

}
