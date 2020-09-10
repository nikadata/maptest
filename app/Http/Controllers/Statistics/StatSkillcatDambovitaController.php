<?php

namespace App\Http\Controllers\Statistics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\StatsCounter;
use Carbon\Carbon;
use App\Charts\SampleChart;
use App\Household;
use App\Village;
use Illuminate\Support\Facades\DB;
use App\Skill\Skill as Skill;
use App\Skill\Skillcats as Skillcat;
use App\Skill\SkillCatTraditional;
use App\Skill\SkillCatCrafts;
use App\Skill\SkillCatMusicians;
use App\Skill\SkillCatAgriculture;
use App\Skill\SkillCatService;
use App\Skill\SkillCatHigherStatus;
use App\Skill\SkillCatNotSpecified;
class StatSkillcatDambovitaController extends Controller
{
  public function __construct(Skill $skill, SkillCatTraditional $skillcattraditional, SkillCatCrafts $skillcatcraft, SkillCatMusicians $skillcatmusicians, SkillCatAgriculture $skillcatagriculture, SkillCatService $skillcatservice,
  SkillCatHigherStatus $skillcathigherstatus, SkillCatNotSpecified $skillcatnotspecified)
  {
    $this->roms =   app(StatsCounter::class)->getRoms(); //Roms attribute from service container
    $this->skill = $skill;
    $this->SkillCatTraditional = $skillcattraditional->all();
    $this->SkillCatCraft = $skillcatcraft->all();
    $this->SkillCatMusicians = $skillcatmusicians->all();
    $this->SkillCatAgriculture = $skillcatagriculture->all();
    $this->SkillCatService = $skillcatservice->all();
    $this->SkillCatHigherStatus = $skillcathigherstatus->all();
    $this->SkillCatNotSpecified = $skillcatnotspecified->all();
  }
  public function open_table_skill(Skill $skill)
  {

    $roms = $this->roms;
    $data['now']=Carbon::now();

    //Create graph chart
    $cats=Skillcat::all();
    //Create Chart object
    $rom_skills=new SampleChart;
    //Load api reference
    $api=url('/dambovita/skill_cat_data_rom');
    //Assign label
    foreach ($cats as $cat)
      {
        $label[]=$cat->skillcat_name;
      }
    //Load label
    $rom_skills->labels($label)->load($api);

    //General data
    $data['household_records']=Household::count();
    $data['roms']=DB::table('households')
                  ->whereIn('households.nationality',$roms)
                  ->count();
    //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
    $data['romstotal']=DB::table('nations')->sum('total');
    $data['village_records']=Village::count();
    //Uppdate skillcategories
    $skillCat = new SkillCat;
    //Call method to store stats
    $skillCat->updateSkillCat($this->SkillCatTraditional, $this->SkillCatCraft, $this->SkillCatMusicians, $this->SkillCatAgriculture, $this->SkillCatService, $this->SkillCatHigherStatus, $this->SkillCatNotSpecified, 'Dambovita');

    $data['skills']=Skillcat::all();
    //End data for table
    return view('charts/dambovita/open_cat_skill',['rom_skills'=>$rom_skills],$data);

    }

  public function response_skill()
  {

    $rom_skills=new SampleChart;
    //Load skillcats model
    $skillcats=Skillcat::all();
    foreach ($skillcats as $skillcat)
    {
      $sum[] = $skillcat->dambovita_skillcat_number;
    }

    $rom_skills->dataset('Number of Roms', 'bar', $sum)->color('#00ff00');

    return $rom_skills->api();
  }

}
