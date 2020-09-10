<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Household as Household;
use App\Country as Country;
use App\District as District;
use App\DistrictStats as DistrictStats;
use App\County as County;
use App\Village as Village;
use App\Village_stat as Villagestat;
use App\SocialClass as Social;
use App\Skill\Skill as Skill;
use App\Source as Source;
use App\Child as Child;
use App\Coresident as Coresident;
use App\CoresidentSpouse as Coresident_spouse;
use App\CoresidentChild as Coresident_child;
use App\Wife as Wife;
use App\User as User;
use App\Role as Role;
use App\Stat as Stat;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Charts\SampleChart;
use App\Services\StatsCounter;
use App\StandardPyramid as StandardPyramid;
use App\AgePyramid as AgePyramid;
use App\Ilfovstat;
use App\DambovitaStats;
use App\Services\VillageCounter as VillageCounter;


class ReportController extends Controller
{
  public function __construct(Villagestat $village_stat)
  {
    $this->roms =   app(StatsCounter::class)->getRoms(); //Roms attribute from service container
    $this->village_stat = $village_stat->all();

  }

  private function prepareStats()
  {
    //Update Villagestats with average households size
    $villageStats = new Villagestat;
    $villageStats->avgUpdate();

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

  public function index(Request $request)
  {

      return view('report/index');
  }

  public function report(Request $request, StatsCounter $statscounter)
  {
    //Db data
    $roms = $this->roms;
    $data['household_records']=Household::count();
    $data['roms'] = DB::table('households')
                    ->whereIn('households.nationality',$roms)
                    ->count();
    //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
    $data['romstotal']=DB::table('nations')->sum('total');
    $data['country_records']=Country::count();
    $data['district_records']=District::count();
    $data['county_records']=County::count();
    $data['village_records']=Village::count();
    $data['social_records']=Social::count();
    $data['skill_records']=Skill::count();
    $data['source_records']=Source::count();
    $data['total']=Household::count()+Child::count()+Coresident::count()+Coresident_spouse::count()+Coresident_child::count()+Wife::count();

    //Village data
    $villageStats = new Villagestat;
    $data['village_roms'] = $villageStats->getVillagesRoms();
    $data['village_nroms'] = $villageStats->getVillagesWithoutRoms();

    $single_rom=DistrictStats::sum('single_roms_household');
    $extended_rom=DistrictStats::sum('extended_roms_household');
    $data['ext_stats']=round(($extended_rom/$data['roms'])*100,2);
    $data['single_stats']=round(($single_rom/$data['roms'])*100,2);

    $stats = new Stat;
    //Average householdssize
    $data['avg'] = $stats->avgHouseholdSize();
    //Range of householdssize - Maxsize
    $data['avg_max'] = $stats->avgMaxHouseholdsSize();
    //Range of householdssize - Minsize
    $data['avg_min'] = $stats->avgMinHouseholdsSize();

    $data['youngest'] = $statscounter->getYoungest();

    $data['oldest'] = $statscounter->getOldest();

    return view('report/report', $data);
  }

  public function home(Request $request, StatsCounter $statscounter)
  {

      $data=[];

      $now=Carbon::now();

      //Get today date and time
      $data['today']=$now;

      $roms = $this->roms;

      //Update Romspervillage stats
      $this->prepareStats();

      $data['youngest'] = $statscounter->getYoungest();

      $data['oldest'] = $statscounter->getOldest();
      //Calculate and update skill counting
      //All villages
      $skill = new Skill;
      $villages = new VillageCounter;
      //Get all villages id
      $all = $villages->getVillages();
      //Reset skillstats table
      $skill->reset();
      //Update skill with latest stats
      $skill->updateSkill($all);

      //Ilfov
      $skill = new Skill;
      $villages = new VillageCounter;
      //Get Ilfov villages id
      $all = $villages->getVillages('Ilfov');
      //Update skill with latest stats
      $skill->updateSkill($all, 'Ilfov');

      //Dambovita
      $skill = new Skill;
      $villages = new VillageCounter;
      //Get Dambovita villages id
      $all = $villages->getVillages('Dambovita');
      //Update skill with latest stats
      $skill->updateSkill($all, 'Dambovita');
      //end updating

      //Count db data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
      $data['romstotal']=DB::table('nations')->sum('total');
      $data['country_records']=Country::count();
      $data['district_records']=District::count();
      $data['county_records']=County::count();
      $data['village_records']=Village::count();
      $data['social_records']=Social::count();
      $data['skill_records']=Skill::count();
      $data['source_records']=Source::count();
      $data['total']=Household::count()+Child::count()+Coresident::count()+Coresident_spouse::count()+Coresident_child::count()+Wife::count();
      //Village data
      $villageStats = new Villagestat;
      $data['village_roms'] = $villageStats->getVillagesRoms();
      $data['village_nroms'] = $villageStats->getVillagesWithoutRoms();

      $single_rom=DistrictStats::sum('single_roms_household');
      $extended_rom=DistrictStats::sum('extended_roms_household');
      $data['ext_stats']=round(($extended_rom/$data['roms'])*100,2);
      $data['single_stats']=round(($single_rom/$data['roms'])*100,2);

      $stats = new Stat;
      //Average householdssize
      $data['avg'] = $stats->avgHouseholdSize();
      //Range of householdssize - Maxsize
      $data['avg_max'] = $stats->avgMaxHouseholdsSize();
      //Range of householdssize - Minsize
      $data['avg_min'] = $stats->avgMinHouseholdsSize();

      //Update Village Statistics
      $villageStats = new Villagestat;
      $villageStats->VillageStatReset();
      $villageStats->updateRomHouseholds();
      //Villages with Rom population
      $data['village_roms'] = $villageStats->getVillagesRoms();
      //Villages without Rom population
      $data['village_nroms'] = $villageStats->getVillagesWithoutRoms();

      return view('report/home', $data);

  }

}
