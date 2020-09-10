<?php

namespace App\Http\Controllers\Statistics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AgePyramid as AgePyramid;
use App\Services\VillageCounter as VillageCounter;
use App\Charts\SampleChart;
use App\Village;
use App\Household;
use Illuminate\Support\Facades\DB;
use App\Services\StatsCounter;

class AgePyramidDambovitaController extends Controller
{
  public function __construct()
  {
    $this->roms =   app(StatsCounter::class)->getRoms(); //Roms attribute from service container

  }

  //Dambovita
  public function index()
  {
    $roms = $this->roms;

    //Reset table agepyramid
    $agePyramid = new AgePyramid;
    $agePyramid->resetAgePyramid();
    $villages = new VillageCounter;
    $all = $villages->getVillages();
    $youngest = $agePyramid->getYoungest($all);
    $oldest = $agePyramid->getOldest($all);
    $agePyramid->initage($youngest,$oldest);
    //Update stats
    $agepyramid = new AgePyramid;
    $ilfov = new VillageCounter;
    $ilfov_villages = $ilfov->getVillages('Dambovita');
    $agePyramid->statsUpdate($youngest, $oldest, $ilfov_villages, 'Dambovita');
    //Dambovita youngest and oldest
    $youngest = $agepyramid->getYoungest($ilfov_villages);
    $oldest = $agepyramid->getOldest($ilfov_villages);
    //end update

    //Prepare chart
    for($i=$oldest;$i>=$youngest;$i--){
      $label[]=$i;
    }
    $menbar=new SampleChart;
    $api=url('/dambovita_agepyramid_data');
    $menbar->height(1200);
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

    return view('charts/dambovita/age',['menbar'=>$menbar],$data);
  }
  public function age_response()
  {
    //Render graph
    $agepyramid = new AgePyramid;
    $villages = new VillageCounter;

    $village = $villages->getVillages('Dambovita');

    $youngest = $agepyramid->getYoungest($village);

    $oldest = $agepyramid->getOldest($village);

    $graphdatas = AgePyramid::all();
    $menbar = new SampleChart;

    foreach ($graphdatas as $graphdata)
    {
      if ($graphdata->age <= $oldest){
          $sum[] = $graphdata->dambovita_male*-1;
          $fsum[] = $graphdata->dambovita_female;
          }
    }
    $menbar->dataset('Male', 'horizontalBar', $sum)->color('#00ff00');
    $menbar->dataset('Female', 'horizontalBar', $fsum)->color('#ff0000');
    return $menbar->api();
}
}
