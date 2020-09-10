<?php

namespace App\Http\Controllers\Statistics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\StatsCounter;
use App\Services\VillageCounter as VillageCounter;
use Illuminate\Support\Facades\DB;
use App\Charts\SampleChart;
use App\Household as Household;
use App\Village_stat as Villagestat;
use App\Village as Village;
use App\StandardPyramid as StandardPyramid;

class StandardPyramidController extends Controller
{
  public function __construct(Villagestat $village_stat)
  {
    $this->roms =   app(StatsCounter::class)->getRoms(); //Roms attribute from service container


  }

  public function standard()
  {
    //Update stats
    $standardPyramid = new StandardPyramid;
    $getvillages = new VillageCounter;
    $standardPyramid->resetPyramid();
    //Get all villages
    $villages = $getvillages->getVillages();
    //Calculate data all Villages
    $standardPyramid->calculatePyramid($villages);


    //end update stats
    //Prepare graphs
    $roms = $this->roms;

    $ageFrom=0;
    $ageTo=200;
    $youngest=DB::table('households')
                ->whereIn('households.nationality',$roms)
                ->min('age');
    $oldest=DB::table('households')
                ->whereIn('households.nationality',$roms)
                ->max('age');

    $label=array('100-104','95-99','90-94','85-89','80-84','75-79','70-74','65-69','60-64','55-59','50-54','45-49','40-44','35-39','30-34','25-29','20-24','15-19','10-14','5-9','0-4');

    $menbar=new SampleChart;
    $api=url('/standard_data');

    $menbar->labels($label)->load($api);
    //General data
    $data['household_records']=Household::count();
    $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
    //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
    $data['romstotal']=DB::table('nations')->sum('total');
    $data['village_records']=Village::count();
    //
    return view('charts/standard',['menbar'=>$menbar],$data);
    }

  public function standard_response()
  {
    //Prepare rendering of chart
    $menbar=new SampleChart;
    $graphdatas=StandardPyramid::all();
    foreach ($graphdatas as $graphdata){
        $sum[]=$graphdata->male*-1;
        $fsum[]=$graphdata->female;
        }

    $menbar->dataset('Male', 'horizontalBar', $sum)->color('#00ff00');
    $menbar->dataset('Female', 'horizontalBar', $fsum)->color('#ff0000');
    return $menbar->api();
  }
}
