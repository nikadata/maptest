<?php

namespace App\Http\Controllers;
use App\Charts\SampleChart;
use App\Skill\Skill as Skill;
use App\Village;
use App\Household;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatSkillController extends Controller
{
    //
    public function __construct(  Skill $skill)
    {
      $this->skill=$skill;
    }
    public function open_table_skill(Skill $skill)
    {
      //Reset skill count data
      $resets=Skill::all();
      foreach ($resets as $reset){
        $reset->roms_count=0;
        $reset->second_roms_count=0;
        $reset->save();
      }
      //
      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $data=[];
      //Getting time/date from server
      $data['now']=Carbon::now();
      //First skill household
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
    //Second skill households
    $skills=DB::table('households')
                ->join('skills','households.second_skill_id','=','skills.id')
                  ->select(DB::raw('skills.id, count(*) as count'))
                  ->whereIn('households.nationality',$roms)
                  ->groupby('skills.id')
                    ->get();
  foreach ($skills as $skill)
  {
  $skill_data=$this->skill->find($skill->id);
  $skill_data->second_roms_count=$skill->count;
  $skill_data->save();
  }
    // Coresidents first skill
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
    //Second skill coresidents
    $skills=DB::table('coresidents')
                 ->select(DB::raw('resident_second_job, count(*) as count'))
                  ->whereIn('resident_nation',$roms)
                  ->groupby('resident_second_job')
                    ->get();

    foreach ($skills as $skill)
    {
      $scans=Skill::all();
      foreach($scans as $scan){
        if($scan->skill_name == $skill->resident_second_job){
          $scan->second_roms_count+=$skill->count;
          $scan->save();
        }
      }

    }
    // Summerizing first and second skill in table
    //Add first and second skill
    $skills=Skill::all();
    foreach($skills as $skill){
      if($skill->skill_name=='None'){
        //Do nothing
      }
      else{
      $skill->roms_count=$skill->roms_count+$skill->second_roms_count;
      }
      $skill->save();
    }
    // Graphs

    $data['skills']=Skill::all()->sortby('skill_name');
    //Create graph chart
    $skills=Skill::all()->sortby('skill_name');
    //Create Chart object
    $rom_skills=new SampleChart;
    //Load api reference
    $api=url('/skill_data_rom');
    //Assign label
    foreach ($skills as $skill) {
      $label[]=$skill->skill_name;
      //$sum[]=$skill->roms_count;
    }
    //return $sum;
    $rom_skills->labels($label)->load($api);
    //MaxMin
    $data['maxs'] = DB::table('skills')->orderBy('roms_count','desc')->first();
    $data['min'] = DB::table('skills')->orderBy('roms_count','asc')->first();
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
    //return $skills;
    return view('table/open_skill',['rom_skills'=>$rom_skills],$data);

    }
    public function response_skill()
    {
      //This function
      //$roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $rom_skills=new SampleChart;

      $skills=Skill::all()->sortby('skill_name');
      foreach ($skills as $skill) {
        //$name[]=$village->village_name;
        $sum[]=$skill->roms_count;
      }

      //$village_rom->dataset('Households(total)', 'bar', $households)->color('#00ff00');
      $rom_skills->dataset('Number of Roms', 'bar', $sum)->color('#00ff00');
      //$village_rom->dataset('Roms total', 'bar', $rom_total)->color('#ff0000');
      return $rom_skills->api();
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

}
