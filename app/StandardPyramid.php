<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Services\StatsCounter;

class StandardPyramid extends Model
{
  public function __construct()
  {
    $this->roms =   app(StatsCounter::class)->getRoms(); //Roms attribute from service container

  }
    public function update_pyramid()
    {
      $stats = StandardPyramid::all();
      $data['age'] = '100-104';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '95-99';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '90-94';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '85-89';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '80-84';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '75-79';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '70-74';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '65-69';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '60-64';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '55-59';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '50-54';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '45-49';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '40-44';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '35-39';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '30-34';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '25-29';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '20-24';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '15-19';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '10-14';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '5-9';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
      $data['age'] = '0-4';
      $data['male'] = 0;
      $data['female'] = 0;
      $this->insert($data);
    }
    public function resetPyramid()
    {
      //Reset modeltable standard_pyramid
      $pyrs = StandardPyramid::all();
      foreach($pyrs as $pyr){
        $pyr->male = 0;
        $pyr->female = 0;
        $pyr->ilfov_male = 0;
        $pyr->ilfov_female = 0;
        $pyr->dambovita_male = 0;
        $pyr->dambovita_female = 0;
        $pyr->save();
      }
    }
    // Uppdate pyramid - start

      public function calculatePyramid($vid, $district=null)
      {
        $pyramid = StandardPyramid::all();
        $ageFrom = 0;
        $ageTo = 104;

        $p = 1;
        for($i=$ageTo;$i>$ageFrom;$i=$i-4){
            $men = DB::table('households')
                    ->select(DB::raw('age, count(*) as sum'))
                    ->where('gender','=','Male')
                    ->whereIn('households.nationality',$this->roms)
                    ->whereIn('households.village_id',$vid)
                    ->whereBetween('age', [$i-4, $i])
                    ->groupby('age')
                    ->get();
            $i--;

            $x=0;
            if ($men->isEmpty()){
                $p++;
                }
                else {

                  foreach($men as $m)
                  {
                    $x=$x+$m->sum;
                  }
                  switch($district)
                  {
                    case 'Ilfov':
                    $model_pyramid = $pyramid->find($p);
                    $model_pyramid->ilfov_male = $x;
                    $model_pyramid->save();
                    break;
                    case 'Dambovita':
                    $model_pyramid = $pyramid->find($p);
                    $model_pyramid->dambovita_male=$x;
                    $model_pyramid->save();
                    break;
                    default:
                    $model_pyramid = $pyramid->find($p);
                    $model_pyramid->male = $x;
                    $model_pyramid->save();
                  }
                  $p++;
                }

    }

      //Female
      $p=1;
    for($i=$ageTo;$i>$ageFrom;$i=$i-4){
      $female=DB::table('households')
                    ->select(DB::raw('age, count(*) as sum'))
                    ->where('gender','=','Female')
                    ->whereIn('households.nationality',$this->roms)
                    ->whereIn('households.village_id',$vid)
                    ->whereBetween('age', [$i-4, $i])
                    ->groupby('age')
                    ->get();
                    $i--;

      $x=0;
      if ($female->isEmpty()){
        $p++;
      }
      else {
        foreach($female as $m){
          $x = $x+$m->sum;
        }
        switch($district)
        {
          case 'Ilfov':
          $model_pyramid = $pyramid->find($p);
          $model_pyramid->ilfov_female = $x;
          $model_pyramid->save();
          break;
          case 'Dambovita':
          $model_pyramid = $pyramid->find($p);
          $model_pyramid->dambovita_female = $x;
          $model_pyramid->save();
          break;
          default:
          $model_pyramid = $pyramid->find($p);
          $model_pyramid->female = $x;
          $model_pyramid->save();
        }
        $p++;
      }
    }

    //Wives Female
    $p=1;
    for($i=$ageTo;$i>$ageFrom;$i=$i-4){
    $wife=DB::table('wives')
                  ->join('households','households.id','=','wives.household_id')
                  ->select(DB::raw('wife_age, count(*) as sum'))
                  ->where('wife_gender','=','Female')
                  ->whereIn('wife_nation',$this->roms)
                  ->whereIn('households.village_id',$vid)
                  ->whereBetween('wife_age', [$i-4, $i])
                  ->groupby('wife_age')
                  ->get();
                  $i--;

    $x=0;
    if ($wife->isEmpty()){
      $p++;
    }
    else {
      foreach($wife as $m){
        $x=$x+$m->sum;
      }
      switch($district)
      {
        case 'Ilfov':
        $model_pyramid = $pyramid->find($p);
        $model_pyramid->ilfov_female=$model_pyramid->ilfov_female+$x;
        $model_pyramid->save();
        break;
        case 'Dambovita':
        $model_pyramid = $pyramid->find($p);
        $model_pyramid->dambovita_female=$model_pyramid->dambovita_female+$x;
        $model_pyramid->save();
        break;
        default:
        $model_pyramid = $pyramid->find($p);
        $model_pyramid->female=$model_pyramid->female+$x;
        $model_pyramid->save();
      }
      $p++;
    }

    }
    // end Wives

    //Wives Male
    $p=1;
    for($i=$ageTo;$i>$ageFrom;$i=$i-4){
    $wife=DB::table('wives')
                  ->join('households','households.id','=','wives.household_id')
                  ->select(DB::raw('wife_age, count(*) as sum'))
                  ->where('wife_gender','=','Male')
                  ->whereIn('wife_nation',$this->roms)
                  ->whereIn('households.village_id',$vid)
                  ->whereBetween('wife_age', [$i-4, $i])
                  ->groupby('wife_age')
                  ->get();
                  $i--;

    $x=0;
    if ($wife->isEmpty()){

      $p++;
    }
    else {
      foreach($wife as $m){
        $x=$x+$m->sum;
      }
      switch($district)
      {
        case 'Ilfov':
        $model_pyramid = $pyramid->find($p);
        $model_pyramid->ilfov_male=$model_pyramid->ilfov_male+$x;
        $model_pyramid->save();
        break;
        case 'Dambovita':
        $model_pyramid = $pyramid->find($p);
        $model_pyramid->dambovita_male=$model_pyramid->dambovita_male+$x;
        $model_pyramid->save();
        break;
        default:
        $model_pyramid = $pyramid->find($p);
        $model_pyramid->male=$model_pyramid->male+$x;
        $model_pyramid->save();
      }
      $p++;
    }

    }
    // end Wives Male

//Male children
$p=1;
for($i=$ageTo;$i>$ageFrom;$i=$i-4){
$child=DB::table('households')
              ->join('children','households.id','=','children.household_id')
              ->select(DB::raw('age, count(*) as sum'))
              ->where('children.child_gender','=','Male')
              ->whereIn('households.nationality',$this->roms)
              ->whereIn('households.village_id',$vid)
              ->whereBetween('children.child_age', [$i-4, $i])
              ->groupby('age')
              ->get();
              $i--;

$x=0;
if ($child->isEmpty()){
  $p++;
}
else {
  foreach($child as $m){
    $x=$x+$m->sum;
  }
  switch($district)
  {
    case 'Ilfov':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->ilfov_male=$model_pyramid->ilfov_male+$x;
    $model_pyramid->save();
    break;
    case 'Dambovita':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->dambovita_male=$model_pyramid->dambovita_male+$x;
    $model_pyramid->save();
    break;
    default:
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->male=$model_pyramid->male+$x;
    $model_pyramid->save();
  }
  $p++;
}

}
// end Male Children
//Female children
$p=1;
for($i=$ageTo;$i>$ageFrom;$i=$i-4){
$child=DB::table('households')
              ->join('children','households.id','=','children.household_id')
              ->select(DB::raw('age, count(*) as sum'))
              ->where('children.child_gender','=','Female')
              ->whereIn('households.nationality',$this->roms)
              ->whereIn('households.village_id',$vid)
              ->whereBetween('children.child_age', [$i-4, $i])
              ->groupby('age')
              ->get();
              $i--;

$x=0;
if ($child->isEmpty()){
  $p++;
}
else {
  foreach($child as $m){
    $x=$x+$m->sum;
  }
  switch($district)
  {
    case 'Ilfov':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->ilfov_female=$model_pyramid->ilfov_female+$x;
    $model_pyramid->save();
    break;
    case 'Dambovita':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->dambovita_female=$model_pyramid->dambovita_female+$x;
    $model_pyramid->save();
    break;
    default:
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->female=$model_pyramid->female+$x;
    $model_pyramid->save();
  }
  $p++;
}

}
// end Female Children

//Male Coresidents
$p=1;
for($i=$ageTo;$i>$ageFrom;$i=$i-4){
$resident=DB::table('coresidents')
              ->join('households','households.id','=','coresidents.household_id')
              ->select(DB::raw('resident_age, count(*) as sum'))
              ->where('resident_gender','=','Male')
              ->whereIn('resident_nation',$this->roms)
              ->whereIn('households.village_id',$vid)
              ->whereBetween('resident_age', [$i-4, $i])
              ->groupby('resident_age')
              ->get();
              $i--;

$x=0;
if ($resident->isEmpty()){
  $p++;
}
else {
  foreach($resident as $m){
    $x=$x+$m->sum;
  }
  switch($district)
  {
    case 'Ilfov':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->ilfov_male=$model_pyramid->ilfov_male+$x;
    $model_pyramid->save();
    break;
    case 'Dambovita':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->dambovita_male=$model_pyramid->dambovita_male+$x;
    $model_pyramid->save();
    break;
    default:
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->male=$model_pyramid->male+$x;
    $model_pyramid->save();
  }
  $p++;
}

}
// end Male coresidents
//Female Coresidents
$p=1;
for($i=$ageTo;$i>$ageFrom;$i=$i-4){
$resident=DB::table('coresidents')
              ->join('households','households.id','=','coresidents.household_id')
              ->select(DB::raw('resident_age, count(*) as sum'))
              ->where('resident_gender','=','Female')
              ->whereIn('resident_nation',$this->roms)
              ->whereIn('households.village_id',$vid)
              ->whereBetween('resident_age', [$i-4, $i])
              ->groupby('resident_age')
              ->get();
              $i--;

$x=0;
if ($resident->isEmpty()){
  $p++;
}
else {
  foreach($resident as $m){
    $x=$x+$m->sum;
  }
  switch($district)
  {
    case 'Ilfov':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->ilfov_female=$model_pyramid->ilfov_female+$x;
    $model_pyramid->save();
    break;
    case 'Dambovita':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->dambovita_female=$model_pyramid->dambovita_female+$x;
    $model_pyramid->save();
    break;
    default:
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->female=$model_pyramid->female+$x;
    $model_pyramid->save();
  }
  $p++;
}

}
// end Female coresidents
//Coresidents spouse female
$p=1;
for($i=$ageTo;$i>$ageFrom;$i=$i-4){
$spouse=DB::table('coresident_spouses')
              ->join('households','households.id','=','coresident_spouses.household_id')
              ->select(DB::raw('spouse_age, count(*) as sum'))
              ->where('spouse_gender','=','Female')
              ->whereIn('spouse_nation',$this->roms)
              ->whereIn('households.village_id',$vid)
              ->whereBetween('spouse_age', [$i-4, $i])
              ->groupby('spouse_age')
              ->get();
              $i--;

$x=0;
if ($spouse->isEmpty()){
  $p++;
}
else {
  foreach($spouse as $m){
    $x=$x+$m->sum;
  }
  switch($district)
  {
    case 'Ilfov':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->ilfov_female=$model_pyramid->ilfov_female+$x;
    $model_pyramid->save();
    break;
    case 'Dambovita':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->dambovita_female=$model_pyramid->dambovita_female+$x;
    $model_pyramid->save();
    break;
    default:
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->female=$model_pyramid->female+$x;
    $model_pyramid->save();
  }
  $p++;
}

}
// end Female coresidents spouse female
//Coresidents spouse male
$p=1;
for($i=$ageTo;$i>$ageFrom;$i=$i-4){
$spouse=DB::table('coresident_spouses')
              ->join('households','households.id','=','coresident_spouses.household_id')
              ->select(DB::raw('spouse_age, count(*) as sum'))
              ->where('spouse_gender','=','Male')
              ->whereIn('spouse_nation',$this->roms)
              ->whereIn('households.village_id',$vid)
              ->whereBetween('spouse_age', [$i-4, $i])
              ->groupby('spouse_age')
              ->get();
              $i--;

$x=0;
if ($spouse->isEmpty()){
  $p++;
}
else {
  foreach($spouse as $m){
    $x=$x+$m->sum;
  }
  switch($district)
  {
    case 'Ilfov':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->ilfov_male=$model_pyramid->ilfov_male+$x;
    $model_pyramid->save();
    break;
    case 'Dambovita':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->dambovita_male=$model_pyramid->dambovita_male+$x;
    $model_pyramid->save();
    break;
    default:
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->male=$model_pyramid->male+$x;
    $model_pyramid->save();
  }
  $p++;
}

}
// end Female coresidents spouse male
//Coresidents children female
$p=1;
for($i=$ageTo;$i>$ageFrom;$i=$i-4){
$co_child=DB::table('coresident_children')
              ->join('households','households.id','=','coresident_children.household_id')
              ->select(DB::raw('child_age, count(*) as sum'))
              ->where('child_gender','=','Female')
              ->whereIn('child_nation',$this->roms)
              ->whereIn('households.village_id',$vid)
              ->whereBetween('child_age', [$i-4, $i])
              ->groupby('child_age')
              ->get();
              $i--;

$x=0;
if ($co_child->isEmpty()){
  $p++;
}
else {
  foreach($co_child as $m){
    $x=$x+$m->sum;
  }
  switch($district)
  {
    case 'Ilfov':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->ilfov_female=$model_pyramid->ilfov_female+$x;
    $model_pyramid->save();
    break;
    case 'Dambovita':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->dambovita_female=$model_pyramid->dambovita_female+$x;
    $model_pyramid->save();
    break;
    default:
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->female=$model_pyramid->female+$x;
    $model_pyramid->save();
  }
  $p++;
}

}
// end coresidents children female
//Coresidents children male
$p=1;
for($i=$ageTo;$i>$ageFrom;$i=$i-4){
$co_child=DB::table('coresident_children')
              ->join('households','households.id','=','coresident_children.household_id')
              ->select(DB::raw('child_age, count(*) as sum'))
              ->where('child_gender','=','Male')
              ->whereIn('child_nation',$this->roms)
              ->whereIn('households.village_id',$vid)
              ->whereBetween('child_age', [$i-4, $i])
              ->groupby('child_age')
              ->get();
              $i--;

$x=0;
if ($co_child->isEmpty()){
  $p++;
}
else {
  foreach($co_child as $m){
    $x=$x+$m->sum;
  }
  switch($district)
  {
    case 'Ilfov':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->ilfov_male=$model_pyramid->ilfov_male+$x;
    $model_pyramid->save();
    break;
    case 'Dambovita':
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->dambovita_male=$model_pyramid->dambovita_male+$x;
    $model_pyramid->save();
    break;
    default:
    $model_pyramid = $pyramid->find($p);
    $model_pyramid->male=$model_pyramid->male+$x;
    $model_pyramid->save();
  }
  $p++;
}

}
// end coresidents children male
// end updating standard pyramid
    }
    //Update pyramid - end

}
