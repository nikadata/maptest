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

class StatsPlaiController extends Controller
{
    //
    public function __construct( Villagestat $village_stat, DistrictStats $district_stat)
    {
      $this->village_stat = $village_stat->all();
      $this->district_stat = $district_stat->all();
    }
    public function plai()
    {
      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $land='Plai';
      $count_households=new SampleChart;
      $api=url('/plai_data');
      $villages =  DB::table('counties')
                  ->join('villages','counties.id','=','villages.county_id')
                    ->select('villages.id','villages.households','villages.village_name')
                    ->where('counties.county_description','=',$land)
                    ->orderBy('villages.village_name')
                    ->get();
                    $stats =  DB::table('counties')
                                        ->join('villages','counties.id','=','villages.county_id')
                                        ->select('villages.id','villages.village_name')
                                        ->where('counties.county_description','=',$land)
                                        ->orderBy('villages.village_name')
                                        ->get();

                    //return $data['number_plai']=count($stats);
                    foreach ($stats as $stat) {
                      $data['villages'][]=Villagestat::find($stat->id);
                    //  $maxs[]=Villagestat::find($stat->id);
                    }
      //Counting villages in Plai with and without Roms
      $all=0;
      $with=0;
      $village_stats=Villagestat::all();
      foreach ($villages as $village) {
        $label[]=$village->village_name;
        $village_stat_data=$this->village_stat->find($village->id);
        if($village->households>0){$all++;}
        if($village_stat_data->rom_households_count>0){$with++;}
      }
      $data['rom_villages']=$with;
      $data['without_rom']=$all-$with;
      //return $with;

//
      $count_households->labels($label)->load($api);
      //General data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
      $data['romstotal']=DB::table('nations')->sum('total');
      $data['village_records']=Village::count();
      //
      return view('charts/plai',['count_households'=>$count_households],$data);
    }
    public function response()
    {
      $land='Plai';
      $count_households=new SampleChart;
      //Load village data
      $villages = DB::table('counties')
                  ->join('villages','counties.id','=','villages.county_id')
                    ->select('villages.*')
                    ->where('counties.county_description','=',$land)
                    ->orderBy('villages.village_name')
                    ->get();

      $village_stats=Villagestat::all();
      foreach ($villages as $village) {
        $village_stat_data=$this->village_stat->find($village->id);
        $households[]=$village->households;
        $rom_households[]=$village_stat_data->rom_households_count;
        //$land[]=$village->land;
        /*foreach($village_stats as $vstat){
          if($village->id==$vstat->id){
            $rom_households[]=$vstat->rom_households_count;
          }
        }
        */
      }

      $count_households->dataset('Households(total)', 'bar', $households)->color('#00ff00');
      $count_households->dataset('Romani households', 'bar', $rom_households)->color('#ff0000');
      return $count_households->api();

    }
    //Plasa data
    public function plasa()
    {

      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $land='Plasă';
      $count_households=new SampleChart;
      $api=url('/plasa_data');
      $villages =  DB::table('counties')
                  ->join('villages','counties.id','=','villages.county_id')
                    ->select('villages.id','villages.households','villages.village_name')
                    ->where('counties.county_description','=',$land)
                    ->orderBy('villages.village_name')
                    ->get();
      $stats =  DB::table('counties')
                          ->join('villages','counties.id','=','villages.county_id')
                          ->select('villages.id','villages.village_name')
                          ->where('counties.county_description','=',$land)
                          ->orderBy('villages.village_name')
                          ->get();
      //return $stats;
      foreach ($stats as $stat) {
        $data['villages'][]=Villagestat::find($stat->id);

      }
      //return $data;
      //return $with;
      //Counting villages in Plai with and without Roms
      $all=0;
      $with=0;
      $village_stats=Villagestat::all();
      foreach ($villages as $village) {
        $label[]=$village->village_name;
        $village_stat_data=$this->village_stat->find($village->id);
        if($village->households>0){$all++;}
        if($village_stat_data->rom_households_count>0){$with++;}
      }
      $data['rom_villages']=$with;
      $data['without_rom']=$all-$with;

      $count_households->labels($label)->load($api);
      //General data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
      $data['romstotal']=DB::table('nations')->sum('total');
      $data['village_records']=Village::count();
      //
      return view('charts/plasa',['count_households'=>$count_households],$data);
    }
    public function response_plasa()
    {
      $land='Plasă';
      $count_households=new SampleChart;
      //Load village data
      $villages = DB::table('counties')
                  ->join('villages','counties.id','=','villages.county_id')
                    ->select('villages.*')
                    ->where('counties.county_description','=',$land)
                    ->orderBy('villages.village_name')
                    ->get();

      $village_stats=Villagestat::all();
      foreach ($villages as $village) {
        $village_stat_data=$this->village_stat->find($village->id);
        $households[]=$village->households;
        $rom_households[]=$village_stat_data->rom_households_count;
        //$land[]=$village->land;
        /*foreach($village_stats as $vstat){
          if($village->id==$vstat->id){
            $rom_households[]=$vstat->rom_households_count;
          }
        }
        */
      }
      $count_households->dataset('Households(total)', 'bar', $households)->color('#00ff00');
      $count_households->dataset('Romani households', 'bar', $rom_households)->color('#ff0000');
      return $count_households->api();

    }
    //
    public function test()
    {
      $land='Plasă';
      //Load village data
      $villages = DB::table('counties')
                  ->join('villages','counties.id','=','villages.county_id')
                    ->select('villages.*')
                    ->where('counties.county_description','=',$land)
                    ->orderBy('villages.village_name')
                    ->get();

      $village_stats=Villagestat::all();
      foreach ($villages as $village) {
        $village_stat_data=$this->village_stat->find($village->id);
        $households[]=$village_stat_data->rom_households_count;
        //$land[]=$village->land;
        /*foreach($village_stats as $vstat){
          if($village->id==$vstat->id){
            $rom_households[]=$vstat->rom_households_count;
          }
        }
        */
      }



      return $households;

    }

}
