<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Services\StatsCounter;

class Village_stat extends Model
{
  public function __construct()
  {
    $this->roms = app(StatsCounter::class)->getRoms(); //Roms attribute from service container

  }

  public function village()
  {

    return $this->belongsTo(Village::class);

  }

  public function avgUpdate()
  {
    //Saves average households size to Village stats
    $avgUpdate = $this->all();

    $avgVillage = $this->getAvgHousehold();
    //$villagestat = $this->village_stat;

    foreach ($avgVillage as $avg)
    {

      $stat = $this->find($avg->id);
      $stat->households_avgsize = $avg->avg;
      $stat->save();
    }
  }

  public function getAvgHousehold()
  {

    $villages = DB::table('households')
                  ->join('villages','households.village_id','=','villages.id')
                  ->join('stats','households.id','=','stats.household_id')
                  ->select(DB::raw('avg(stats.household_count) as avg, villages.id'))
                  ->groupby('villages.id')
                  ->get();
    return $villages;
  }

  public function VillageStatReset()
  {
    $pyrs = $this->all();
    foreach($pyrs as $pyr){
            $village_stat_data = $this->find($pyr->id);
            $village_stat_data->rom_households_count = 0;
            //$village_stat_data->roms_count=0;
            $village_stat_data->save();
            }
  }

  public function updateRomHouseholds()
  {
    //Households with Rom nationality per Village
    $villages = DB::table('households')
                      ->join('villages','households.village_id','=','villages.id')
                      ->select(DB::raw('villages.id, count(*) as sum'))
                      ->whereIn('households.nationality',$this->roms)
                      ->groupby('villages.id')
                      ->get();

    foreach ($villages as $village)
          {
            $village_stat_data=$this->find($village->id);
            $village_stat_data->rom_households_count = $village->sum;
            //$village_stat_data->roms_count=$village->sum;
            $village_stat_data->save();
            }
  }

  public function getVillagesRoms()
  {
    return DB::table('village_stats')
                          ->where('rom_households_count','>',0)
                          ->count();
  }

  public function getVillagesWithoutRoms()
  {
    return DB::table('village_stats')
                          ->where('rom_households_count','=',0)
                          ->count();
  }

}
