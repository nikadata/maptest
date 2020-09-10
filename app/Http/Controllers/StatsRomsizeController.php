<?php

namespace App\Http\Controllers;
use App\Charts\SampleChart;
use App\Household;
use App\Village;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatsRomsizeController extends Controller
{
    //
    public function open_table_roms()
    {
      // Average household size per village
      $data=[];
      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');

  //Create graph chart
  $villages_charts=Village::all()->sortby('village_name');
  //Create Chart object
  $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
  $data=[];
  $village_roms=new SampleChart;
  $api=url('/stats_data_roms');
  //
  $villages_charts = DB::table('households')
              ->join('villages','households.village_id','=','villages.id')
              ->join('stats','households.id','=','stats.household_id')
                ->select('villages.village_name', 'stats.household_count')
                ->whereIn('households.nationality',$roms)
                ->orderby('villages.village_name')
                  ->get();

  foreach ($villages_charts as $vill) {
    $label[]=$vill->village_name;
  }
  $village_roms->labels($label)->load($api);
  //Max värde
    $data['maxs'] = DB::table('households')
                    ->join('villages','households.village_id','=','villages.id')
                    ->join('stats','households.id','=','stats.household_id')
                    ->select(DB::raw('avg(stats.household_count) as avg, villages.village_name'))
                    ->whereIn('households.nationality',$roms)
                    ->groupby('villages.village_name')
                    ->get();

    $data['maxs'] = collect(($data['maxs'])->sortBy('avg')->reverse()->toArray())->first();
    
    $data['min'] = DB::table('households')
                    ->join('villages','households.village_id','=','villages.id')
                    ->join('stats','households.id','=','stats.household_id')
                    ->select(DB::raw('avg(stats.household_count) as avg, villages.village_name'))
                    ->whereIn('households.nationality',$roms)
                    ->groupby('villages.village_name')
                    ->get();

    $data['min'] = collect(($data['min'])->sortBy('avg')->toArray())->first();

      /*
      $data['villages'] = DB::table('households')
                  ->join('villages','households.village_id','=','villages.id')
                  ->join('stats','households.id','=','stats.household_id')
                    ->select('villages.village_name', 'stats.household_count')
                    ->whereIn('households.nationality',$roms)
                    ->orderby('villages.village_name')
                      ->get();
      */
      $data['now']=Carbon::now();
      $data['villages'] = DB::table('households')
                    ->join('villages','households.village_id','=','villages.id')
                    ->join('stats','households.id','=','stats.household_id')
                    ->select(DB::raw('avg(stats.household_count) as avg, villages.village_name'))
                      ->whereIn('households.nationality',$roms)
                      ->groupby('villages.village_name')
                        ->get();
      //General data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
      $data['romstotal']=DB::table('nations')->sum('total');
      $data['village_records']=Village::count();
      //
      return view('table/open_roms',['village_roms'=>$village_roms],$data);
    }
    public function response_roms()
    {
      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $data=[];
      $village_roms=new SampleChart;
      $villages = DB::table('households')
                  ->join('villages','households.village_id','=','villages.id')
                  ->join('stats','households.id','=','stats.household_id')
                    ->select('villages.village_name', 'stats.household_count')
                    ->whereIn('households.nationality',$roms)
                    ->orderby('villages.village_name')
                      ->get();

      foreach ($villages as $village) {
        $name[]=$village->village_name;
        $sum[]=$village->household_count;

      }
      //$village_rom->dataset('Households(total)', 'bar', $households)->color('#00ff00');
      $village_roms->dataset('Roms householdsize per village', 'bar', $sum)->color('#00ff00');
      return $village_roms->api();

    }
    public function export_table_roms()
    {
      $data=[];
      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $data=[];
      $data['now']=Carbon::now();
      $data['villages'] = DB::table('households')
                  ->join('villages','households.village_id','=','villages.id')
                  ->join('stats','households.id','=','stats.household_id')
                  ->select(DB::raw('avg(stats.household_count) as avg, villages.village_name'))
                    ->whereIn('households.nationality',$roms)
                    ->groupby('villages.village_name')
                      ->get();
      $now=Carbon::now();
      $data['today']=$now;
      header('Content-Disposition: attachment;filename=export_'.$data['today'].'.xls');
      return view('table/roms_export',$data);
    }
    //

}
