<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\StatsCounter;
use Illuminate\Support\Facades\DB;
use App\Village_stat as Villagestat;
use App\Village;

class DambovitaStats extends Model
{
  protected $villages;
  protected $roms;

  public function __construct()
  {
    $this->roms = app(StatsCounter::class)->getRoms(); //Roms attribute from service container

  }

  public function getStats()
  {
    $this->villages = DB::table('villages')
                          ->join('counties','villages.county_id','=','counties.id')
                          ->join('districts', 'counties.district_id','=','districts.id')
                          ->where('districts.district_name','=','Dambovita')
                          ->select('villages.id', 'villages.village_name', 'counties.county_name')
                          ->orderBy('village_name')
                          ->get();
    return $this->villages;
  }

  public function resetStats()
  {
    DB::table('dambovita_stats')->truncate();
  }

  public function saveStats($villages, $villageStat)
  {

    foreach ($villages as $village)
    {
      $dambovita = new DambovitaStats;

      $dambovita->village_id = $village->id;

      $dambovita->village_name = $village->village_name;

      $dambovita->subdistrict = $village->county_name;
      //Find village in VillageStats
      $villageStatdambovita = $villageStat->find($village->id); //Find villagestats with village_id

      $dambovita->households = $villageStatdambovita->households_count;

      $dambovita->households_avg = $villageStatdambovita->households_avgsize;

      $dambovita->romhouseholds = $villageStatdambovita->rom_households_count;

      $dambovita->romhouseholds_percent = $villageStatdambovita->rom_households_procent;

      $dambovita->roms = $villageStatdambovita->roms_count;

      //Save to db
      $dambovita->save();
    }

  }

}
