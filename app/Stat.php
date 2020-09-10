<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Services\StatsCounter;

class Stat extends Model
{
    public function __construct()
    {
      $this->roms = app(StatsCounter::class)->getRoms(); //Roms attribute from service container

    }

    public function household()
    {
      return $this->belongsTo(Household::class);

    }

    public function removeOneHouseholdCount($household_id)
    {
        dd($household_data=$this->stat->find($household_id));
    }

    public function avgMinHouseholdsSize()
    {
      $avgMinHouseholdsSize = 0;
      $stats_min = DB::table('stats')
                      ->join('households','stats.household_id','=','households.id')
                      ->select(DB::raw('min(household_count) as min'))
                      ->whereIn('households.nationality',$this->roms)
                      ->get();
      foreach($stats_min as $stat)
        {
           $avgMinHouseholdsSize = round($stat->min,2);
        }
      return $avgMinHouseholdsSize;
    }

    public function avgMaxHouseholdsSize()
    {
      $avgMaxHouseholdsSize = 0;
      //The range of average households size
      $stats_max = DB::table('stats')
                        ->join('households','stats.household_id','=','households.id')
                        ->select(DB::raw('max(household_count) as max'))
                        ->whereIn('households.nationality',$this->roms)
                        ->get();
      foreach($stats_max as $stat)
        {
           $avgMaxHouseholdsSize = round($stat->max,2);
        }
      return $avgMaxHouseholdsSize;
    }

    public function avgHouseholdSize()
    {
      $avgHouseholdsSize = 0;
      //The average household size
      $stats = DB::table('stats')
                        ->join('households','stats.household_id','=','households.id')
                        ->select(DB::raw('avg(household_count) as avg'))
                        ->whereIn('households.nationality',$this->roms)
                        ->get();
      foreach($stats as $stat)
        {
          $avgHouseholdsSize = round($stat->avg,1);
        }
      return $avgHouseholdsSize;
    }
}
