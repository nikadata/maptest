<?php

namespace App\Http\Controllers\Statistics;

use Illuminate\Http\Request;
use App\Ilfovstat;
use App\DambovitaStats;
use App\Services\StatsCounter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Village_stat as Villagestat;
use App\Charts\SampleChart;
use Carbon\Carbon;
use App\Household;
use App\Village;


class RomsperVillageController extends Controller
{

    public function __construct(Villagestat $village_stat)
    {
      $this->roms =   app(StatsCounter::class)->getRoms(); //Roms attribute from service container
      $this->village_stat = $village_stat->all();
    }


    private function prepareStats()
    {
      //Update Villagestats with average households size
      $this->avgUpdate();

      //New Ilfov stat object
      $ilfov = new Ilfovstat;
      $dambovita = new DambovitaStats;
      //Reset table
      $ilfov->resetStats();
      $dambovita->resetStats();
      //Filter and get alla villages related to Ilfov
      $ilfov_villages = $ilfov->getStats();
      $dambovita_villages = $dambovita->getStats();
      //Get stats from Villagestats and save to Ilfov table
      $ilfov->saveStats($ilfov_villages, $this->village_stat);
      $dambovita->saveStats($dambovita_villages, $this->village_stat);

    }

    public function index()
    {
      $roms = $this->roms;
      $this->prepareStats();
      //Create Chart object
      $village_rom=new SampleChart;
      //Load api reference
      $api=url('/ilfov_data_rom');
      //Prepare chars rendering
      $district_ilfov = Ilfovstat::all();
      $data['villages'] = $district_ilfov;
      foreach($district_ilfov as $ilfov)
      {
      $label[]=$ilfov->village_name; //Label for chart
      }

      $village_rom->labels($label)->load($api);

      $data['now']=Carbon::now();
      $data['total']=DB::table('ilfovstats')->sum('roms'); //Tempory data sourse for calculationg
      $data['maxs'] = DB::table('ilfovstats')->orderBy('roms','desc')->first();
      $data['min'] = DB::table('ilfovstats')->orderBy('roms','asc')->first();
      //General data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      $data['romstotal']=DB::table('nations')->sum('total');
      $data['village_records']=Village::count();
      // Summary data
      $data['ilfov_households'] = DB::table('ilfovstats')->sum('households');
      $data['ilfov_roms'] = DB::table('ilfovstats')->sum('romhouseholds');
      $data['ilfov_romstotal'] = $data['total'];
      $data['ilfov_households_percent'] = $data['ilfov_roms'] / $data['ilfov_households'];
      $data['ilfov_village_records'] = DB::table('ilfovstats')->count();
      $data['ilfov_households_avg_total'] = DB::table('ilfovstats')->avg('households_avg');

      //
      return view('charts/ilfov/rom',['village_rom'=>$village_rom], $data);
    }

    public function response_rom()
    {

      //$roms = $this->roms;
      $data=[];
      $village_rom=new SampleChart;

      $villages=DB::table('ilfovstats')
                    ->whereNotNull('households')
                    ->orderBy('village_name')
                    ->get();

      foreach ($villages as $village) {
        //$name[]=$village->village_name;
        $sum[]=$village->roms;
      }

      //$village_rom->dataset('Households(total)', 'bar', $households)->color('#00ff00');
      $village_rom->dataset('Roms per village', 'bar', $sum)->color('#00ff00');
      //$village_rom->dataset('Roms total', 'bar', $rom_total)->color('#ff0000');
      return $village_rom->api();

    }

    private function avgUpdate()
    {
      //Saves average households size to Village stats
      $avgUpdate = new Villagestat;

      $avgVillage = $avgUpdate->getAvgHousehold();
      $villagestat = $this->village_stat;

      foreach ($avgVillage as $avg)
      {

        $stat = $villagestat->find($avg->id);
        $stat->households_avgsize = $avg->avg;
        $stat->save();
      }

    }

    //Dambovita
    public function indexDambovita()
    {
      $roms = $this->roms;
      //$this->prepareStats();
      //Create Chart object
      $village_rom=new SampleChart;
      //Load api reference
      $api=url('/dambovita_data_rom');
      //Prepare chars rendering
      $district_dambovita = DambovitaStats::all();
      $data['villages'] = $district_dambovita;
      foreach($district_dambovita as $dambovita)
      {
      $label[]=$dambovita->village_name; //Label for chart
      }

      $village_rom->labels($label)->load($api);

      $data['now']=Carbon::now();
      $data['total']=DB::table('dambovita_stats')->sum('roms'); //Tempory data sourse for calculationg
      $data['maxs'] = DB::table('dambovita_stats')->orderBy('roms','desc')->first();
      $data['min'] = DB::table('dambovita_stats')->orderBy('roms','asc')->first();
      //General data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      $data['romstotal']=DB::table('nations')->sum('total');
      $data['village_records']=Village::count();
      // Summary data
      $data['dambovita_households'] = DB::table('dambovita_stats')->sum('households');
      $data['dambovita_roms'] = DB::table('dambovita_stats')->sum('romhouseholds');
      $data['dambovita_romstotal'] = $data['total'];
      $data['dambovita_households_percent'] = $data['dambovita_roms'] / $data['dambovita_households'];
      $data['dambovita_village_records'] = DB::table('dambovita_stats')->count();
      $data['dambovita_households_avg_total'] = DB::table('dambovita_stats')->avg('households_avg');

      //
      return view('charts.dambovita.rom',['village_rom'=>$village_rom], $data);
    }

    public function response_dambovita()
    {

      //$roms = $this->roms;
      $data=[];
      $village_rom=new SampleChart;

      $villages=DB::table('dambovita_stats')
                    ->whereNotNull('households')
                    ->orderBy('village_name')
                    ->get();

      foreach ($villages as $village) {
        //$name[]=$village->village_name;
        $sum[]=$village->roms;
      }

      //$village_rom->dataset('Households(total)', 'bar', $households)->color('#00ff00');
      $village_rom->dataset('Roms per village', 'bar', $sum)->color('#00ff00');
      //$village_rom->dataset('Roms total', 'bar', $rom_total)->color('#ff0000');
      return $village_rom->api();

    }
}
