<?php

namespace App\Http\Controllers\Statistics;
use App\Http\Controllers\Controller;
use App\Charts\SampleChart;
use App\Village;
use App\Household;
use App\Village_stat as Villagestat;
use App\Skill\Skill as Skill;
use App\District as District;
use App\DistrictStats as DistrictStats;
use App\NationStats as NationStats;
use App\Nation as Nation;
use App\Nationality as Nationality;
use App\StandardPyramid as StandardPyramid;
use App\AgePyramid as AgePyramid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\StatsCounter;
use App\Services\VillageCounter as VillageCounter;

class ChartsController extends Controller
{
    //
    public function __construct(Nationality $nationality, Villagestat $village_stat, DistrictStats $district_stat, NationStats $nation_stats, Skill $skill, Nation $nation, StandardPyramid $pyramid, AgePyramid $agepyramid)
    {
      $this->nationality=$nationality->all();
      $this->village_stat = $village_stat->all();
      $this->district_stat = $district_stat->all();
      $this->nations_stats=$nation_stats;
      $this->nation=$nation;
      $this->pyramid=$pyramid;
      $this->agepyramid=$agepyramid;
      $this->skill=$skill;
      $this->roms =   app(StatsCounter::class)->getRoms(); //New Roms attribute from service container
    }


    public function table_age()
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
      $roms = $this->roms;
      $data['youngest']=DB::table('households')
                    ->whereIn('households.nationality',$roms)
                    ->min('age');
      $data['oldest']=DB::table('households')
                    ->whereIn('households.nationality',$roms)
                    ->max('age');
      $data['graphs']=AgePyramid::all();
      $now=Carbon::now();
      $data['now']=$now;
      $data['today']=$now;
      return view('table/age',$data);
    }
    public function export_age()
    {
      $data['graphs']=AgePyramid::all();
      $now=Carbon::now();
      $data['now']=$now;
      $data['today']=$now;
      header('Content-Disposition: attachment;filename=export_'.$data['today'].'.xls');
      return view('table/export_age',$data);
    }

    //Tables
    public function table_standard()
    {

  $roms = $this->roms;
  $data['youngest']=DB::table('households')
                ->whereIn('households.nationality',$roms)
                ->min('age');
  $data['oldest']=DB::table('households')
                ->whereIn('households.nationality',$roms)
                ->max('age');
  $data['graphs']=StandardPyramid::all();
  $now=Carbon::now();
  $data['now']=$now;
  $data['today']=$now;
  return view('table/standard',$data);
}
public function export_standard()
{
  $data['graphs']=StandardPyramid::all();
  $now=Carbon::now();
  $data['now']=$now;
  $data['today']=$now;
  header('Content-Disposition: attachment;filename=export_'.$data['today'].'.xls');
  return view('table/export_standard',$data);
}
// end table_standard
    public function count_households()
    {

      $count_households=new SampleChart;
      $api=url('/test_data');
      $villages = Village::all()->sortBy("village_name");
      foreach ($villages as $village) {
        $label[]=$village->village_name;
      }
      $count_households->labels($label)->load($api);
      /*
      $chart->labels(['test1','test2','test3'])
      ->load($api);
      */
      return view('charts/first',['count_households'=>$count_households]);
    }
    public function village_land()
    {

      $village_land=new SampleChart;
      $api=url('/v_land');
      $villages = Village::all()->sortBy("village_name");
      foreach ($villages as $village) {
        $label[]=$village->village_name;
      }
      $village_land->labels($label)->load($api);
      /*
      $chart->labels(['test1','test2','test3'])
      ->load($api);
      */
      //General data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
      $data['romstotal']=DB::table('nations')->sum('total');
      $data['village_records']=Village::count();
      //
      return view('charts/second',['village_land'=>$village_land],$data);
    }
    public function village_rom()
    {

      $roms = $this->roms;
      $data=[];
      $village_rom=new SampleChart;
      $api=url('/v_rom');
      //$villages = Village::all()->sortBy("village_name");
      $villages = DB::table('households')
                  ->join('villages','households.village_id','=','villages.id')
                  ->join('stats','households.id','=','stats.household_id')
                    ->select(DB::raw('sum(stats.household_count) as sum, villages.village_name'))
                    ->whereIn('households.nationality',$roms)
                    ->groupBy('villages.village_name')
                    ->get();
      //return $villages;
      foreach ($villages as $village) {
        $label[]=$village->village_name;
      }
      $village_rom->labels($label)->load($api);
      /*
      $chart->labels(['test1','test2','test3'])
      ->load($api);
      */

      return view('charts/third',['village_rom'=>$village_rom]);
    }
    public function village_roms()
    {

      $roms = $this->roms;
      $data=[];
      $village_roms=new SampleChart;
      $api=url('/v_roms');
      //
      $villages = DB::table('households')
                  ->join('villages','households.village_id','=','villages.id')
                  ->join('stats','households.id','=','stats.household_id')
                    ->select('villages.village_name', 'stats.household_count')
                    ->whereIn('households.nationality',$roms)
                      ->get();
      //return $villages;
      foreach ($villages as $village) {
        $label[]=$village->village_name;
      }
      $village_roms->labels($label)->load($api);

      return view('charts/fourth',['village_roms'=>$village_roms]);
    }
    public function stats()
    {
      //Update VillageStats households per villages
      $villages=Village::all();
      foreach ($villages as $village)
      {
        $village_stat_data=$this->village_stat->find($village->id);
        $village_stat_data->village_name=$village->village_name;
        $village_stat_data->households_count=$village->households;
        $village_stat_data->save();
      }

      $roms = $this->roms;
      $count_households=new SampleChart;
      $api=url('/stats_data');
      $villages = Village::all()->sortBy("village_name");
      $data['villages']=Villagestat::all()->sortBy("village_name");
      foreach ($villages as $village) {
        $label[]=$village->village_name;
      }
      $count_households->labels($label)->load($api);
//MaxMin
$data['maxs'] = DB::table('village_stats')->orderBy('rom_households_count','desc')->first();
$data['min'] = DB::table('village_stats')->orderBy('rom_households_count','asc')->first();
//
      //General data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
      $data['romstotal']=DB::table('nations')->sum('total');
      $data['village_records']=Village::count();
      //
      return view('charts/villages',['count_households'=>$count_households], $data);
    }
    public function stats_land()
    {
      //$roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $roms = $this->roms;
      $village_land=new SampleChart;
      $api=url('/stats_land');
      $villages = Village::all()->sortBy("village_name");
      foreach ($villages as $village) {
        $label[]=$village->village_name;
      }
      $village_land->labels($label)->load($api);

      //General data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
      $data['romstotal']=DB::table('nations')->sum('total');
      $data['village_records']=Village::count();
      //
      return view('charts/second_open',['village_land'=>$village_land],$data);
    }
    public function stats_rom()
    {
      // This function is not correct adjusted - to be removed!

      //$roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $roms = $this->roms;
      $data=[];
      //Update stats
      $villages = DB::table('households')
                  ->join('villages','households.village_id','=','villages.id')
                  ->join('stats','households.id','=','stats.household_id')
                    ->select(DB::raw('sum(stats.household_count) as sum, villages.id'))
                    ->whereIn('households.nationality',$roms)
                    ->groupBy('villages.id')
                    ->get();

      $village_rom=new SampleChart;
      $api=url('/stats_data_rom');
      //$villages = Village::all()->sortBy("village_name");
      $villages = DB::table('households')
                  ->join('villages','households.village_id','=','villages.id')
                  ->join('stats','households.id','=','stats.household_id')
                    ->select(DB::raw('sum(stats.household_count) as sum, villages.village_name'))
                    ->whereIn('households.nationality',$roms)
                    ->groupBy('villages.village_name')
                    ->get();

      //return $villages;
      foreach ($villages as $village) {
        $label[]=$village->village_name;
      }
      $village_rom->labels($label)->load($api);

      //General data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
      $data['romstotal']=DB::table('nations')->sum('total');
      $data['village_records']=Village::count();
      //
      return view('charts/third_open',['village_rom'=>$village_rom], $data);

    }
    public function stats_roms()
    {
      //$roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $roms = $this->roms;
      $data=[];
      $village_roms=new SampleChart;
      $api=url('/stats_data_roms');
      //
      $villages = DB::table('households')
                  ->join('villages','households.village_id','=','villages.id')
                  ->join('stats','households.id','=','stats.household_id')
                    ->select('villages.village_name', 'stats.household_count')
                    ->whereIn('households.nationality',$roms)
                    ->orderby('villages.village_name')
                      ->get();

      foreach ($villages as $village) {
        $label[]=$village->village_name;
      }
      $village_roms->labels($label)->load($api);
      //General data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
      $data['romstotal']=DB::table('nations')->sum('total');
      $data['village_records']=Village::count();
      //
      return view('charts/fourth_open',['village_roms'=>$village_roms],$data);
    }
    public function response()
    {
      //Returns to Function stats
      $count_households=new SampleChart;
      //Load village data
      $villages = Village::all()->sortBy("village_name");
      $village_stats=Villagestat::all();
      foreach ($villages as $village) {
        $households[]=$village->households;
        $land[]=$village->land;
        foreach($village_stats as $vstat){
          if($village->id==$vstat->id){
            $rom_households[]=$vstat->rom_households_count;
          }
        }
      }
      $count_households->dataset('Households(total)', 'bar', $households)->color('#00ff00');
      $count_households->dataset('Romani households', 'bar', $rom_households)->color('#ff0000');
      return $count_households->api();

    }
    public function response_land()
    {
      $village_land=new SampleChart;
      $villages = Village::all()->sortBy("village_name");
      foreach ($villages as $village) {
        $households[]=$village->households;
        $land[]=$village->land;

      }
      //$village_land->dataset('Households(total)', 'bar', $households)->color('#00ff00');
      $village_land->dataset('Land(m2)', 'bar', $land)->color('#00ff00');
      return $village_land->api();

    }
    public function response_rom()
    {
      //This function should be removed
      $roms = $this->roms;
      $data=[];
      $village_rom=new SampleChart;
      /*
      $villages = DB::table('households')
                  ->join('villages','households.village_id','=','villages.id')
                  ->join('stats','households.id','=','stats.household_id')
                    ->select(DB::raw('sum(stats.household_count) as sum, villages.village_name'))
                    ->whereIn('households.nationality',$roms)
                    ->groupBy('villages.village_name')
                    ->get();
      */
      $villages = DB::table('village_stats')
                ->select('village_stats.*')
                ->orderBy('village_stats.village_name')
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
    public function response_roms()
    {
      
      $roms = $this->roms;
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
      $village_roms->dataset('Roms size per village', 'bar', $sum)->color('#00ff00');
      return $village_roms->api();

    }
/* Table deactivated
    public function table_rom()
    {
      $data=[];
      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $data=[];
      //update
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
      //
      $data['now']=Carbon::now();
      $data['villages']=DB::table('village_stats')
                      ->join ('villages','village_stats.village_id','=','villages.id')
                      ->select('villages.village_name', 'village_stats.roms_count')
                      ->orderby('villages.village_name')
                      ->get();
      $data['total']=DB::table('village_stats')->sum('village_stats.roms_count');

      return view('table/rom',$data);
    }
    */
    public function open_table_rom()
    {
      //Reset modeltable village_stats
      $pyrs=Villagestat::all();
      foreach($pyrs as $pyr){
              $village_stat_data=$this->village_stat->find($pyr->id);
              $village_stat_data->rom_households_count=0;
              $village_stat_data->roms_count=0;
              $village_stat_data->save();
              }

      //$roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $roms = $this->roms;
      $data=[];

      //Households with Rom nationality
      $villages=DB::table('households')
                    ->join('villages','households.village_id','=','villages.id')
                    ->select(DB::raw('villages.id, count(*) as sum'))
                    ->whereIn('households.nationality',$roms)
                    ->groupby('villages.id')
                      ->get();

      foreach ($villages as $village)
      {
        $village_stat_data=$this->village_stat->find($village->id);
        $village_stat_data->rom_households_count=$village->sum;
        $village_stat_data->roms_count=$village->sum;
        $village_stat_data->save();
      }
      //return 'Done';
      //Update VillageStats percent % households per villages
      $villages=Villagestat::all();
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

      //Wives
      $villages=DB::table('households')
                    ->join('villages','households.village_id','=','villages.id')
                    ->join('wives','households.id','=','wives.household_id')
                    ->select(DB::raw('villages.id, count(*) as sum'))
                    ->whereIn('wives.wife_nation',$roms)
                    ->groupby('villages.id')
                      ->get();

      foreach ($villages as $village)
      {
        $village_stat_data=$this->village_stat->find($village->id);
        $village_stat_data->roms_count=$village_stat_data->roms_count+$village->sum;
        $village_stat_data->save();
      }
      //Children
      $villages=DB::table('households')
                    ->join('villages','households.village_id','=','villages.id')
                    ->join('children','households.id','=','children.household_id')
                    ->select(DB::raw('villages.id, count(*) as sum'))
                    ->whereIn('households.nationality',$roms)
                    ->groupby('villages.id')
                      ->get();

      foreach ($villages as $village)
      {
        $village_stat_data=$this->village_stat->find($village->id);
        $village_stat_data->roms_count=$village_stat_data->roms_count+$village->sum;
        $village_stat_data->save();
      }
      //Coresidents
      $villages=DB::table('households')
                    ->join('villages','households.village_id','=','villages.id')
                    ->join('coresidents','households.id','=','coresidents.household_id')
                    ->select(DB::raw('villages.id, count(*) as sum'))
                    ->whereIn('coresidents.resident_nation',$roms)
                    ->groupby('villages.id')
                      ->get();

      foreach ($villages as $village)
      {
        $village_stat_data=$this->village_stat->find($village->id);
        $village_stat_data->roms_count=$village_stat_data->roms_count+$village->sum;
        $village_stat_data->save();
      }
      //Coresidents spouse
      $villages=DB::table('households')
                    ->join('villages','households.village_id','=','villages.id')
                    ->join('coresident_spouses','households.id','=','coresident_spouses.household_id')
                    ->select(DB::raw('villages.id, count(*) as sum'))
                    ->whereIn('coresident_spouses.spouse_nation',$roms)
                    ->groupby('villages.id')
                      ->get();

      foreach ($villages as $village)
      {
        $village_stat_data=$this->village_stat->find($village->id);
        $village_stat_data->roms_count=$village_stat_data->roms_count+$village->sum;
        $village_stat_data->save();
      }
      //Coresidents children
      $villages=DB::table('households')
                    ->join('villages','households.village_id','=','villages.id')
                    ->join('coresident_children','households.id','=','coresident_children.household_id')
                    ->select(DB::raw('villages.id, count(*) as sum'))
                    ->whereIn('coresident_children.child_nation',$roms)
                    ->groupby('villages.id')
                      ->get();

      foreach ($villages as $village)
      {
        $village_stat_data=$this->village_stat->find($village->id);
        $village_stat_data->roms_count=$village_stat_data->roms_count+$village->sum;
        $village_stat_data->save();
      }

      //Update stats
/*
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
      $villages=Villagestat::all();
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
*/
      //
      $data['now']=Carbon::now();
      /*
      $data['villages']=DB::table('village_stats')
                      ->join ('villages','village_stats.village_id','=','villages.id')
                      ->select('villages.village_name', 'village_stats.roms_count')
                      ->orderby('villages.village_name')
                      ->get();
      */
      $data['villages']=Villagestat::all()->sortBy('village_name');
      $data['total']=DB::table('village_stats')->sum('village_stats.roms_count');

      /*
      $data['villages'] = DB::table('households')
                  ->join('villages','households.village_id','=','villages.id')
                  ->join('stats','households.id','=','stats.household_id')
                    ->select(DB::raw('sum(stats.household_count) as sum, villages.village_name'))
                    ->whereIn('households.nationality',$roms)
                    ->groupBy('villages.village_name')
                    ->get();
      */
      //General data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
      $data['romstotal']=DB::table('nations')->sum('total');
      $data['village_records']=Village::count();
      //
      return view('table/open_rom',$data);
    }
    public function export_table_rom()
    {
      $data['now']=Carbon::now();
      $data['villages']=DB::table('village_stats')
                      ->join ('villages','village_stats.village_id','=','villages.id')
                      ->select('villages.village_name', 'village_stats.roms_count')
                      ->orderby('villages.village_name')
                      ->get();
      $data['total']=DB::table('village_stats')->sum('village_stats.roms_count');

      $now=Carbon::now();
      $data['today']=$now;
      header('Content-Disposition: attachment;filename=export_'.$data['today'].'.xls');
      return view('table/rom_export',$data);
    }
    /* Table deactivated
    public function table_roms()
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
      return view('table/roms',$data);
    }
    */
    public function open_table_roms()
    {
      // Average household size per village
      $data=[];
      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $roms = $this->roms;
      $data['now']=Carbon::now();
      $data['villages'] = DB::table('households')
                  ->join('villages','households.village_id','=','villages.id')
                  ->join('stats','households.id','=','stats.household_id')
                  ->select(DB::raw('avg(stats.household_count) as avg, villages.village_name'))
                    ->whereIn('households.nationality',$roms)
                    ->groupby('villages.village_name')
                      ->get();

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
      //General data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
      $data['romstotal']=DB::table('nations')->sum('total');
      $data['village_records']=Village::count();
      //
      return view('table/open_roms',$data);
    }
    public function export_table_roms()
    {
      $data=[];
      //$roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $roms = $this->roms;
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

    public function init_district_stats()
    {

    $agepyramid=new AgePyramid();
    $agepyramid->initage();

    }

    public function open_table_district()
    {
      //$roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $roms = $this->roms;
      $data=[];
      $data['now']=Carbon::now();
      $data['districts']=District::All();
      $singles = DB::table('households')
                ->join('villages','households.village_id','=','villages.id')
                ->join('counties','villages.county_id','=','counties.id')
                ->join('districts','counties.district_id','=','districts.id')
                  ->select(DB::raw('districts.id, count(*) as count'))
                  ->whereIn('households.nationality',$roms)
                  ->where('households.extended_id','=',1)
                  ->groupby('districts.id')
                    ->get();
      //return $villages;
      foreach ($singles as $single)
      {
        $district_stat_data=$this->district_stat->find($single->id);
        $district_stat_data->single_roms_household=$single->count;
        $district_stat_data->save();
      }
      //
      //$roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $roms = $this->roms;
      $data=[];
      $data['now']=Carbon::now();
      $data['districts']=District::All();
      $extendeds = DB::table('households')
                  ->join('villages','households.village_id','=','villages.id')
                  ->join('counties','villages.county_id','=','counties.id')
                  ->join('districts','counties.district_id','=','districts.id')
                    ->select(DB::raw('districts.id, count(*) as count'))
                    ->whereIn('households.nationality',$roms)
                    ->where('households.extended_id','>',1)
                    ->groupby('districts.id')
                      ->get();
        //return $villages;
        foreach ($extendeds as $extended)
        {
          $district_stat_data=$this->district_stat->find($extended->id);
          $district_stat_data->extended_roms_household=$extended->count;
          $district_stat_data->save();
        }

        $data=[];
        $data['now']=Carbon::now();
        $data['districts']=DB::table('district_stats')
                            ->join('districts','district_stats.district_id','=','districts.id')
                            ->select('district_stats.*','districts.district_name')
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
      return view('table/open_district',$data);

    }
    public function export_table_district()
    {
      $data=[];
      $data['now']=Carbon::now();
      $data['districts']=DB::table('district_stats')
                          ->join('districts','district_stats.district_id','=','districts.id')
                          ->select('district_stats.*','districts.district_name')
                          ->get();
      $now=Carbon::now();
      $data['today']=$now;
      header('Content-Disposition: attachment;filename=export_'.$data['today'].'.xls');
    return view('table/export_district',$data);
    }
    //
    public function open_table_skill(Skill $skill)
    {
      //Reset skill count data
      $resets=Skill::all();
      foreach ($resets as $reset){
        $reset->roms_count=0;
        $reset->save();
      }
      //

      //$roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $roms = $this->roms;
      $data=[];
      $data=[];

      $data['now']=Carbon::now();

      $skills=DB::table('households')
                  ->join('skills','households.skill_id','=','skills.id')
                    ->select(DB::raw('skills.id, count(*) as count'))
                    ->whereIn('households.nationality',$roms)
                    ->groupby('skills.id')
                      ->get();
  foreach ($skills as $skill)
  {
    $skill_data=$this->skill->find($skill->id);
    $skill_data->roms_count=$skill->count;
    $skill_data->save();
    }

    //Count and save coresidents
    $skills=DB::table('coresidents')
                 ->select(DB::raw('resident_job, count(*) as count'))
                  ->whereIn('resident_nation',$roms)
                  ->groupby('resident_job')
                    ->get();
    foreach ($skills as $skill)
    {
      $scans=Skill::all();
      foreach($scans as $scan){
        if($scan->skill_name == $skill->resident_job){
          $scan->roms_count+=$skill->count;
          $scan->save();
        }
      }

    }

    $data['skills']=Skill::all()->sortby('skill_name');

    //return $skills;
    return view('table/open_skill',$data);

    }
    public function export_table_skill()
    {
    $data=[];
    $data['now']=Carbon::now();
    $data['skills']=Skill::all()->sortby('skill_name');
    $now=Carbon::now();
    $data['today']=$now;
    header('Content-Disposition: attachment;filename=export_'.$data['today'].'.xls');
    return view('table/export_skill',$data);
    }

    public function open_table_nation(NationStats $nation_stats)
    {
      //Reset nationstable
      DB::table('nations')->truncate();
      $nations=$this->nationality;
      $nation_table=$this->nation;
      foreach($nations as $name){
        $data['name']=$name;
        $data['total']=0;
        $nation_table->insert($data);
      }

      //$roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $roms = $this->roms;
      $data=[];
      //Count nationalitys from model table
      $number=Nation::count();
      $data['now']=Carbon::now();
      $data['nations']=DB::table('households')
                    ->select(DB::raw('households.nationality, count(*) as count'))
                    ->whereIn('households.nationality',$roms)
                    ->groupby('households.nationality')
                      ->get();
        $nations=DB::table('households')
                                    ->select(DB::raw('households.nationality, count(*) as count'))
                                    ->whereIn('households.nationality',$roms)
                                    ->groupby('households.nationality')
                                      ->get();

      // save count of households to table
      foreach ($nations as $nation)
      for ($i=1;$i<=$number;$i++){
        $model_nation=$this->nation->find($i);
        if($nation->nationality==$model_nation->name){
          $model_nation->total=$nation->count;
          $model_nation->save();
        }
      }

      $data['wives']=DB::table('wives')
                          ->select(DB::raw('wives.wife_nation, count(*) as count'))
                          ->whereIn('wives.wife_nation',$roms)
                          ->groupby('wives.wife_nation')
                          ->get();
      $wives=DB::table('wives')
                            ->select(DB::raw('wives.wife_nation, count(*) as count'))
                            ->whereIn('wives.wife_nation',$roms)
                            ->groupby('wives.wife_nation')
                            ->get();

      // save count of wives to table
      foreach ($wives as $nation)
      for ($i=1;$i<=$number;$i++){
        $model_nation=$this->nation->find($i);
        if($nation->wife_nation==$model_nation->name){
          $model_nation->total=$model_nation->total+$nation->count;
          $model_nation->save();
        }
      }

      $data['coresidents']=DB::table('coresidents')
                          ->select(DB::raw('coresidents.resident_nation, count(*) as count'))
                          ->whereIn('coresidents.resident_nation',$roms)
                          ->groupby('coresidents.resident_nation')
                          ->get();
      $coresidents=DB::table('coresidents')
                            ->select(DB::raw('coresidents.resident_nation, count(*) as count'))
                            ->whereIn('coresidents.resident_nation',$roms)
                            ->groupby('coresidents.resident_nation')
                            ->get();


        // save count of coresidents to table
        foreach ($coresidents as $nation)
        for ($i=1;$i<=$number;$i++){
          $model_nation=$this->nation->find($i);
          if($nation->resident_nation==$model_nation->name){
            $model_nation->total=$model_nation->total+$nation->count;
            $model_nation->save();
          }
        }

//Spouses
        $data['coresidents_s']=DB::table('coresident_spouses')
                            ->select(DB::raw('coresident_spouses.spouse_nation, count(*) as count'))
                            ->whereIn('coresident_spouses.spouse_nation',$roms)
                            ->groupby('coresident_spouses.spouse_nation')
                            ->get();
        $coresidents_s=DB::table('coresident_spouses')
                            ->select(DB::raw('coresident_spouses.spouse_nation, count(*) as count'))
                            ->whereIn('coresident_spouses.spouse_nation',$roms)
                            ->groupby('coresident_spouses.spouse_nation')
                            ->get();

        // save count of coresidents spouses to table
        foreach ($coresidents_s as $nation)
        for ($i=1;$i<=$number;$i++){
          $model_nation=$this->nation->find($i);
          if($nation->spouse_nation==$model_nation->name){
            $model_nation->total=$model_nation->total+$nation->count;
            $model_nation->save();
          }
        }

        //Spouses children
                $data['coresidents_c']=DB::table('coresident_children')
                                    ->select(DB::raw('coresident_children.child_nation, count(*) as count'))
                                    ->whereIn('coresident_children.child_nation',$roms)
                                    ->groupby('coresident_children.child_nation')
                                    ->get();
                $coresidents_c=DB::table('coresident_children')
                                    ->select(DB::raw('coresident_children.child_nation, count(*) as count'))
                                    ->whereIn('coresident_children.child_nation',$roms)
                                    ->groupby('coresident_children.child_nation')
                                    ->get();

                // save count of coresidents children to table
                foreach ($coresidents_c as $nation)
                for ($i=1;$i<=$number;$i++){
                  $model_nation=$this->nation->find($i);
                  if($nation->child_nation==$model_nation->name){
                    $model_nation->total=$model_nation->total+$nation->count;
                    $model_nation->save();
                  }
                }

  $data['children']=DB::table('households')
                                  ->join('children','households.id','=','children.household_id')
                                  ->select(DB::raw('households.nationality, count(*) as count'))
                                                  ->whereIn('households.nationality',$roms)
                                                  ->groupby('households.nationality')
                                                  ->get();
  $children=DB::table('households')
                    ->join('children','households.id','=','children.household_id')
                    ->select(DB::raw('households.nationality, count(*) as count'))
                                    ->whereIn('households.nationality',$roms)
                                    ->groupby('households.nationality')
                                    ->get();

        // save count of children to table
        foreach ($children as $nation)
        for ($i=1;$i<=$number;$i++){
          $model_nation=$this->nation->find($i);
          if($nation->nationality==$model_nation->name){
            $model_nation->total=$model_nation->total+$nation->count;
            $model_nation->save();
          }
        }

    $data['romstotal']=DB::table('nations')->sum('total');
    $data['x']=Nation::all();

    return view('table/open_nation',$data);
    }
    public function export_table_nation()
    {
      //$roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $roms = $this->roms;
      $data=[];
      $data['now']=Carbon::now();
      $data['nations']=DB::table('households')
                    ->select(DB::raw('households.nationality, count(*) as count'))
                    ->whereIn('households.nationality',$roms)
                    ->groupby('households.nationality')
                      ->get();
      $data['wives']=DB::table('wives')
                          ->select(DB::raw('wives.wife_nation, count(*) as count'))
                          ->whereIn('wives.wife_nation',$roms)
                          ->groupby('wives.wife_nation')
                          ->get();
      $data['coresidents']=DB::table('coresidents')
                          ->select(DB::raw('coresidents.resident_nation, count(*) as count'))
                          ->whereIn('coresidents.resident_nation',$roms)
                          ->groupby('coresidents.resident_nation')
                          ->get();
      $data['coresidents_s']=DB::table('coresident_spouses')
                                              ->select(DB::raw('coresident_spouses.spouse_nation, count(*) as count'))
                                              ->whereIn('coresident_spouses.spouse_nation',$roms)
                                              ->groupby('coresident_spouses.spouse_nation')
                                              ->get();
    $data['coresidents_c']=DB::table('coresident_children')
                              ->select(DB::raw('coresident_children.child_nation, count(*) as count'))
                              ->whereIn('coresident_children.child_nation',$roms)
                              ->groupby('coresident_children.child_nation')
                              ->get();
  $data['children']=DB::table('households')
            ->join('children','households.id','=','children.household_id')
            ->select(DB::raw('households.nationality, count(*) as count'))
                    ->whereIn('households.nationality',$roms)
                    ->groupby('households.nationality')
                    ->get();

      $data['x']=Nation::all();
      $data['romstotal']=DB::table('nations')->sum('total');
      $now=Carbon::now();
      $data['today']=$now;
     header('Content-Disposition: attachment;filename=export_'.$data['today'].'.xls');
      return view('table/export_nation',$data);
    }


    public function chart_old()
    {
      $chart= new SampleChart;
// Add the dataset (we will go with the chart template approach)
$chart->dataset('Sample', 'line', [100, 65, 84, 45, 90])
->options([
  'borderColor'=>'#ff0000'
]);
return view('charts/first',['chart'=>$chart]);
}

}
