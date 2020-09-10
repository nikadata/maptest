<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\StatsCounter;
use App\Household as Household;
use App\Child as Child;
use App\Coresident as Coresident;
use App\CoresidentSpouse as Coresident_spouse;
use App\CoresidentChild as Coresident_child;
use App\Wife as Wife;
use Illuminate\Support\Facades\DB;

class Nation extends Model
{
    public function __construct()
    {
      $this->roms = app(StatsCounter::class)->getRoms(); //Roms attribute from service container
    }

    public function NationsReset()
    {
      //Reset nationstable
      $this->truncate();
      //Reset with Nationalities = 0
      foreach (app(Nationality::class)->all() as $name)
      {
        $data['name'] = $name;
        $data['total'] = 0;
        $this->insert($data);
      }

    }

    Public function TotalRoms()
    {
      return $this->sum('total');
    }

    public function UpdateNation()
    {
      //Count nationalitys from model table
      $number = $this->count();

      $nations = DB::table('households')
                      ->select(DB::raw('households.nationality, count(*) as count'))
                      ->whereIn('households.nationality',$this->roms)
                      ->groupby('households.nationality')
                      ->get();

      // save count of households to table
      foreach ($nations as $nation){
        for ($i=1;$i<=$number;$i++){
            $model_nation = $this->find($i);
            if($nation->nationality == $model_nation->name){
                $model_nation->total = $nation->count;
                $model_nation->save();
                }
            }
        }
      //Wives
      $wives = DB::table('wives')
                          ->select(DB::raw('wives.wife_nation, count(*) as count'))
                          ->whereIn('wives.wife_nation',$this->roms)
                          ->groupby('wives.wife_nation')
                          ->get();

      // save count of wives to table
      foreach ($wives as $nation) {
        for ($i=1;$i<=$number;$i++){
          $model_nation = $this->find($i);
          if($nation->wife_nation == $model_nation->name){
            $model_nation->total = $model_nation->total + $nation->count;
            $model_nation->save();
            }
          }
        }
      //Coresidents
      $coresidents = DB::table('coresidents')
                          ->select(DB::raw('coresidents.resident_nation, count(*) as count'))
                          ->whereIn('coresidents.resident_nation',$this->roms)
                          ->groupby('coresidents.resident_nation')
                          ->get();

        // save count of coresidents to table
        foreach ($coresidents as $nation) {
          for ($i=1;$i<=$number;$i++){
            $model_nation = $this->find($i);
            if($nation->resident_nation == $model_nation->name){
              $model_nation->total = $model_nation->total + $nation->count;
              $model_nation->save();
              }
            }
          }

        //Spouses
        $coresidents_s = DB::table('coresident_spouses')
                            ->select(DB::raw('coresident_spouses.spouse_nation, count(*) as count'))
                            ->whereIn('coresident_spouses.spouse_nation',$this->roms)
                            ->groupby('coresident_spouses.spouse_nation')
                            ->get();

        // save count of coresidents spouses to table
        foreach ($coresidents_s as $nation) {
          for ($i=1;$i<=$number;$i++){
            $model_nation=$this->find($i);
            if($nation->spouse_nation == $model_nation->name){
              $model_nation->total = $model_nation->total + $nation->count;
              $model_nation->save();
              }
            }
          }

        //Spouses children
        $coresidents_c = DB::table('coresident_children')
                                ->select(DB::raw('coresident_children.child_nation, count(*) as count'))
                                ->whereIn('coresident_children.child_nation',$this->roms)
                                ->groupby('coresident_children.child_nation')
                                ->get();

          // save count of coresidents children to table
          foreach ($coresidents_c as $nation) {
              for ($i=1;$i<=$number;$i++){
                  $model_nation = $this->find($i);
                  if($nation->child_nation == $model_nation->name){
                    $model_nation->total = $model_nation->total + $nation->count;
                    $model_nation->save();
                    }
                }
              }

          $children = DB::table('households')
                        ->join('children','households.id','=','children.household_id')
                        ->select(DB::raw('households.nationality, count(*) as count'))
                        ->whereIn('households.nationality',$this->roms)
                        ->groupby('households.nationality')
                        ->get();

        // save count of children to table
        foreach ($children as $nation)
            {
            for ($i=1;$i<=$number;$i++){
              $model_nation = $this->find($i);
              if($nation->nationality == $model_nation->name){
                $model_nation->total = $model_nation->total + $nation->count;
                $model_nation->save();
                }
              }
            }
      //
    }
}
