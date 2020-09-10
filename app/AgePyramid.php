<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\StatsCounter;
use Illuminate\Support\Facades\DB;

class AgePyramid extends Model
{
    protected $youngest;
    protected $oldest;

    public function __construct()
    {
      $this->roms =   app(StatsCounter::class)->getRoms(); //Roms attribute from service container

    }

    public function resetAgePyramid()
    {
      DB::table('age_pyramids')->truncate();
    }


    public function getYoungest($vid)
    {
      $this->youngest[]=DB::table('households')
                    ->whereIn('households.nationality',$this->roms)
                    ->whereIn('households.village_id',$vid)
                    ->min('age');

      $this->youngest[]=DB::table('wives')
                      ->join('households','households.id','=','wives.household_id')
                      ->whereIn('wife_nation',$this->roms)
                      ->whereIn('households.village_id',$vid)
                      ->min('wife_age');

      $this->youngest[]=DB::table('households')
                      ->join('children','households.id','=','children.household_id')
                      ->whereIn('households.nationality',$this->roms)
                      ->whereIn('households.village_id',$vid)
                      ->min('children.child_age');

      $this->youngest[]=DB::table('coresidents')
                    ->join('households','households.id','=','coresidents.household_id')
                    ->whereIn('resident_nation',$this->roms)
                    ->whereIn('households.village_id',$vid)
                    ->min('resident_age');

      $this->youngest[]=DB::table('coresident_spouses')
                    ->join('households','households.id','=','coresident_spouses.household_id')
                    ->whereIn('spouse_nation',$this->roms)
                    ->whereIn('households.village_id',$vid)
                    ->min('spouse_age');

      $this->youngest[]=DB::table('coresident_children')
                        ->join('households','households.id','=','coresident_children.household_id')
                        ->whereIn('child_nation',$this->roms)
                        ->whereIn('households.village_id',$vid)
                        ->min('child_age');

      return $this->youngest = min($this->youngest);
    }

    public function getOldest($vid)
    {
      $this->oldest[]=DB::table('households')
                      ->whereIn('households.nationality',$this->roms)
                      ->whereIn('households.village_id',$vid)
                      ->max('age');

      $this->oldest[]=DB::table('wives')
                      ->join('households','households.id','=','wives.household_id')
                      ->whereIn('wife_nation',$this->roms)
                      ->whereIn('households.village_id',$vid)
                      ->max('wife_age');

      $this->oldest[]=DB::table('households')
                      ->join('children','households.id','=','children.household_id')
                      ->whereIn('households.nationality',$this->roms)
                      ->whereIn('households.village_id',$vid)
                      ->max('children.child_age');

      $this->oldest[]=DB::table('coresidents')
                      ->join('households','households.id','=','coresidents.household_id')
                      ->whereIn('resident_nation',$this->roms)
                      ->whereIn('households.village_id',$vid)
                      ->max('resident_age');

      $this->oldest[]=DB::table('coresident_spouses')
                      ->join('households','households.id','=','coresident_spouses.household_id')
                      ->whereIn('spouse_nation',$this->roms)
                      ->whereIn('households.village_id',$vid)
                      ->max('spouse_age');

      $this->oldest[]=DB::table('coresident_children')
                      ->join('households','households.id','=','coresident_children.household_id')
                      ->whereIn('child_nation',$this->roms)
                      ->whereIn('households.village_id',$vid)
                      ->max('child_age');

      $this->oldest=max($this->oldest);

      return $this->oldest;
    }

    public function initage($youngest,$oldest)
    {

      $ageP=AgePyramid::all();
      for($i=$oldest;$i>=$youngest;$i--){
        $data['age']=$i;
        $data['male']=0;
        $data['female']=0;
        $data['ilfov_male']=0;
        $data['ilfov_female']=0;
        $data['dambovita_male']=0;
        $data['dambovita_female']=0;
        $this->insert($data);
      }
    }

    public function statsUpdate($youngest, $oldest, $vid, $district=null)
    {
      $roms = $this->roms;
      $ageFrom = $youngest;
      $ageTo = $oldest;
      $agepyramid = AgePyramid::all();

      // Household male
      $x=1;
      for($i=$ageTo;$i>=$ageFrom;$i--){
      $men=DB::table('households')
                    ->select(DB::raw('age, count(*) as sum'))
                    ->where('gender','=','Male')
                    ->whereIn('households.nationality',$roms)
                    ->whereIn('households.village_id',$vid)
                    ->where('age','=', $i)
                    ->groupby('age')
                    ->get();

      $ageP=$agepyramid->find($x);
      if ($men->isEmpty()){

        }
      else {
        foreach($men as $m)
              {
                $stats = $m->sum;
              }

      switch($district)
            {
              case 'Ilfov':
              $ageP->ilfov_male = $ageP->ilfov_male + $stats;
              break;
              case 'Dambovita':
              $ageP->dambovita_male = $ageP->dambovita_male + $stats;
              break;
              default:
              $ageP->male = $ageP->male + $stats;
              }

      $ageP->save();
      }
      $x++;
      }

    //End Household Male
    // Household Female
      $x=1;
      for($i=$ageTo;$i>=$ageFrom;$i--){
      $men=DB::table('households')
                    ->select(DB::raw('age, count(*) as sum'))
                    ->where('gender','=','Female')
                    ->whereIn('households.nationality',$roms)
                    ->whereIn('households.village_id',$vid)
                    ->where('age','=', $i)
                    ->groupby('age')
                    ->get();

        $ageP=$agepyramid->find($x);
        if ($men->isEmpty()){

                      }
          else {
                foreach($men as $m)
                    {
                      $stats = $m->sum;
                      }

                    switch($district)
                          {
                            case 'Ilfov':
                            $ageP->ilfov_female = $ageP->ilfov_female + $stats;
                            break;
                            case 'Dambovita':
                            $ageP->dambovita_female = $ageP->dambovita_female + $stats;
                            break;
                            default:
                            $ageP->female = $ageP->female + $stats;
                            }

                    $ageP->save();
                  }
                    $x++;
                    }
    //End Household Female

    // Wives Female
      $x=1;
      for($i=$ageTo;$i>=$ageFrom;$i--){
      $men=DB::table('wives')
                    ->join('households','households.id','=','wives.household_id')
                    ->select(DB::raw('wife_age, count(*) as sum'))
                    ->where('wife_gender','=','Female')
                    ->whereIn('wife_nation',$roms)
                    ->whereIn('households.village_id',$vid)
                    ->where('wife_age','=', $i)
                    ->groupby('wife_age')
                    ->get();

                    $ageP=$agepyramid->find($x);
                    if ($men->isEmpty()){

                      }
                    else {
                      foreach($men as $m)
                            {
                              $stats =  $m->sum;
                            }

                    switch($district)
                          {
                            case 'Ilfov':
                            $ageP->ilfov_female = $ageP->ilfov_female + $stats;
                            break;
                            case 'Dambovita':
                            $ageP->dambovita_female = $ageP->dambovita_female + $stats;
                            break;
                            default:
                            $ageP->female= $ageP->female + $stats;
                            }


                    $ageP->save();
                  }
                    $x++;
                    }
    //End Wives Female

    // Wives Male
      $x=1;
      for($i=$ageTo;$i>=$ageFrom;$i--){
      $men=DB::table('wives')
                    ->join('households','households.id','=','wives.household_id')
                    ->select(DB::raw('wife_age, count(*) as sum'))
                    ->where('wife_gender','=','Male')
                    ->whereIn('wife_nation',$roms)
                    ->whereIn('households.village_id',$vid)
                    ->where('wife_age','=', $i)
                    ->groupby('wife_age')
                    ->get();

      $ageP=$agepyramid->find($x);
      if ($men->isEmpty()){


      }
      else {
        foreach($men as $m)
          {
            $stats =  $m->sum;
          }

          switch($district)
                {
                  case 'Ilfov':
                  $ageP->ilfov_male = $ageP->ilfov_male + $stats;
                  break;
                  case 'Dambovita':
                  $ageP->dambovita_male = $ageP->dambovita_male + $stats;
                  break;
                  default:
                  $ageP->male = $ageP->male + $stats;
                  }
      $ageP->save();
      }
      $x++;
    }
    //End Wives Male

    //Male children
      $x=1;
      for($i=$ageTo;$i>=$ageFrom;$i--){
      $men=DB::table('households')
                ->join('children','households.id','=','children.household_id')
                    ->select(DB::raw('child_age, count(*) as sum'))
                    ->where('child_gender','=','Male')
                    ->whereIn('households.nationality',$roms)
                    ->whereIn('households.village_id',$vid)
                    ->where('child_age','=', $i)
                    ->groupby('child_age')
                    ->get();

      $ageP=$agepyramid->find($x);
      if ($men->isEmpty()){

      }
      else {
        foreach($men as $m){
          $stats =  $m->sum;
        }

      switch($district)
            {
              case 'Ilfov':
              $ageP->ilfov_male = $ageP->ilfov_male + $stats;
              break;
              case 'Dambovita':
              $ageP->dambovita_male = $ageP->dambovita_male + $stats;
              break;
              default:
              $ageP->male = $ageP->male + $stats;
              }
      $ageP->save();
      }
      $x++;
    }
    //End Male children
    //Female children
      $x=1;
      for($i=$ageTo;$i>=$ageFrom;$i--){
      $men=DB::table('households')
                ->join('children','households.id','=','children.household_id')
                    ->select(DB::raw('child_age, count(*) as sum'))
                    ->where('child_gender','=','Female')
                    ->whereIn('households.nationality',$roms)
                    ->whereIn('households.village_id',$vid)
                    ->where('child_age','=', $i)
                    ->groupby('child_age')
                    ->get();

      $ageP=$agepyramid->find($x);
      if ($men->isEmpty()){


      }
      else {
        foreach($men as $m){
            $stats =  $m->sum;
        }

      switch($district)
            {
              case 'Ilfov':
              $ageP->ilfov_female = $ageP->ilfov_female + $stats;
              break;
              case 'Dambovita':
              $ageP->dambovita_female = $ageP->dambovita_female + $stats;
              break;
              default:
              $ageP->female= $ageP->female + $stats;
              }
      $ageP->save();
      }
      $x++;
    }
    //End Female children
    //Male Coresidents
      $x=1;
      for($i=$ageTo;$i>=$ageFrom;$i--){
      $men=DB::table('coresidents')
                    ->join('households','households.id','=','coresidents.household_id')
                    ->select(DB::raw('resident_age, count(*) as sum'))
                    ->where('resident_gender','=','Male')
                    ->whereIn('resident_nation',$roms)
                    ->whereIn('households.village_id',$vid)
                    ->where('resident_age','=', $i)
                    ->groupby('resident_age')
                    ->get();

      $ageP=$agepyramid->find($x);
      if ($men->isEmpty()){

      }
      else {
        foreach($men as $m){
          $stats=$m->sum;
        }

      switch($district)
            {
              case 'Ilfov':
              $ageP->ilfov_male = $ageP->ilfov_male + $stats;
              break;
              case 'Dambovita':
              $ageP->dambovita_male = $ageP->dambovita_male + $stats;
              break;
              default:
              $ageP->male = $ageP->male + $stats;
              }
      $ageP->save();
      }
      $x++;
    }
    //End Male coresidents
    //Female Coresidents
      $x=1;
      for($i=$ageTo;$i>=$ageFrom;$i--){
      $men=DB::table('coresidents')
                    ->join('households','households.id','=','coresidents.household_id')
                    ->select(DB::raw('resident_age, count(*) as sum'))
                    ->where('resident_gender','=','Female')
                    ->whereIn('resident_nation',$roms)
                    ->whereIn('households.village_id',$vid)
                    ->where('resident_age','=', $i)
                    ->groupby('resident_age')
                    ->get();

      $ageP=$agepyramid->find($x);
      if ($men->isEmpty()){

      }
      else {
        foreach($men as $m){
          $stats=$m->sum;
        }

      switch($district)
            {
              case 'Ilfov':
              $ageP->ilfov_female = $ageP->ilfov_female + $stats;
              break;
              case 'Dambovita':
              $ageP->dambovita_female = $ageP->dambovita_female + $stats;
              break;
              default:
              $ageP->female= $ageP->female + $stats;
              }
      $ageP->save();
      }
      $x++;
    }
    //End Female coresidents
    //Coresidents spouse female
      $x=1;
      for($i=$ageTo;$i>=$ageFrom;$i--){
      $men=DB::table('coresident_spouses')
                    ->join('households','households.id','=','coresident_spouses.household_id')
                    ->select(DB::raw('spouse_age, count(*) as sum'))
                    ->where('spouse_gender','=','Female')
                    ->whereIn('spouse_nation',$roms)
                    ->whereIn('households.village_id',$vid)
                    ->where('spouse_age','=', $i)
                    ->groupby('spouse_age')
                    ->get();

      $ageP=$agepyramid->find($x);
      if ($men->isEmpty()){

      }
      else {
        foreach($men as $m){
          $stats = $m->sum;
        }

      switch($district)
            {
              case 'Ilfov':
              $ageP->ilfov_female = $ageP->ilfov_female + $stats;
              break;
              case 'Dambovita':
              $ageP->dambovita_female = $ageP->dambovita_female + $stats;
              break;
              default:
              $ageP->female= $ageP->female + $stats;
              }
      $ageP->save();
      }
      $x++;
    }
    //End Female coresidents spouse
    //Coresidents spouse Male
      $x=1;
      for($i=$ageTo;$i>=$ageFrom;$i--){
      $men=DB::table('coresident_spouses')
                    ->join('households','households.id','=','coresident_spouses.household_id')
                    ->select(DB::raw('spouse_age, count(*) as sum'))
                    ->where('spouse_gender','=','Male')
                    ->whereIn('spouse_nation',$roms)
                    ->whereIn('households.village_id',$vid)
                    ->where('spouse_age','=', $i)
                    ->groupby('spouse_age')
                    ->get();

      $ageP=$agepyramid->find($x);
      if ($men->isEmpty()){

      }
      else {
        foreach($men as $m){
          $stats=$m->sum;
        }

      switch($district)
            {
              case 'Ilfov':
              $ageP->ilfov_male = $ageP->ilfov_male + $stats;
              break;
              case 'Dambovita':
              $ageP->dambovita_male = $ageP->dambovita_male + $stats;
              break;
              default:
              $ageP->male = $ageP->male + $stats;
              }
      $ageP->save();
      }
      $x++;
    }
    //End Male coresidents spouse
    //Coresidents children female
      $x=1;
      for($i=$ageTo;$i>=$ageFrom;$i--){
      $men=DB::table('coresident_children')
                    ->join('households','households.id','=','coresident_children.household_id')
                    ->select(DB::raw('child_age, count(*) as sum'))
                    ->where('child_gender','=','Female')
                    ->whereIn('child_nation',$roms)
                    ->whereIn('households.village_id',$vid)
                    ->where('child_age','=', $i)
                    ->groupby('child_age')
                    ->get();

      $ageP=$agepyramid->find($x);
      if ($men->isEmpty()){

      }
      else {
        foreach($men as $m){
          $stats=$m->sum;
        }

      switch($district)
            {
              case 'Ilfov':
              $ageP->ilfov_female = $ageP->ilfov_female + $stats;
              break;
              case 'Dambovita':
              $ageP->dambovita_female = $ageP->dambovita_female + $stats;
              break;
              default:
              $ageP->female= $ageP->female + $stats;
              }
      $ageP->save();
      }
      $x++;
    }
    //End Female coresidents children
    //Coresidents children Male
      $x=1;
      for($i=$ageTo;$i>=$ageFrom;$i--){
      $men=DB::table('coresident_children')
                    ->join('households','households.id','=','coresident_children.household_id')
                    ->select(DB::raw('child_age, count(*) as sum'))
                    ->where('child_gender','=','Male')
                    ->whereIn('child_nation',$roms)
                    ->whereIn('households.village_id',$vid)
                    ->where('child_age','=', $i)
                    ->groupby('child_age')
                    ->get();

      $ageP=$agepyramid->find($x);
      if ($men->isEmpty()){

      }
      else {
        foreach($men as $m){
          $stats=$m->sum;
          }

      switch($district)
            {
              case 'Ilfov':
              $ageP->ilfov_male = $ageP->ilfov_male + $stats;
              break;
              case 'Dambovita':
              $ageP->dambovita_male = $ageP->dambovita_male + $stats;
              break;
              default:
              $ageP->male = $ageP->male + $stats;
              }
      $ageP->save();
      }
      $x++;
    }
    //End Male coresidents children
    }

}
