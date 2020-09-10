<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Village;
use App\County;
use App\Church;
use App\Priest;
use App\Deacon;
use App\Singer;
use App\Sexton;
use App\School;
use App\Teacher;
use App\Sdeacon;
use App\Village_stat as Villagestat;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class VillageController extends Controller
{
    //
    public function __construct( Village $village, County $county, Church $church, Villagestat $statical, Priest $priest, Deacon $deacon, Singer $singer, Sexton $sexton, School $school, Teacher $teacher, Sdeacon $sdeacon)
    //public function __construct( Village $village, County $county, Church $church, Villagestat $statical, Priest $priest, Deacon $deacon, Singer $singer, Sexton $sexton, School $school, Teacher $teacher, Sdeacon $sdeacon, Skill $skill, VillageSkill $villskill)
    {
                $this->village = $village;
                $this->church = $church->all();
                $this->priest = $priest->all();
                $this->deacon = $deacon->all();
                $this->singer = $singer->all();
                $this->sexton = $sexton->all();
                $this->school = $school->all();
                $this->teacher = $teacher->all();
                $this->sdeacon = $sdeacon->all();
                $this->village_county = $county->all()->sortBy("county_name");
                $this->statical=$statical->all();
                //$this->skill=$skill->all();
                //$this->villskill=$villskill->all();
    }

    public function index()
    {

      //Get table villages with reference county name

      $villages=[];

      $villages['villages']=DB::table('villages')
            ->join('counties','villages.county_id','=','counties.id')
            ->select('villages.id','villages.village_name', 'counties.county_name','villages.land','villages.fruittrees')
            ->orderBy('villages.id','desc')
          ->limit(10)
            ->get();


        return view('village/vlist', $villages);
    }

    public function search()
    {
        if(request()->ajax())
        {
            //return datatables()->of(Village::latest()->get())
            return datatables()->of(DB::table('villages')
                ->join('counties','villages.county_id','=','counties.id')
                //->join('village_stats', 'villages.id','=','village_stats.village_id')
                //->select('villages.id','villages.village_name', 'counties.county_name','village_stats.rom_households_count','village_stats.roms_count','village_stats.village_land','village_stats.villagesum_fruit',
                //   'village_stats.village_livestock')
                ->select('villages.id','villages.village_name', 'counties.county_name','villages.households','villages.people')
                ->get())
                ->addColumn('action', function($data){
                    $button = '<a class="btn btn-success btn-sm" href="/list/'.$data->id.'">HOUSEHOLDS <i class="fas fa-users"></i></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a class="btn btn-primary btn-sm" href="/village/'.$data->id.'">EDIT <i class="far fa-edit"></i></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a class="btn btn-danger btn-sm" href="/village/del'.$data->id.'"> <i class="far fa-trash-alt"></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('village.index');
    }
    public function testVillage(Request $request, Village $village)
    {
      $st=[];
      $data['skills']=$this->skill;
      $g=$this->skill->count();
      $data['store']=array();
      for($i=0;$i<=$g;$i++){
      $data['store'][$i]=$i;
      $st[]=$i;
      }

      $data['job']=$request->input('job');
      $data['modify']=1;
      return $data;
      return view('village/test',$data);
    }

    public function delVillage($village_id)
    {
      dd('This function is under construction.');
        //Delete specified village from database
      Village::destroy($village_id);
      //Redirect to index
      return redirect('village');
    }

    public function newVillage(Request $request, Village $village, Church $church, Villagestat $village_statical, Priest $priest, Deacon $deacon, Singer $singer, Sexton $sexton, School $school, Teacher $teacher, Sdeacon $sdeacon)
   //public function newVillage(Request $request, Village $village, Church $church, Villagestat $village_statical, Priest $priest, Deacon $deacon, Singer $singer, Sexton $sexton, School $school, Teacher $teacher, Sdeacon $sdeacon, VillageSkill $villskill)
    {
        $data=[];
        $job_string='';
        $churchstats=0; $prieststats=0; $deaconstats=0; $singerstats=0; $sextonstats=0;
        $schoolstats=0; $teacherstats=0; $sdeaconstats=0;

        $data['village_name']=$request->input('village_name');
        $data['comment']=$request->input('comment');
        $data['households']=$request->input('households');
        $data['people']=$request->input('people');
        $data['gypsy']=$request->input('gypsy');
        $data['rudar']=$request->input('rudar');
        $data['romanian']=$request->input('romanian');
        $data['jewish']=$request->input('jewish');
        $data['serbian']=$request->input('serbian');
        $data['armenian']=$request->input('armenian');
        $data['ardelean']=$request->input('ardelean');
        $data['german']=$request->input('german');
        $data['russian']=$request->input('russian');
        $data['turk']=$request->input('turk');
        $data['tax_payer']=$request->input('tax_payer');
        $data['exempt_tax']=$request->input('exempt_tax');
        $data['landowner']=$request->input('landowner');
        $data['renter']=$request->input('renter');
        $data['craftsman']=$request->input('craftsman');
/* Removed 2019-10-18
        //Load all trades/occupations from model
        $data['skills']=$this->skill;
        //Count trades from model
        $g=$this->skill->count();
        //Add default data to trades
        $data['store']=array();
        for($i=0;$i<=$g;$i++){
        $data['store'][$i]=0;
        $st[]=$i;
        }
        //
        $job_data['job']=$request->input('job');
*/
        $data['land']=$request->input('land');
        $data['wheat']=$request->input('wheat');
        $data['corn']=$request->input('corn');
        $data['fennel']=$request->input('fennel');
        $data['barley']=$request->input('barley');
        $data['oats']=$request->input('oats');
        $data['millet']=$request->input('millet');
        $data['horses']=$request->input('horses');
        $data['bulls']=$request->input('bulls');
        $data['cows']=$request->input('cows');
        $data['sheep']=$request->input('sheep');
        $data['goats']=$request->input('goats');
        $data['pigs']=$request->input('pigs');
        $data['buffalos']=$request->input('buffalos');
        $data['donkeys']=$request->input('donkeys');
        $data['mules']=$request->input('mules');
        $data['hives']=$request->input('hives');
        $data['fruittrees']=$request->input('fruittrees');
        $data['plumtrees']=$request->input('plumtrees');
        $data['mulberrytrees']=$request->input('mulberrytrees');
        $data['vineyards']=$request->input('vineyards');
        $data['vineyardopt']=$request->input('vineyardopt');
        $data['apples']=$request->input('apples');
        $data['pears']=$request->input('pears');
        $data['nuts']=$request->input('nuts');
        $data['cherries']=$request->input('cherries');
        $data['sourcherries']=$request->input('sourcherries');
        $data['county_id']=$request->input('village_county_id');
        //Flags
        $data['has_church']=$request->input('has_church');
        $data['has_priest']=$request->input('has_priest');
        $data['has_deacon']=$request->input('has_deacon');
        $data['has_singer']=$request->input('has_singer');
        $data['has_sexton']=$request->input('has_sexton');
        $data['has_school']=$request->input('has_school');
        $data['has_teacher']=$request->input('has_teacher');
        $data['has_sdeacon']=$request->input('has_sdeacon');
        //Time and date
        $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        //churches
        $cdata['name']=$request->input('church_name');
        //priest
        $cdata['priest_name']=$request->input('priest_name');
        //deacon
        $cdata['deacon_name']=$request->input('deacon_name');
        //singer
        $cdata['singer_name']=$request->input('singer_name');
        //sexton
        $cdata['sexton_name']=$request->input('sexton_name');
        //school
        $cdata['school_name']=$request->input('school_name');
        //teacher
        $cdata['teacher_name']=$request->input('teacher_name');
        //deacon
        $cdata['sdeacon_name']=$request->input('sdeacon_name');
        //illness
        $data['physical']=$request->input('physical');
        $data['mental']=$request->input('mental');
        $data['disabilities']=$request->input('disabilities');
        //Flags
        if($data['has_church']==1){
          $data['has_church']=TRUE;

        }
        else {$data['has_church']=FALSE;}

        if($data['has_priest']==1){
          $data['has_priest']=TRUE;

        }
        else {$data['has_priest']=FALSE;}

        if($data['has_deacon']==1){
          $data['has_deacon']=TRUE;

        }
        else {$data['has_deacon']=FALSE;}

        if($data['has_singer']==1){
          $data['has_singer']=TRUE;

        }
        else {$data['has_singer']=FALSE;}

        if($data['has_sexton']==1){
          $data['has_sexton']=TRUE;

        }
        else {$data['has_sexton']=FALSE;}

        if($data['has_school']==1){
          $data['has_school']=TRUE;

        }
        else {$data['has_school']=FALSE;}
        if($data['has_teacher']==1){
          $data['has_teacher']=TRUE;

        }
        else {$data['has_teacher']=FALSE;}
        if($data['has_sdeacon']==1){
          $data['has_sdeacon']=TRUE;

        }
        else {$data['has_sdeacon']=FALSE;}
        //Validate form
        if( $request->isMethod('post') )
        {
          $this->validate(
            $request,
            [
              'village_name'=>'required|min:3',
              'households'=>'required',
              'people'=>'required',
              'vineyardopt'=>'required',
              'village_county_id'=>'required',
            ]
          );
/* Removed 2019-10-18
        unset($data['skills']);
        unset($data['store']);
*/
          $village_id=$village->insertGetId($data);
  /* Removed 2019-10-18
          //Insert trade/occupation data into relational table
          //If skills have been added add a default value

            $trades=$this->skill;
            $i=0;
            foreach($trades as $trade){
                      $skull['village_id']=$village_id;
                      $skull['skill_id']=$trade->id;
                      $skull['amount']=$job_data['job'][$i];
                      $skull['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                      //$skull['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                      $villskill->insert($skull);
                      $i++;
                      }
*/
          //Insert church
          if($data['has_church']==1){
              $n=0;
              $added_church=count($cdata['name']);
              $added_church=$added_church-$n;
              $churchstats=$churchstats+$added_church;
              $y=$n;
              for($x=0;$x<$added_church;$x++){
                $chdata['church_name']=$cdata['name'][$y+$x];
                $chdata['village_id']=$village_id;
                //Time and date
                $chdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                //$chdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $church->insert($chdata);
              }
            }
            //Insert priest
            if($data['has_priest']==1){
                $n=0;
                $added_priest=count($cdata['priest_name']);
                $added_priest=$added_priest-$n;
                $prieststats=$prieststats+$added_priest;
                $y=$n;
                for($x=0;$x<$added_priest;$x++){
                  $dhdata['priest_name']=$cdata['priest_name'][$y+$x];
                  $dhdata['village_id']=$village_id;
                  //Time and date
                  $dhdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                  //$dhdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                  $priest->insert($dhdata);
                }
              }
              //Insert deacon
              if($data['has_deacon']==1){
                  $n=0;
                  $added_deacon=count($cdata['deacon_name']);
                  $added_deacon=$added_deacon-$n;
                  $deaconstats=$deaconstats+$added_deacon;
                  $y=$n;
                  for($x=0;$x<$added_deacon;$x++){
                    $ehdata['deacon_name']=$cdata['deacon_name'][$y+$x];
                    $ehdata['village_id']=$village_id;
                    //Time and date
                    $ehdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                    //$ehdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                    $deacon->insert($ehdata);
                  }
                }
                //Insert singer
                if($data['has_singer']==1){
                    $n=0;
                    $added_singer=count($cdata['singer_name']);
                    $added_singer=$added_singer-$n;
                    $singerstats=$singerstats+$added_singer;
                    $y=$n;
                    for($x=0;$x<$added_singer;$x++){
                      $fhdata['singer_name']=$cdata['singer_name'][$y+$x];
                      $fhdata['village_id']=$village_id;
                      //Time and date
                      $fhdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                      //$fhdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                      $singer->insert($fhdata);
                    }
                  }
                  //Insert sexton
                  if($data['has_sexton']==1){
                      $n=0;
                      $added_sexton=count($cdata['sexton_name']);
                      $added_sexton=$added_sexton-$n;
                      $sextonstats=$sextonstats+$added_sexton;
                      $y=$n;
                      for($x=0;$x<$added_sexton;$x++){
                        $ihdata['sexton_name']=$cdata['sexton_name'][$y+$x];
                        $ihdata['village_id']=$village_id;
                        //Time and date
                        $ihdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                        //$ihdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                        $sexton->insert($ihdata);
                      }
                    }
                    //Insert school
                    if($data['has_school']==1){
                        $n=0;
                        $added_school=count($cdata['school_name']);
                        $added_school=$added_school-$n;
                        $schoolstats=$schoolstats+$added_school;
                        $y=$n;
                        for($x=0;$x<$added_school;$x++){
                          $ghdata['school_name']=$cdata['school_name'][$y+$x];
                          $ghdata['village_id']=$village_id;
                          //Time and date
                          $ghdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                          //$ghdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                          $school->insert($ghdata);
                        }
                      }
                      //Insert teacher
                      if($data['has_teacher']==1){
                          $n=0;
                          $added_teacher=count($cdata['teacher_name']);
                          $added_teacher=$added_teacher-$n;
                          $teacherstats=$teacherstats+$added_teacher;
                          $y=$n;
                          for($x=0;$x<$added_teacher;$x++){
                            $hhdata['teacher_name']=$cdata['teacher_name'][$y+$x];
                            $hhdata['village_id']=$village_id;
                            //Time and date
                            $hhdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                            //$hhdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                            $teacher->insert($hhdata);
                          }
                        }
                        //Insert sdeacon
                        if($data['has_sdeacon']==1){
                            $n=0;
                            $added_sdeacon=count($cdata['sdeacon_name']);
                            $added_sdeacon=$added_sdeacon-$n;
                            $sdeaconstats=$sdeaconstats+$added_sdeacon;
                            $y=$n;
                            for($x=0;$x<$added_sdeacon;$x++){
                              $jhdata['sdeacon_name']=$cdata['sdeacon_name'][$y+$x];
                              $jhdata['village_id']=$village_id;
                              //Time and date
                              $jhdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                              //$jhdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                              $sdeacon->insert($jhdata);
                            }
                          }
            //Calculation household rich/poor factors
            $stats_land=0;
            $stats_land= $data['land'];
            //
            $stats_crops=0;
            $stats_crops+=$data['wheat'];
            $stats_crops+=$data['corn'];
            $stats_crops+=$data['fennel'];
            $stats_crops+=$data['barley'];
            $stats_crops+=$data['oats'];
            $stats_crops+=$data['millet'];
            //
            $stats_fruitsum=0;
            $stats_fruitsum+=$data['fruittrees'];

            //
            $stats_livestock=0;
            $stats_livestock+=$data['horses'];
            $stats_livestock+=$data['bulls'];
            $stats_livestock+=$data['cows'];
            $stats_livestock+=$data['sheep'];
            $stats_livestock+=$data['goats'];
            $stats_livestock+=$data['pigs'];
            $stats_livestock+=$data['buffalos'];
            $stats_livestock+=$data['donkeys'];
            $stats_livestock+=$data['mules'];
            $stats_livestock+=$data['hives'];
            //Add statical data
            $statical_data['village_id']=$village_id;
            $statical_data['village_name']=$data['village_name'];
            $statical_data['church_count']=$churchstats;
            $statical_data['priest_count']=$prieststats;
            $statical_data['deacon_count']=$deaconstats;
            $statical_data['singer_count']=$singerstats;
            $statical_data['sexton_count']=$sextonstats;
            $statical_data['school_count']=$schoolstats;
            $statical_data['teacher_count']=$teacherstats;
            $statical_data['sdeacon_count']=$sdeaconstats;
            $statical_data['village_land']=$stats_land;
            $statical_data['village_crops']=$stats_crops;
            $statical_data['villagesum_fruit']=$stats_fruitsum;
            $statical_data['village_livestock']=$stats_livestock;
            $statical_data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $statical_data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
            //return $statical_data;
            $village_statical->insert($statical_data);

          //Redirect to index
            return redirect('village')->with('status', 'New Village successfully added!');

        }
        //Load village data if not submitted
        $data['villages']=$this->village;
        //Load alla county names from class;
        $data['counties']=$this->village_county;
        $data['modify']=0;
        //Seeding default data in form

        //for Testing
        $data['households']=0;
        $data['people']=0;
        //
        $data['gypsy']=0;
        $data['rudar']=0;
        $data['romanian']=0;
        $data['jewish']=0;
        $data['serbian']=0;
        $data['armenian']=0;
        $data['ardelean']=0;
        $data['german']=0;
        $data['russian']=0;
        $data['turk']=0;
        $data['tax_payer']=0;
        $data['exempt_tax']=0;
        $data['landowner']=0;
        $data['renter']=0;
        $data['craftsman']=0;
        $data['land']=0;
        $data['wheat']=0;
        $data['corn']=0;
        $data['fennel']=0;
        $data['barley']=0;
        $data['oats']=0;
        $data['millet']=0;
        $data['horses']=0;
        $data['bulls']=0;
        $data['cows']=0;
        $data['sheep']=0;
        $data['goats']=0;
        $data['pigs']=0;
        $data['buffalos']=0;
        $data['donkeys']=0;
        $data['mules']=0;
        $data['hives']=0;
        $data['fruittrees']=0;
        $data['plumtrees']=0;
        $data['mulberrytrees']=0;
        $data['vineyards']=0;
        //$data['vineyardopt']=$request->input('vineyardopt');
        $data['apples']=0;
        $data['pears']=0;
        $data['nuts']=0;
        $data['cherries']=0;
        $data['sourcherries']=0;
        $data['physical']=0;
        $data['mental']=0;
        $data['disabilities']=0;
        //return $data; //Testing
        return view('village/form', $data);
    }
//Remove in parameter villageskill?
    public function show($village_id, Request $request)
        //public function show($village_id, Request $request, VillageSkill $villskill)
    {

      //Get village id vaiabel and set the data array
      $data=[]; $data['village_id']=$village_id;
      //Load alla county names from class
      $data['counties']=$this->village_county;
      /* Removed 2019-10-18
      //Load all trades/occupations from model

      $data['skills']=$this->skill;

      $skill_amounts=DB::table('village_skills')
                        ->where('village_id', '=', $village_id)
                        ->select('village_skills.amount')
                        ->get();
      //Define array for form-values
      $data['store']=array();
      //Count skillstable
      $c_skill=$this->skill->count();
      //Count query from VillageSkillstable
      $c_amount=count($skill_amounts);
      //Compare difference
      $c_diff=$c_skill-$c_amount;
      //Set VillageSkill value
      $i=0;
      foreach($skill_amounts as $skill_amount){
        $data['store'][$i]=$skill_amount->amount;
        $i++;
      }
      //If skills have been added add a default value
      if($c_diff>0){
        for($i=$c_amount;$i<$c_skill;$i++){
        $data['store'][$i]=0;
        }
      }

      $data['job']=$request->input('job');

      */
      //Set modify flag to 1
      $data['modify']=1;
      //Testdata for churs and priest
      //$data['church']=0;

      //$data['school']=0;
      //Find village record that = to id
      $village_data=$this->village->find($village_id);
      //Check for churches
      $data['has_church']=$village_data->has_church;
      //Check for priest
      $data['has_priest']=$village_data->has_priest;
      //Check for deacon
      $data['has_deacon']=$village_data->has_deacon;
      //Check for singer
      $data['has_singer']=$village_data->has_singer;
      //Check for sexton
      $data['has_sexton']=$village_data->has_sexton;
      //Check for school
      $data['has_school']=$village_data->has_school;
      //Check for teacher
      $data['has_teacher']=$village_data->has_teacher;
      //Check for sdeacon
      $data['has_sdeacon']=$village_data->has_sdeacon;
      //Check and find churches referens to village
      if($data['has_church']==1){
        $data['churches']=DB::table('churches')
              ->select('churches.*')
              ->where('village_id',$village_id)
              ->get();
            }
      //Check and find priest referens to village
      if($data['has_priest']==1){
          $data['priests']=DB::table('priests')
                    ->select('priests.*')
                    ->where('village_id',$village_id)
                    ->get();
                  }
        //Check and find deacon referens to village
      if($data['has_deacon']==1){
          $data['deacons']=DB::table('deacons')
                    ->select('deacons.*')
                    ->where('village_id',$village_id)
                    ->get();
                  }
        //Check and find singer referens to village
        if($data['has_singer']==1){
          $data['singers']=DB::table('singers')
                      ->select('singers.*')
                      ->where('village_id',$village_id)
                      ->get();
                      }
        //Check and find sexton referens to village
        if($data['has_sexton']==1){
          $data['sextons']=DB::table('sextons')
                      ->select('sextons.*')
                      ->where('village_id',$village_id)
                      ->get();
                    }

                    //Check and find school referens to village
                    if($data['has_school']==1){
                      $data['schools']=DB::table('schools')
                                  ->select('schools.*')
                                  ->where('village_id',$village_id)
                                  ->get();
                                }
                                //Check and find teacher referens to village
                                if($data['has_teacher']==1){
                                  $data['teachers']=DB::table('teachers')
                                              ->select('teachers.*')
                                              ->where('village_id',$village_id)
                                              ->get();
                                            }
                                            //Check and find sdeacon referens to village
                                            if($data['has_sdeacon']==1){
                                              $data['sdeacons']=DB::table('sdeacons')
                                                          ->select('sdeacons.*')
                                                          ->where('village_id',$village_id)
                                                          ->get();
                                                        }
      //Find county id for chososen villages
      $key=$village_data->county_id;
      //Set data array to county key
      $data['village_county_id']=$village_data->county_id;
      //Ser data array to county name
      $data['village_county_name']=County::find($key)->county_name;
      //Set $data array with village attributes
      $data['village_name']=$village_data->village_name;
      $data['comment']=$village_data->comment;
      $data['households']=$village_data->households;
      $data['people']=$village_data->people;
      $data['gypsy']=$village_data->gypsy;
      $data['rudar']=$village_data->rudar;
      $data['romanian']=$village_data->romanian;
      $data['jewish']=$village_data->jewish;
      $data['serbian']=$village_data->serbian;
      $data['armenian']=$village_data->armenian;
      $data['ardelean']=$village_data->ardelean;
      $data['german']=$village_data->german;
      $data['russian']=$village_data->russian;
      $data['turk']=$village_data->turk;
      $data['tax_payer']=$village_data->tax_payer;
      $data['exempt_tax']=$village_data->exempt_tax;
      $data['landowner']=$village_data->landowner;
      $data['renter']=$village_data->renter;
      $data['craftsman']=$village_data->craftsman;
      $data['beartamer']=$village_data->beartamer;
      $data['blacksmith']=$village_data->blacksmith;
      $data['brickmaker']=$village_data->brickmaker;
      $data['coachman']=$village_data->coachman;
      $data['cobzaplayer']=$village_data->cobzaplayer;
      $data['dailylaborer']=$village_data->dailylaborer;
      $data['servant']=$village_data->servant;
      $data['drumplayer']=$village_data->drumplayer;
      $data['farmer']=$village_data->farmer;
      $data['lautar']=$village_data->lautar;
      $data['nurse']=$village_data->nurse;
      $data['ploughman']=$village_data->ploughman;
      $data['spoonmaker']=$village_data->spoonmaker;
      $data['tinsmith']=$village_data->tinsmith;
      $data['violinplayer']=$village_data->violinplayer;
      $data['estatecaretaker']=$village_data->estatecaretaker;
      $data['land']=$village_data->land;
      $data['wheat']=$village_data->wheat;
      $data['corn']=$village_data->corn;
      $data['fennel']=$village_data->fennel;
      $data['barley']=$village_data->barley;
      $data['oats']=$village_data->oats;
      $data['millet']=$village_data->millet;
      $data['horses']=$village_data->horses;
      $data['bulls']=$village_data->bulls;
      $data['cows']=$village_data->cows;
      $data['sheep']=$village_data->sheep;
      $data['goats']=$village_data->goats;
      $data['pigs']=$village_data->pigs;
      $data['buffalos']=$village_data->buffalos;
      $data['donkeys']=$village_data->donkeys;
      $data['mules']=$village_data->mules;
      $data['hives']=$village_data->hives;
      $data['fruittrees']=$village_data->fruittrees;
      $data['plumtrees']=$village_data->plumtrees;
      $data['mulberrytrees']=$village_data->mulberrytrees;
      $data['vineyards']=$village_data->vineyards;
      $data['vineyardopt']=$village_data->vineyardopt;
      $data['apples']=$village_data->apples;
      $data['pears']=$village_data->pears;
      $data['nuts']=$village_data->nuts;
      $data['cherries']=$village_data->cherries;
      $data['sourcherries']=$village_data->sourcherries;
      $data['physical']=$village_data->physical;
      $data['mental']=$village_data->mental;
      $data['disabilities']=$village_data->disabilities;

      /*
      $request->session()->put('last_updated', $village_data->village_id.' '.
      $village_data->villagename);
      */
      //return $data; //Testing output
      return view('village/form', $data);
    }

    public function modify(Request $request, $village_id, Village $village, Church $church, Villagestat $statical, Priest $priest, Deacon $deacon, Singer $singer, Sexton $sexton, School $school, Teacher $teacher, Sdeacon $sdeacon)
   //public function modify(Request $request, $village_id, Village $village, Church $church, Villagestat $statical, Priest $priest, Deacon $deacon, Singer $singer, Sexton $sexton, School $school, Teacher $teacher, Sdeacon $sdeacon, Skill $skill, VillageSkill $villskill)
    {
        $data=[];

        //Get data from form
        $data['village_name']=$request->input('village_name');
        $data['comment']=$request->input('comment');
        $data['households']=$request->input('households');
        $data['people']=$request->input('people');
        $data['gypsy']=$request->input('gypsy');
        $data['rudar']=$request->input('rudar');
        $data['romanian']=$request->input('romanian');
        $data['jewish']=$request->input('jewish');
        $data['serbian']=$request->input('serbian');
        $data['armenian']=$request->input('armenian');
        $data['ardelean']=$request->input('ardelean');
        $data['german']=$request->input('german');
        $data['russian']=$request->input('russian');
        $data['turk']=$request->input('turk');
        $data['tax_payer']=$request->input('tax_payer');
        $data['exempt_tax']=$request->input('exempt_tax');
        $data['landowner']=$request->input('landowner');
        $data['renter']=$request->input('renter');
        $data['craftsman']=$request->input('craftsman');
        //
        $job_data['job']=$request->input('job');

        $data['land']=$request->input('land');
        $data['wheat']=$request->input('wheat');
        $data['corn']=$request->input('corn');
        $data['fennel']=$request->input('fennel');
        $data['barley']=$request->input('barley');
        $data['oats']=$request->input('oats');
        $data['millet']=$request->input('millet');
        $data['horses']=$request->input('horses');
        $data['bulls']=$request->input('bulls');
        $data['cows']=$request->input('cows');
        $data['sheep']=$request->input('sheep');
        $data['goats']=$request->input('goats');
        $data['pigs']=$request->input('pigs');
        $data['buffalos']=$request->input('buffalos');
        $data['donkeys']=$request->input('donkeys');
        $data['mules']=$request->input('mules');
        $data['hives']=$request->input('hives');
        $data['fruittrees']=$request->input('fruittrees');
        $data['plumtrees']=$request->input('plumtrees');
        $data['mulberrytrees']=$request->input('mulberrytrees');
        $data['vineyards']=$request->input('vineyards');
        $data['vineyardopt']=$request->input('vineyardopt');
        $data['apples']=$request->input('apples');
        $data['pears']=$request->input('pears');
        $data['nuts']=$request->input('nuts');
        $data['cherries']=$request->input('cherries');
        $data['sourcherries']=$request->input('sourcherries');
        $data['county_id']=$request->input('village_county_id');
        //Churches
        $data['has_church']=$request->input('has_church');
        $cdata['id']=$request->input('church_id');
        $cdata['name']=$request->input('church_name');
        //Priest
        $data['has_priest']=$request->input('has_priest');
        $cdata['priest_id']=$request->input('priest_id');
        $cdata['priest_name']=$request->input('priest_name');
        //Deacon
        $data['has_deacon']=$request->input('has_deacon');
        $cdata['deacon_id']=$request->input('deacon_id');
        $cdata['deacon_name']=$request->input('deacon_name');
        //singer
        $data['has_singer']=$request->input('has_singer');
        $cdata['singer_id']=$request->input('singer_id');
        $cdata['singer_name']=$request->input('singer_name');
        //sexton
        $data['has_sexton']=$request->input('has_sexton');
        $cdata['sexton_id']=$request->input('sexton_id');
        $cdata['sexton_name']=$request->input('sexton_name');
        //school
        $data['has_school']=$request->input('has_school');
        $cdata['school_id']=$request->input('school_id');
        $cdata['school_name']=$request->input('school_name');
        //teacher
        $data['has_teacher']=$request->input('has_teacher');
        $cdata['teacher_id']=$request->input('teacher_id');
        $cdata['teacher_name']=$request->input('teacher_name');
        //sdeacon
        $data['has_sdeacon']=$request->input('has_sdeacon');
        $cdata['sdeacon_id']=$request->input('sdeacon_id');
        $cdata['sdeacon_name']=$request->input('sdeacon_name');
        //illness
        $data['physical']=$request->input('physical');
        $data['mental']=$request->input('mental');
        $data['disabilities']=$request->input('disabilities');
        //Validate form
        if( $request->isMethod('post') )
        {
          //dd($data);
          $this->validate(
            $request,
            [
              'village_name'=>'required|min:3',
              'village_county_id'=>'required',
              'vineyardopt'=>'required',
            ]
          );
          //Set pointer to selected id
          $village_data=$this->village->find($village_id);

          //Load stats for household
          $statical_data=$statical->find($village_id);

                $stats_key=$statical_data->id;
                $stats=$statical_data->church_count;
                $prieststats=$statical_data->priest_count;
                $deaconstats=$statical_data->deacon_count;
                $singerstats=$statical_data->singer_count;
                $sextonstats=$statical_data->sexton_count;
                $schoolstats=$statical_data->school_count;
                $teacherstats=$statical_data->teacher_count;
                $sdeaconstats=$statical_data->sdeacon_count;

          $statical_data=$this->statical->find($stats_key);
          //
  /* Removed 2019-10-18
          //Save trade/occupation data inte relationa table
          $data['skills']=$this->skill;
          $skill_amounts=DB::table('village_skills')
                            ->where('village_id', '=', $village_id)
                            ->select('village_skills.*')
                            ->get();

          //Count all job from skillstable
          $c_skill=$this->skill->count();

          //Count only jobs in query from VillageSkillstable
          $c_amount=count($skill_amounts);
          //Compare difference
          $c_diff=$c_skill-$c_amount;
*/
          //Updates tabel Village skill for statistic data. To optimize execution time --> comment from here -->
          /*
          //Save value in range
          $x=0;

          foreach ($skill_amounts as $skill_amount){
            $villageskill_data=$this->villskill->find($skill_amount->id);
            $villageskill_data->amount=$job_data['job'][$x];
            $villageskill_data->save();
            $x++;
          }
          */
          // To here <----
/* Removed 2019-10-18
          //If skills have been added add a default value
          if($c_diff>0){
            $trades=$this->skill;
            $y=1;
            $i=$c_amount; //Set $i to number of entered skills
            foreach($trades as $trade){
                    if($y>$c_amount){
                      //
                      $skull['village_id']=$village_id;
                      $skull['skill_id']=$trade->id;
                      $skull['amount']=$job_data['job'][$i];
                      $skull['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                      $skull['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                      $villskill->insert($skull);
                      $i++;
                      }
                        else { $y++; }
                    }


          }
*/

          //Modify data fcted id
          $village_data->village_name=$request->input('village_name');
          $village_data->comment=$request->input('comment');
          $village_data->households=$request->input('households');
          $village_data->people=$request->input('people');
          $village_data->gypsy=$request->input('gypsy');
          $village_data->rudar=$request->input('rudar');
          $village_data->romanian=$request->input('romanian');
          $village_data->jewish=$request->input('jewish');
          $village_data->serbian=$request->input('serbian');
          $village_data->armenian=$request->input('armenian');
          $village_data->ardelean=$request->input('ardelean');
          $village_data->german=$request->input('german');
          $village_data->russian=$request->input('russian');
          $village_data->turk=$request->input('turk');
          $village_data->tax_payer=$request->input('tax_payer');
          $village_data->exempt_tax=$request->input('exempt_tax');
          $village_data->landowner=$request->input('landowner');
          $village_data->renter=$request->input('renter');
          $village_data->craftsman=$request->input('craftsman');

          $village_data->land=$request->input('land');
          $village_data->wheat=$request->input('wheat');
          $village_data->corn=$request->input('corn');
          $village_data->fennel=$request->input('fennel');
          $village_data->barley=$request->input('barley');
          $village_data->oats=$request->input('oats');
          $village_data->millet=$request->input('millet');
          $village_data->horses=$request->input('horses');
          $village_data->bulls=$request->input('bulls');
          $village_data->cows=$request->input('cows');
          $village_data->sheep=$request->input('sheep');
          $village_data->goats=$request->input('goats');
          $village_data->pigs=$request->input('pigs');
          $village_data->buffalos=$request->input('buffalos');
          $village_data->donkeys=$request->input('donkeys');
          $village_data->mules=$request->input('mules');
          $village_data->hives=$request->input('hives');
          $village_data->fruittrees=$request->input('fruittrees');
          $village_data->plumtrees=$request->input('plumtrees');
          $village_data->mulberrytrees=$request->input('mulberrytrees');
          $village_data->vineyards=$request->input('vineyards');
          $village_data->vineyardopt=$request->input('vineyardopt');
          $village_data->apples=$request->input('apples');
          $village_data->pears=$request->input('pears');
          $village_data->nuts=$request->input('nuts');
          $village_data->cherries=$request->input('cherries');
          $village_data->sourcherries=$request->input('sourcherries');
          $village_data->county_id=$request->input('village_county_id');
          $village_data->physical=$request->input('physical');
          $village_data->mental=$request->input('mental');
          $village_data->disabilities=$request->input('disabilities');

          if($data['has_church']==1){
            //If village has churches - update church table
            $village_data->has_church=true;
            if($request->input('add_church')==0){
                //count id elements
                $n=count($cdata['id']);
                //Loop to update each churchitem
                for($i=0;$i<$n;$i++){
                  $church_data=$this->church->find($cdata['id'][$i]);
                  $church_data->church_name=$cdata['name'][$i];
                  $church_data->save();
                  }
                }
            //If village churchdata has been added while edit
            if($request->input('add_church')==1){
              if($request->input('dcount')==0){
                $n=count($cdata['id']);
              }
              else $n=0;
              $added_church=count($cdata['name']);
              $added_church=$added_church-$n;
              $y=$n;
              $stats=$stats+$added_church;
              for($x=0;$x<$added_church;$x++){
                $chdata['church_name']=$cdata['name'][$y+$x];
                $chdata['village_id']=$village_id;
                $chdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $chdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $church->insert($chdata);
              }

            }

          }
          //
          if($data['has_priest']==1){
            //If village has churches - update church table
            $village_data->has_priest=true;
            if($request->input('add_priest')==0){
                //count id elements
                $n=count($cdata['priest_id']);
                //Loop to update each churchitem
                for($i=0;$i<$n;$i++){
                  $priest_data=$this->priest->find($cdata['priest_id'][$i]);
                  $priest_data->priest_name=$cdata['priest_name'][$i];
                  $priest_data->save();
                  }
                }
            //If village churchdata has been added while edit
            if($request->input('add_priest')==1){
              if($request->input('ecount')==0){
                $n=count($cdata['priest_id']);
              }
              else $n=0;
              $added_priest=count($cdata['priest_name']);
              $added_priest=$added_priest-$n;
              $y=$n;
              $prieststats=$prieststats+$added_priest;
              for($x=0;$x<$added_priest;$x++){
                $dhdata['priest_name']=$cdata['priest_name'][$y+$x];
                $dhdata['village_id']=$village_id;
                $dhdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $dhdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $priest->insert($dhdata);
              }

            }

          }
          //
          if($data['has_deacon']==1){
            //If village has churches - update church table
            $village_data->has_deacon=true;
            if($request->input('add_deacon')==0){
                //count id elements
                $n=count($cdata['deacon_id']);
                //Loop to update each churchitem
                for($i=0;$i<$n;$i++){
                  $deacon_data=$this->deacon->find($cdata['deacon_id'][$i]);
                  $deacon_data->deacon_name=$cdata['deacon_name'][$i];
                  $deacon_data->save();
                  }
                }
            //If village churchdata has been added while edit
            if($request->input('add_deacon')==1){
              if($request->input('fcount')==0){
                $n=count($cdata['deacon_id']);
              }
              else $n=0;
              $added_deacon=count($cdata['deacon_name']);
              $added_deacon=$added_deacon-$n;
              $y=$n;
              $deaconstats=$deaconstats+$added_deacon;
              for($x=0;$x<$added_deacon;$x++){
                $ehdata['deacon_name']=$cdata['deacon_name'][$y+$x];
                $ehdata['village_id']=$village_id;
                $ehdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $ehdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $deacon->insert($ehdata);
              }

            }

          }
          //
          if($data['has_singer']==1){
            //If village has churches - update church table
            $village_data->has_singer=true;
            if($request->input('add_singer')==0){
                //count id elements
                $n=count($cdata['singer_id']);
                //Loop to update each churchitem
                for($i=0;$i<$n;$i++){
                  $singer_data=$this->singer->find($cdata['singer_id'][$i]);
                  $singer_data->singer_name=$cdata['singer_name'][$i];
                  $singer_data->save();
                  }
                }
            //If village churchdata has been added while edit
            if($request->input('add_singer')==1){
              if($request->input('gcount')==0){
                $n=count($cdata['singer_id']);
              }
              else $n=0;
              $added_singer=count($cdata['singer_name']);
              $added_singer=$added_singer-$n;
              $y=$n;
              $singerstats=$singerstats+$added_singer;
              for($x=0;$x<$added_singer;$x++){
                $fhdata['singer_name']=$cdata['singer_name'][$y+$x];
                $fhdata['village_id']=$village_id;
                $fhdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $fhdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $singer->insert($fhdata);
              }

            }

          }
          //
          if($data['has_sexton']==1){
            //If village has churches - update church table
            $village_data->has_sexton=true;
            if($request->input('add_sexton')==0){
                //count id elements
                $n=count($cdata['sexton_id']);
                //Loop to update each churchitem
                for($i=0;$i<$n;$i++){
                  $sexton_data=$this->sexton->find($cdata['sexton_id'][$i]);
                  $sexton_data->sexton_name=$cdata['sexton_name'][$i];
                  $sexton_data->save();
                  }
                }
            //If village churchdata has been added while edit
            if($request->input('add_sexton')==1){
              if($request->input('hcount')==0){
                $n=count($cdata['sexton_id']);
              }
              else $n=0;
              $added_sexton=count($cdata['sexton_name']);
              $added_sexton=$added_sexton-$n;
              $y=$n;
              $sextonstats=$sextonstats+$added_sexton;
              for($x=0;$x<$added_sexton;$x++){
                $ihdata['sexton_name']=$cdata['sexton_name'][$y+$x];
                $ihdata['village_id']=$village_id;
                $ihdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $ihdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $sexton->insert($ihdata);
              }

            }

          }
          //
          if($data['has_school']==1){
            //If village has churches - update church table
            $village_data->has_school=true;
            if($request->input('add_school')==0){
                //count id elements
                $n=count($cdata['school_id']);
                //Loop to update each churchitem
                for($i=0;$i<$n;$i++){
                  $school_data=$this->school->find($cdata['school_id'][$i]);
                  $school_data->school_name=$cdata['school_name'][$i];
                  $school_data->save();
                  }
                }
            //If village churchdata has been added while edit
            if($request->input('add_school')==1){
              if($request->input('icount')==0){
                $n=count($cdata['school_id']);
              }
              else $n=0;
              $added_school=count($cdata['school_name']);
              $added_school=$added_school-$n;
              $y=$n;
              $schoolstats=$schoolstats+$added_school;
              for($x=0;$x<$added_school;$x++){
                $ghdata['school_name']=$cdata['school_name'][$y+$x];
                $ghdata['village_id']=$village_id;
                $ghdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $ghdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $school->insert($ghdata);
              }

            }

          }
          //
          if($data['has_teacher']==1){
            //If village has churches - update church table
            $village_data->has_teacher=true;
            if($request->input('add_teacher')==0){
                //count id elements
                $n=count($cdata['teacher_id']);
                //Loop to update each churchitem
                for($i=0;$i<$n;$i++){
                  $teacher_data=$this->teacher->find($cdata['teacher_id'][$i]);
                  $teacher_data->teacher_name=$cdata['teacher_name'][$i];
                  $teacher_data->save();
                  }
                }
            //If village churchdata has been added while edit
            if($request->input('add_teacher')==1){
              if($request->input('jcount')==0){
                $n=count($cdata['teacher_id']);
              }
              else $n=0;
              $added_teacher=count($cdata['teacher_name']);
              $added_teacher=$added_teacher-$n;
              $y=$n;
              $teacherstats=$teacherstats+$added_teacher;
              for($x=0;$x<$added_teacher;$x++){
                $hhdata['teacher_name']=$cdata['teacher_name'][$y+$x];
                $hhdata['village_id']=$village_id;
                $hhdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $hhdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $teacher->insert($hhdata);
              }

            }

          }
          //
          if($data['has_sdeacon']==1){
            //If village has churches - update church table
            $village_data->has_sdeacon=true;
            if($request->input('add_sdeacon')==0){
                //count id elements
                $n=count($cdata['sdeacon_id']);
                //Loop to update each churchitem
                for($i=0;$i<$n;$i++){
                  $sdeacon_data=$this->sdeacon->find($cdata['sdeacon_id'][$i]);
                  $sdeacon_data->sdeacon_name=$cdata['sdeacon_name'][$i];
                  $sdeacon_data->save();
                  }
                }
            //If village churchdata has been added while edit
            if($request->input('add_sdeacon')==1){
              if($request->input('kcount')==0){
                $n=count($cdata['sdeacon_id']);
              }
              else $n=0;
              $added_sdeacon=count($cdata['sdeacon_name']);
              $added_sdeacon=$added_sdeacon-$n;
              $y=$n;
              $sdeaconstats=$sdeaconstats+$added_sdeacon;
              for($x=0;$x<$added_sdeacon;$x++){
                $jhdata['sdeacon_name']=$cdata['sdeacon_name'][$y+$x];
                $jhdata['village_id']=$village_id;
                $jhdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $jhdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $sdeacon->insert($jhdata);
              }

            }

          }
          //return $village_data;

          $village_data->save();
          //Calculation household rich/poor factors
          $stats_land=0;
          $stats_land= $data['land'];
          //
          $stats_crops=0;
          $stats_crops+=$data['wheat'];
          $stats_crops+=$data['corn'];
          $stats_crops+=$data['fennel'];
          $stats_crops+=$data['barley'];
          $stats_crops+=$data['oats'];
          $stats_crops+=$data['millet'];
          //
          $stats_fruitsum=0;
          $stats_fruitsum+=$data['fruittrees'];
          /*
          $stats_fruitsum+=$data['plumtrees'];
          $stats_fruitsum+=$data['mulberrytrees'];
          $stats_fruitsum+=$data['apples'];
          $stats_fruitsum+=$data['pears'];
          $stats_fruitsum+=$data['nuts'];
          $stats_fruitsum+=$data['cherries'];
          $stats_fruitsum+=$data['sourcherries'];
          */
          //
          $stats_livestock=0;
          $stats_livestock+=$data['horses'];
          $stats_livestock+=$data['bulls'];
          $stats_livestock+=$data['cows'];
          $stats_livestock+=$data['sheep'];
          $stats_livestock+=$data['goats'];
          $stats_livestock+=$data['pigs'];
          $stats_livestock+=$data['buffalos'];
          $stats_livestock+=$data['donkeys'];
          $stats_livestock+=$data['mules'];
          $stats_livestock+=$data['hives'];
          //Save modified statical data
          $statical_data->village_name = $village_data->village_name;
          $statical_data->church_count=$stats;
          $statical_data->priest_count=$prieststats;
          $statical_data->deacon_count=$deaconstats;
          $statical_data->singer_count=$singerstats;
          $statical_data->sexton_count=$sextonstats;
          $statical_data->school_count=$schoolstats;
          $statical_data->teacher_count=$teacherstats;
          $statical_data->sdeacon_count=$sdeaconstats;
          $statical_data->village_land=$stats_land;
          $statical_data->village_crops=$stats_crops;
          $statical_data->villagesum_fruit=$stats_fruitsum;
          $statical_data->village_livestock=$stats_livestock;
          $statical_data->save();
          //$data['modify']=0;
            return redirect('village')->with('status', 'Village successfully updated!');

        }
        $data['villages']=$this->village;
        $data['modify']=0;
        //return $data;
        //return view('village/form', $data);
    }


}
