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

class AgePyramidController extends Controller
{
    public function __construct()
    {
      $this->roms =   app(StatsCounter::class)->getRoms(); //Roms attribute from service container

    }

    public function index()
    {
      //Update stats
      $agePyramid = new AgePyramid;
      $villages = new VillageCounter;
      //Get all villageid
      $all = $villages->getVillages();
      //Reset table Agepyramid
      $agePyramid->resetAgePyramid();
      //Get youngest and oldest person
      $youngest = $agePyramid->getYoungest($all);
      $oldest = $agePyramid->getOldest($all);
      //Populate AgePyramid table with ages from oldest to youngest
      $agePyramid->initage($youngest,$oldest);
      //Update AgePyramid table with data
      $agePyramid->statsUpdate($youngest, $oldest, $all);
      //end
      //Prepare chart
      for($i=$oldest;$i>=$youngest;$i--){
        $label[] = $i;
      }
      $menbar = new SampleChart;
      $api = url('/agepyramid_data');
      $menbar->height(1200);
      $menbar->labels($label)->load($api);
      //General data
      $data['household_records'] = Household::count();
      $data['roms'] = DB::table('households')
                      ->whereIn('households.nationality',$this->roms)
                      ->count();
      //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
      $data['romstotal'] = DB::table('nations')->sum('total');
      $data['village_records'] = Village::count();
      //
      return view('charts/age',['menbar'=>$menbar],$data);
    }

    public function age_response()
    {

      //Render graph
      $graphdatas = AgePyramid::all();
      $menbar = new SampleChart;

      foreach ($graphdatas as $graphdata)
      {
        $sum[] = $graphdata->male *-1;
        $fsum[] = $graphdata->female;
      }
      $menbar->dataset('Male', 'horizontalBar', $sum)->color('#00ff00');
      $menbar->dataset('Female', 'horizontalBar', $fsum)->color('#ff0000');
      return $menbar->api();
    }

}
