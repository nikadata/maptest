<?php

namespace App\Skill;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Services\StatsCounter;

class Skill extends Model
{
    protected $skill;
    protected $reset;

    public function __construct()
    {
      $this->roms = app(StatsCounter::class)->getRoms(); //Roms attribute from service container

    }
    public function reset()
    {
      //Reset skill count data
      $this->reset = Skill::all();
      foreach ($this->reset as $reset){
          $reset->roms_count = 0;
          $reset->second_roms_count = 0;
          $reset->ilfov_roms_count = 0;
          $reset->ilfov_second_roms_count = 0;
          $reset->dambovita_roms_count = 0;
          $reset->dambovita_second_roms_count = 0;
          $reset->save();
          }
    }

    public function updateSkill($vid, $district=null)
    {
      $this->skill = Skill::all();

      $roms = $this->roms;
      //First skill household
      $skills = DB::table('households')
                    ->join('skills','households.skill_id','=','skills.id')
                    ->select(DB::raw('skills.id, count(*) as count'))
                    ->whereIn('households.nationality',$roms)
                    ->whereIn('households.village_id',$vid)
                    ->groupby('skills.id')
                    ->get();
      foreach ($skills as $skill)
      {
          $skill_data = $this->skill->find($skill->id);
          switch($district)
          {
            case'Ilfov':
            $skill_data->ilfov_roms_count = $skill->count;
            break;
            case'Dambovita':
            $skill_data->dambovita_roms_count = $skill->count;
            break;
            default:
            $skill_data->roms_count = $skill->count;
            }
            $skill_data->save();
      }
      //Second skill households
      $skills = DB::table('households')
                    ->join('skills','households.second_skill_id','=','skills.id')
                    ->select(DB::raw('skills.id, count(*) as count'))
                    ->whereIn('households.nationality',$roms)
                    ->whereIn('households.village_id',$vid)
                    ->groupby('skills.id')
                    ->get();
      foreach ($skills as $skill)
        {
            $skill_data = $this->skill->find($skill->id);
            switch($district)
            {
              case'Ilfov':
              $skill_data->ilfov_second_roms_count = $skill->count;
              break;
              case'Dambovita':
              $skill_data->dambovita_second_roms_count = $skill->count;
              break;
              default:
              $skill_data->second_roms_count = $skill->count;
            }
            $skill_data->save();
        }

        // Coresidents first skill
        //Count and save coresidents
        $skills = DB::table('coresidents')
                      ->join('households','households.id','=','coresidents.household_id')
                      ->select(DB::raw('resident_job, count(*) as count'))
                      ->whereIn('resident_nation',$roms)
                      ->whereIn('households.village_id',$vid)
                      ->groupby('resident_job')
                      ->get();
        foreach ($skills as $skill)
        {
            $scans=Skill::all();
            foreach($scans as $scan)
            {
              if($scan->skill_name == $skill->resident_job){
              switch($district)
              {
                case'Ilfov':
                $scan->ilfov_roms_count += $skill->count;
                break;
                case'Dambovita':
                $scan->dambovita_roms_count += $skill->count;
                break;
                default:
                $scan->roms_count += $skill->count;
              }
              $scan->save();
            }
          }

        }

        //Second skill coresidents
        $skills = DB::table('coresidents')
                      ->join('households','households.id','=','coresidents.household_id')
                      ->select(DB::raw('resident_second_job, count(*) as count'))
                      ->whereIn('resident_nation',$roms)
                      ->whereIn('households.village_id',$vid)
                      ->groupby('resident_second_job')
                      ->get();

        foreach ($skills as $skill)
        {
          $scans = Skill::all();
          foreach($scans as $scan)
          {
            if($scan->skill_name == $skill->resident_second_job){
                switch($district)
                {
                  case'Ilfov':
                  $scan->ilfov_second_roms_count += $skill->count;
                  break;
                  case'Dambovita':
                  $scan->dambovita_second_roms_count += $skill->count;
                  break;
                  default:
                  $scan->second_roms_count += $skill->count;
                }
                $scan->save();
            }
          }

        }

        // Summerizing first and second skill in table
        //Add first and second skill
        $skills = Skill::all();
        foreach($skills as $skill)
        {
          if($skill->skill_name == 'None'){
            //Do nothing
          }
          else{
            switch($district)
            {
              case'Ilfov':
              $skill->ilfov_roms_count = $skill->ilfov_roms_count + $skill->ilfov_second_roms_count;
              break;
              case'Dambovita':
              $skill->dambovita_roms_count = $skill->dambovita_roms_count + $skill->dambovita_second_roms_count;
              break;
              default:
              $skill->roms_count = $skill->roms_count + $skill->second_roms_count;
            }
          }
          $skill->save();
        }
    }
}
