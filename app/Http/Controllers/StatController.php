<?php

namespace App\Http\Controllers;
use App\Village as Village;
use App\Village_stat as Villagestat;
use App\District as District;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StatController extends Controller
{
    //
    public function __construct( Villagestat $village_stat)
    {
      $this->village_stat = $village_stat->all();
    }
    public function village_stats_update()
    {
      //Update VillageStats households per villages
      $villages=Village::all();
      foreach ($villages as $village)
      {
        $village_stat_data=$this->village_stat->find($village->id);
        $village_stat_data->households_count=$village->households;
        $village_stat_data->save();
      }
      //Update VillageStats Romani households per village
      //$roms=array('Țigan', 'Bulgarian', 'Căldărar','Ciurar','Fierar','Greek','Hungarian','Inar','Jewish','Lăieș/Lăieț','Moldovean','Netot','Romanian','Rudar','Serbian','Ursar','Vătraş','Zavragiu','Zlătar');
      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      //$data['now']=Carbon::now();
      $villages = DB::table('households')
                  ->join('villages','households.village_id','=','villages.id')
                  ->join('stats','households.id','=','stats.household_id')
                    ->select(DB::raw('sum(stats.household_count) as sum, villages.id'))
                    ->whereIn('households.nationality',$roms)
                    ->groupBy('villages.id')
                    ->get();
      //return $villages;
      foreach ($villages as $village)
      {
        $village_stat_data=$this->village_stat->find($village->id);
        $village_stat_data->roms_count=$village->sum;
        $village_stat_data->save();
      }

      
    }

}
