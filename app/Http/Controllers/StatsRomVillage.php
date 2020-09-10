<?php

namespace App\Http\Controllers;
use App\Charts\SampleChart;
use App\Village;
use App\Household;
use App\Village_stat as Villagestat;
use App\DistrictStats as DistrictStats;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatsRomVillage extends Controller
{
    //
    public function __construct( Villagestat $village_stat, DistrictStats $district_stat)
    {
      $this->village_stat = $village_stat->all();
      $this->district_stat = $district_stat->all();
    }
    public function roms_village()
    {
      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $villages=DB::table('village_stats')
                    ->whereNotNull('rom_households_count')
                    ->orderBy('village_name')
                    ->get();
      //Create Chart object
      $village_rom=new SampleChart;
      //Load api reference
      $api=url('/stats_data_rom');
      //Assign label
      foreach ($villages as $village) {
        $label[]=$village->village_name;
      }
      $village_rom->labels($label)->load($api);
      //Table view
      $data=[];
      //Update stats

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
      //Update VillageStats percent % households per villages
      $villages=Village::all();
      foreach ($villages as $village)
      {
        $village_stat_data=$this->village_stat->find($village->id);
        if($village_stat_data->rom_households_count==0 || $village_stat_data->households_count == 0){
          $village_stat_data->rom_households_procent=0;
        }
        else{
        $village_stat_data->rom_households_procent=($village_stat_data->rom_households_count/$village_stat_data->households_count);
      }
        $village_stat_data->save();
      }

      //
     $data['now']=Carbon::now();
      $data['villages']=Villagestat::all()->sortBy('village_name');
      $data['total']=DB::table('nations')->sum('total'); //Tempory data sourse for calculationg
      //$data['total']=DB::table('village_stats')->sum('village_stats.roms_count');
      //$data['maxs']=DB::table('village_stats')->find(DB::table('village_stats')->max('roms_count'));
       $data['maxs'] = DB::table('village_stats')->orderBy('roms_count','desc')->first();
       $data['min'] = DB::table('village_stats')->orderBy('roms_count','asc')->first();
      /*$data['maxs']=DB::table('village_stats')
                      ->select(DB::raw('village_stats.village_name, max(roms_count) as max'))
                      ->groupby('village_stats.village_name')
                      ->get();
*/

      //General data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      $data['romstotal']=DB::table('nations')->sum('total'); 
      $data['village_records']=Village::count();
      //
      return view('charts/village/rom',['village_rom'=>$village_rom], $data);

    }
    public function response_rom()
    {
      //This function
      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $data=[];
      $village_rom=new SampleChart;

      $villages=DB::table('village_stats')
                    ->whereNotNull('rom_households_count')
                    ->orderBy('village_name')
                    ->get();
      foreach ($villages as $village) {
        //$name[]=$village->village_name;
        $sum[]=$village->roms_count;
      }

      //$village_rom->dataset('Households(total)', 'bar', $households)->color('#00ff00');
      $village_rom->dataset('Roms per village', 'bar', $sum)->color('#00ff00');
      //$village_rom->dataset('Roms total', 'bar', $rom_total)->color('#ff0000');
      return $village_rom->api();

    }
}
