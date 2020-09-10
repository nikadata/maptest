<?php

namespace App\Http\Controllers\Statistics;
use App\Http\Controllers\Controller;
use App\Charts\SampleChart;
use App\Skill\Skill as Skill;
use App\Village;
use App\Household;
use App\Skill\Skillcats as Skillcat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\StatsCounter;
use App\Services\VillageCounter as VillageCounter;
use App\Skill\SkillCatTraditional;
use App\Skill\SkillCatCrafts;
use App\Skill\SkillCatMusicians;
use App\Skill\SkillCatAgriculture;
use App\Skill\SkillCatService;
use App\Skill\SkillCatHigherStatus;
use App\Skill\SkillCatNotSpecified;

class StatSkillcatController extends Controller
{
    //
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
    /*
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
  */
      //Getting time/date from server
      $data['now']=Carbon::now();

    //Create graph chart
    $cats=Skillcat::all();
    //Create Chart object
    $rom_skills=new SampleChart;
    //Load api reference
    $api=url('/skill_cat_data_rom');
    //Assign label
    foreach ($cats as $cat) {
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

    $skillCat = new SkillCat;
    //Call method to store stats
    $skillCat->updateSkillCat($this->SkillCatTraditional, $this->SkillCatCraft, $this->SkillCatMusicians, $this->SkillCatAgriculture, $this->SkillCatService, $this->SkillCatHigherStatus, $this->SkillCatNotSpecified);
    //Uppdate skillcategories


    $data['skills']=Skillcat::all();
    //End data for table
    return view('table/open_cat_skill',['rom_skills'=>$rom_skills],$data);

    }
    public function response_skill()
    {

      $rom_skills=new SampleChart;
      //Load skillcats model
      $skillcats=Skillcat::all();
      foreach ($skillcats as $skillcat)
      {
        $sum[] = $skillcat->skillcat_number;
      }

      $rom_skills->dataset('Number of Roms', 'bar', $sum)->color('#00ff00');

      return $rom_skills->api();
    }
    public function export_table_skill()
    {
    $data=[];
    $data['now']=Carbon::now();
    $data['skills']=Skillcat::all();
    $now=Carbon::now();
    $data['today']=$now;
    header('Content-Disposition: attachment;filename=export_'.$data['today'].'.xls');
    return view('table/export_skill_cat',$data);
    }

}
