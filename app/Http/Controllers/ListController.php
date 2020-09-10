<?php

namespace App\Http\Controllers;
use App\Village;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //
    public function __construct( Village $village)
    {
                $this->village = $village;

    }
    public function list($village_id)
    {
      $data=[];

        //$data['households']=$this->household->all();
        $data['households']=DB::table('households')
              ->join('villages','households.village_id','=','villages.id')
              ->join('village_stats','households.village_id','=','village_stats.id')
              ->join('social_classes','households.socialclass_id','=','social_classes.id')
              ->join('skills','households.skill_id','=','skills.id')
              ->join('extendeds','households.extended_id','=','extendeds.id')
              ->join('stats', 'households.id','=','stats.household_id')
              ->select('households.*', 'villages.village_name','social_classes.social_name','skills.skill_name','extendeds.type','stats.*','village_stats.*')
              ->where('households.village_id','=',$village_id)
              ->orderBy('households.number')
              ->get();

        return view('village/list',$data);
    }
}
