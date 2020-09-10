<?php

namespace App\Http\Controllers;

use App\CoresidentChild;
use Illuminate\Http\Request;
use App\Title as Title;
use App\Nationality as Nationality;
use App\Gender as Gender;
use App\Familyline as Familyline;
use App\Fiscal as Fiscal;
use App\Illness as Illness;
use App\Household as Household;
use App\Wife as Wife;
use App\Child as Child;
use App\Coresident as Coresident;
use App\CoresidentSpouse as Coresident_spouse;
use App\CoresidentChild as Coresident_child;
use App\Village as Village;
use App\SocialClass as Social;
use App\Skill\Skill as Skill;
use App\Source as Source;
use App\Extended as Extended;
use App\Stat as Stat;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HouseholdController extends Controller
{
    //
    public function __construct( Title $titles, Nationality $nations, Gender $genderattrs, Familyline $familyline, Wife $wives, Fiscal $fiscalvalues, Illness $illness,Village $villages, Social $socials, Skill $skills, Source $sources, Extended $extendeds, Household $household, Child $children, Stat $statical, Coresident $coresidents,
    Coresident_spouse $coresident_spouses, Coresident_child $coresident_children )
    {
        $this->titles = $titles->all();
        $this->nations=$nations->all();
        $this->genders=$genderattrs->all();
        $this->familyline=$familyline->all();
        $this->fiscalvalues=$fiscalvalues->all();
        $this->illness=$illness->all();
        $this->villages = $villages->all()->sortBy("village_name");
        $this->socials = $socials->all()->sortBy("social_name");
        $this->skills = $skills->all()->sortBy("skill_name");
        $this->sources = $sources->all();
        $this->extendeds = $extendeds->all();
        $this->children = $children->all();
        $this->coresidents = $coresidents->all();
        $this->coresident_spouses = $coresident_spouses->all();
        $this->coresident_children = $coresident_children->all();
        $this->wives = $wives->all();
        $this->statical=$statical->all();
        $this->household = $household->all();
    }
    public function delHousehold($household_id)
    {

        //Household object
        $household = Household::findOrFail($household_id);

        //Delete stats object
        $stats = Stat::where('household_id', $household_id)->get();
        $statobj = $stats->filter(function($item) {
            return $item->id;
        })->first();
        //Delete specified stats from database
        Stat::destroy($statobj->id);
        //Delete Wife
        if ($household->wife == 1)
        {
            //Delete Wife object
            $wife = Wife::where('household_id', $household_id)->get();
            $wifeobj = $wife->filter(function($item) {
                return $item->id;
            })->first();
            //Delete specified stats from database
            Wife::destroy($wifeobj->id);
        }

        //Delete Children
        if ($household->children == 1)
        {
            //Delete Children objects
            $count = Child::where('household_id', $household_id)->count();
            $children = Child::where('household_id', $household_id)->get();
            for($i=0;$i<$count;$i++) {
                $childobj = $children->filter(function ($item) {
                    return $item->id;
                })->first();
                //Delete specified stats from database
                Child::destroy($childobj->id);
            }
        }
        //Delete Coresidents Children
        if ($household->coresident_child == 1) {
            $count = CoresidentChild::where('household_id', $household_id)->count();
            $co_children = CoresidentChild::where('household_id', $household_id)->get();
            for($i=0;$i<$count;$i++) {
                $co_childobj = $co_children->filter(function ($item) {
                    return $item->id;
                })->first();
                //Delete specified stats from database
                CoresidentChild::destroy($co_childobj->id);
            }
        }
        //Delete Coresidents Spouse

        //Delete Coresidents
        if ($household->coresident == 1)
        {
            //Delete Coresident object
            $coresident = Coresident::where('household_id', $household_id)->get();
            $coresidentobj = $coresident->filter(function($item) {
                return $item->id;
            })->first();
            //Delete specified stats from database
            Coresident::destroy($coresidentobj->id);
        }

        Household::destroy($household_id);
        return redirect()->back()->with('status', 'Household successfully deleted!');;
    }
    public function lock()
    {

      return view('household/lock');
    }

    public function index()
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
              ->orderBy('households.number')
              ->get();

        return view('household/index',$data);
    }
    public function detail($household_id, Request $request)
    {
      $data=[];

        //$data['households']=$this->household->all();
        $data['households']=DB::table('households')
              ->join('villages','households.village_id','=','villages.id')
              ->join('social_classes','households.socialclass_id','=','social_classes.id')
              ->join('skills','households.skill_id','=','skills.id')
              ->join('extendeds','households.extended_id','=','extendeds.id')
              ->join('stats', 'households.id','=','stats.household_id')
              ->select('households.*', 'villages.village_name','social_classes.social_name','skills.skill_name','extendeds.type','stats.household_count')
              ->where('households.id','=',$household_id)
              ->orderBy('households.number')
              ->get();
        //Get the specified houshold
        $household_data=$this->household->find($household_id);
        //Check if household has a wife/partner
        if($household_data->wife==1){
          $data['wifes']=DB::table('wives')
              ->select('wives.*')
              ->where('household_id','=',$household_id)
              ->get();
        }
        //Check if household has children, if yes then load children data
        if($household_data->children==1){
          $data['childrens']=DB::table('children')
              ->select('children.*')
              ->where('household_id','=',$household_id)
              ->get();
        }
        //Extended family type
        $key=$household_data->extended_id;
        $data['extended']=$this->extendeds->find($key);
        //Check if household has coresidents, if yes then load coresidents data
        if($household_data->coresident==1){
          $data['coresidents']=DB::table('coresidents')
              ->select('coresidents.*')
              ->where('household_id','=',$household_id)
              ->get();
        }
        if($household_data->coresident_spouse==1){
          $data['coresident_spouses']=DB::table('coresident_spouses')
              ->select('coresident_spouses.*')
              ->where('household_id','=',$household_id)
              ->get();
        }
        if($household_data->coresident_child==1){
          $data['coresident_children']=DB::table('coresident_children')
              ->select('coresident_children.*')
              ->where('household_id','=',$household_id)
              ->get();
        }
        //return $data;
        return view('household/detail',$data);
    }
    public function tableindex()
    {
      $data=[];

        //$data['households']=$this->household->all();
        $data['households']=DB::table('households')
              ->join('villages','households.village_id','=','villages.id')
              ->join('social_classes','households.socialclass_id','=','social_classes.id')
              ->join('skills','households.skill_id','=','skills.id')
              ->join('extendeds','households.extended_id','=','extendeds.id')
              ->join('stats', 'households.id','=','stats.household_id')
              ->select('households.*', 'villages.village_name','social_classes.social_name','skills.skill_name','extendeds.type','stats.household_count')
              ->orderBy('households.number')
              ->get();

        return view('household/table',$data);
    }
    //Export method is disabled in this version
    public function export()
    {
      $data=[];
      $now=Carbon::now();
        //$data['households']=$this->household->all();
        $data['households']=DB::table('households')
              ->join('villages','households.village_id','=','villages.id')
              ->join('social_classes','households.socialclass_id','=','social_classes.id')
              ->join('skills','households.skill_id','=','skills.id')
              ->join('sources','households.source_id','=','sources.id')
              ->select('households.*', 'villages.village_name','social_classes.social_name','skills.skill_name','sources.source_name')
              ->orderBy('households.number', 'asc')
              ->get();
          $data['today']=$now;
        header('Content-Disposition: attachment;filename=export_'.$data['today'].'.xls');
        return view('household/export',$data);
    }

    public function newHousehold(Request $request, Household $household, Wife $wives, Child $children, Coresident $coresidents, Coresident_spouse $coresident_spouses,Coresident_child $coresident_children, Stat $statical)
    {
        //Defining arrays and variables used
        $data=[]; $cdata=[]; $rdata=[]; $spdata=[]; $rcdata=[]; $stats=0;
        //Requesting data from form
        $data['number']=$request->input('number');
        $data['name']=$request->input('name');
        $data['fname']=$request->input('fname');
        $data['surname']=$request->input('surname');
        $data['nickname']=$request->input('nickname');
        $data['gender']=$request->input('gen');
        $data['family']=$request->input('family');
        $data['age']=$request->input('age');
        $data['civilstatus']=$request->input('civilstatus');
        //Wife
        $data['wife']=$request->input('wife');
        $wdata['wife_name']=$request->input('wife_name');
        $wdata['wife_gender']=$request->input('wife_gender');
        $wdata['wife_age']=$request->input('wife_age');
        $wdata['wife_nation']=$request->input('wife_nation');
        //
        $data['fiscalcomment']=$request->input('fiscalcomment');
        $data['extended_id']=$request->input('extended');
        $data['nationality']=$request->input('nationality');
        $data['fiscal']=$request->input('fiscal');
        $data['village_id']=$request->input('village');
        $data['socialclass_id']=$request->input('socialclass');
        $data['skill_id']=$request->input('skill');
        $data['second_skill_id']=$request->input('second_skill');
        $data['source_id']=$request->input('source');
        $data['illness']=$request->input('ill');
        $data['servant']=$request->input('servant');
        $data['land']=$request->input('clandn');
        $data['diagnosis']=$request->input('diagnosis');
        $data['inf_diagnosis']=$request->input('inf_diagnosis');
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
        $data['children']=$request->input('has_children');
        $data['coresident']=$request->input('has_resident');
        $data['coresident_spouse']=$request->input('resident_has_spouse');
        $data['coresident_child']=$request->input('resident_has_child');
        $data['comment']=$request->input('comment');
        //Linked flag set to FALSE
        $data['linked']=FALSE;
        $cdata['name']=$request->input('child_name');
        $cdata['age']=$request->input('child_age');
        $cdata['gender']=$request->input('child_gender');
        //$cdata['place']=$request->input('child_place');
        //coresidents
        $rdata['cat']=$request->input('resident_cat');
        $rdata['name']=$request->input('resident_name');
        $rdata['gender']=$request->input('resident_gender');
        $rdata['age']=$request->input('resident_age');
        $rdata['civil']=$request->input('resident_civil');
        $rdata['nation']=$request->input('resident_nation');
        $rdata['class']=$request->input('resident_class');
        $rdata['job']=$request->input('resident_job');
        $rdata['second_job']=$request->input('resident_second_job');
        $rdata['fiscal']=$request->input('resident_fiscal');
        $rdata['illness']=$request->input('resident_illness');
        $rdata['diagnosis_formal']=$request->input('resident_diagnosis_formal');
        $rdata['diagnosis_informal']=$request->input('resident_diagnosis_informal');
        //coresidents_spouses
        $spdata['name']=$request->input('spouse_name');
        $spdata['gender']=$request->input('spouse_gender');
        $spdata['age']=$request->input('spouse_age');
        $spdata['nation']=$request->input('spouse_nation');
        $spdata['job']=$request->input('spouse_job');
        $spdata['illness']=$request->input('spouse_illness');
        $spdata['diagnosis_formal']=$request->input('spouse_diagnosis_formal');
        $spdata['diagnosis_informal']=$request->input('spouse_diagnosis_informal');
        //coresidents_children
        $rcdata['name']=$request->input('resident_child_name');
        $rcdata['gender']=$request->input('resident_child_gender');
        $rcdata['age']=$request->input('resident_child_age');
        $rcdata['nation']=$request->input('resident_child_nation');
        $rcdata['illness']=$request->input('resident_child_illness');
        $rcdata['diagnosis_formal'] = $request->input('resident_child_diagnosis_formal');
        $rcdata['diagnosis_informal'] = $request->input('resident_child_diagnosis_informal');
        //Setting Time and date timestamps
        $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $wdata['created_at']=\Carbon\Carbon::now()->toDateTimeString();
        $wdata['updated_at']=\Carbon\Carbon::now()->toDateTimeString();
        $cdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $cdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        //Flags
        if($data['wife']==1){
          $data['wife']=TRUE;
          $stats++; //Add wife
        }
        else {$data['wife']=FALSE;}
        if($data['children']==1){
          $data['children']=TRUE;
        }
        if($data['coresident']==1){
          $data['coresident']=TRUE;
        }
        if($data['coresident_spouse']==1){
          $data['coresident_spouse']=TRUE;
        }
        if($data['coresident_child']==1){
          $data['coresident_child']=TRUE;
        }
        if( $request->isMethod('post') )
        {
          //dd($data);
          $this->validate(
            $request,
            [
              'number'=>'required',
              'name'=>'required|min:3',
              'fname'=>'required',
              'age'=>'required',
              'nationality'=>'required',
              'fiscal'=>'required',
              'civilstatus'=>'required',

            ]
          );
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

          $stats++; //Add household count
          $household_id=$household->insertGetId($data);

          //Insert wife
          if($data['wife']==1){
            $wifedata['wife_name']=$wdata['wife_name'];
            $wifedata['wife_status']=$data['civilstatus'];
            $wifedata['wife_gender']=$wdata['wife_gender'];
            $wifedata['wife_age']=$wdata['wife_age'];
            $wifedata['wife_nation']=$wdata['wife_nation'];
            $wifedata['household_id']=$household_id;
            //Time and date
            $wifedata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $wifedata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $wives->insert($wifedata);
          }
          //Insert children
          if($data['children']==1){
              $n=0;
              $added_children=count($cdata['name']);
              $added_children=$added_children-$n;
              $stats=$stats+$added_children;
              $y=$n;
              for($x=0;$x<$added_children;$x++){
                $chdata['child_name']=$cdata['name'][$y+$x];
                $chdata['child_age']=$cdata['age'][$y+$x];
                $chdata['child_gender']=$cdata['gender'][$y+$x];
                //$chdata['child_place']=$cdata['place'][$y+$x];
                $chdata['household_id']=$household_id;
                //Time and date
                $chdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $chdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $children->insert($chdata);
              }
        }
        //Insert coresidents
        if($data['coresident']==1){
            $n=0;
            $added_residents=count($rdata['name']);
            $added_residents=$added_residents-$n;
            $stats=$stats+$added_residents;
            $y=$n;
            for($x=0;$x<$added_residents;$x++){
              $rhdata['resident_cat']=$rdata['cat'][$y+$x];
              $rhdata['resident_name']=$rdata['name'][$y+$x];
              $rhdata['resident_gender']=$rdata['gender'][$y+$x];
              $rhdata['resident_age']=$rdata['age'][$y+$x];
              $rhdata['resident_civil']=$rdata['civil'][$y+$x];
              $rhdata['resident_nation']=$rdata['nation'][$y+$x];
              $rhdata['resident_class']=$rdata['class'][$y+$x];
              $rhdata['resident_job']=$rdata['job'][$y+$x];
              $rhdata['resident_second_job']=$rdata['second_job'][$y+$x];
              $rhdata['resident_fiscal']=$rdata['fiscal'][$y+$x];
              $rhdata['resident_illness']=$rdata['illness'][$y+$x];
              $rhdata['resident_diagnosis_formal'] = $rdata['diagnosis_formal'][$y+$x];
              $rhdata['resident_diagnosis_informal'] = $rdata['diagnosis_informal'][$y+$x];
              $rhdata['household_id']=$household_id;
              //Time and date
              $rhdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
              $rhdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
              //$coresidents->insert($rhdata);
              $coresident_id=$coresidents->insertGetId($rhdata);
            }
      }

      //Insert coresident_spouses
      if($data['coresident_spouse']==1){
          $n=0;
          $added_resident_spouses=count($spdata['name']);
          $added_resident_spouses=$added_resident_spouses-$n;
          $stats=$stats+$added_resident_spouses;
          $y=$n;
          for($x=0;$x<$added_resident_spouses;$x++){
            $spousedata['spouse_name']=$spdata['name'][$y+$x];
            $spousedata['spouse_age']=$spdata['age'][$y+$x];
            $spousedata['spouse_gender']=$spdata['gender'][$y+$x];
            $spousedata['spouse_nation']=$spdata['nation'][$y+$x];
            $spousedata['spouse_job']=$spdata['job'][$y+$x];
            $spousedata['spouse_illness']=$spdata['illness'][$y+$x];
              $spousedata['spouse_diagnosis_formal']=$spdata['diagnosis_formal'][$y+$x];
              $spousedata['spouse_diagnosis_informal']=$spdata['diagnosis_informal'][$y+$x];
            $spousedata['household_id']=$household_id;
            $spousedata['coresident_id']=$coresident_id;
            //Time and date
            $spousedata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $spousedata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $coresident_spouses->insert($spousedata);
          }
    }
    //Insert coresident_children
    if($data['coresident_child']==1){
        $n=0;
        $added_resident_children=count($rcdata['name']);
        $added_resident_children=$added_resident_children-$n;
        $stats=$stats+$added_resident_children;
        $y=$n;
        for($x=0;$x<$added_resident_children;$x++){
          $rchilddata['child_name']=$rcdata['name'][$y+$x];
          $rchilddata['child_age']=$rcdata['age'][$y+$x];
          $rchilddata['child_gender']=$rcdata['gender'][$y+$x];
          $rchilddata['child_nation']=$rcdata['nation'][$y+$x];
          $rchilddata['child_illness']=$rcdata['illness'][$y+$x];
            $rchilddata['child_diagnosis_formal']=$rcdata['diagnosis_formal'][$y+$x];
            $rchilddata['child_diagnosis_informal']=$rcdata['diagnosis_informal'][$y+$x];
          $rchilddata['household_id']=$household_id;
          $rchilddata['coresident_id']=$coresident_id;
          //Time and date
          $rchilddata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
          $rchilddata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
          $coresident_children->insert($rchilddata);
        }
  }
        //Add statical data
        $statical_data['household_id']=$household_id;
        $statical_data['household_count']=$stats;
        $statical_data['household_land']=$stats_land;
        $statical_data['household_crops']=$stats_crops;
        $statical_data['householdsum_fruit']=$stats_fruitsum;
        $statical_data['household_livestock']=$stats_livestock;
        $statical_data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $statical_data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        //return $statical_data;
        $statical->insert($statical_data);

          //return redirect('households');
            //return redirect('/');
            return redirect('/')->with('status', 'New household successfully added!');
        }
        //If not posted default values
        $data['titles']=$this->titles;
        $data['nations']=$this->nations;
        $data['genders']=$this->genders;
        $data['familys']=$this->familyline;
        $data['fiscalvalues']=$this->fiscalvalues;
        $data['illnes']=$this->illness;
        $data['villages']=$this->villages;
        $data['socials']=$this->socials;
        $data['skills']=$this->skills;
        /*$data['skills']=Skill::orderByRaw(
     "CASE WHEN skill_name LIKE 'N%' THEN 1 ELSE 2 END");
      */
        $data['sources']=$this->sources;
        $data['extendeds']=$this->extendeds;
        $data['clandn']=0;
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
        $data['pears']=0;
        $data['nuts']=0;
        $data['cherries']=0;
        $data['sourcherries']=0;
        $data['plumtrees']=0;
        $data['mulberrytrees']=0;
        $data['vineyards']=0;
        $data['vineyardopt']='None';
        $data['apples']=0;
        $data['pears']=0;
        $data['nuts']=0;
        $data['cherries']=0;
        $data['sourcherries']=0;

        $data['has_children']=FALSE;
        $data['coresident']=FALSE;
        $data['wife']=FALSE;
        $data['civstatus']=0;
        $data['modify']=0;

        return view('household/form', $data);
    }
    //This function is disabled in this version
    public function create()
    {
            return view('household/create');
    }

    // SHOW
    public function show($household_id, Request $request)
    {
      $data=[]; $data['household_id']=$household_id;

      $data['titles']=$this->titles;
      $data['nations']=$this->nations;
      $data['genders']=$this->genders;
      $data['familys']=$this->familyline;
      $data['fiscalvalues']=$this->fiscalvalues;
      $data['illnes']=$this->illness;
      $data['villages']=$this->villages;
      $data['socials']=$this->socials;
      $data['skills']=$this->skills;
      $data['sources']=$this->sources;
      $data['childrens']=$this->children;
      $data['coresidents']=$this->coresidents;
      $data['coresident_spouses']=$this->coresident_spouses;
      $data['coresident_children']=$this->coresident_children;
      $data['extendeds']=$this->extendeds;

      $data['modify']=1;
      $household_data=$this->household->find($household_id);
      $data['number']=$household_data->number;
      $data['name']=$household_data->name;
      $data['fname']=$household_data->fname;
      $data['surname']=$household_data->surname;
      $data['nickname']=$household_data->nickname;
      $data['gen']=$household_data->gender;
      $data['family']=$household_data->family;
      $data['age']=$household_data->age;
      $data['civilstatus']=$household_data->civilstatus;
      $data['wife']=$household_data->wife;
      $data['has_children']=$household_data->children;
      $data['coresident']=$household_data->coresident;
      $data['coresident_spouse']=$household_data->coresident_spouse;
      $data['coresident_child']=$household_data->coresident_child;
      $data['nationality']=$household_data->nationality;
      $data['fiscal']=$household_data->fiscal;
      $data['village_id']=$household_data->village_id;
      $data['social_id']=$household_data->socialclass_id;
      $data['skill_id']=$household_data->skill_id;
      $data['second_skill_id']=$household_data->second_skill_id;
      $data['source_id']=$household_data->source_id;
      //Added extended
      $data['extended_id']=$household_data->extended_id;
      //
      $data['fiscalcomment']=$household_data->fiscalcomment;
      $data['ill']=$household_data->illness;
      $data['servant']=$household_data->servant;
      $data['clandn']=$household_data->land;
      $data['diagnosis']=$household_data->diagnosis;
      $data['inf_diagnosis']=$household_data->inf_diagnosis;
      $data['wheat']=$household_data->wheat;
      $data['corn']=$household_data->corn;
      $data['fennel']=$household_data->fennel;
      $data['barley']=$household_data->barley;
      $data['oats']=$household_data->oats;
      $data['millet']=$household_data->millet;
      $data['horses']=$household_data->horses;
      $data['bulls']=$household_data->bulls;
      $data['cows']=$household_data->cows;
      $data['sheep']=$household_data->sheep;
      $data['goats']=$household_data->goats;
      $data['pigs']=$household_data->pigs;
      $data['buffalos']=$household_data->buffalos;
      $data['donkeys']=$household_data->donkeys;
      $data['mules']=$household_data->mules;
      $data['hives']=$household_data->hives;
      $data['fruittrees']=$household_data->fruittrees;
      $data['plumtrees']=$household_data->plumtrees;
      $data['mulberrytrees']=$household_data->mulberrytrees;
      $data['vineyards']=$household_data->vineyards;
      $data['vineyardopt']=$household_data->vineyardopt;
      $data['apples']=$household_data->apples;
      $data['pears']=$household_data->pears;
      $data['nuts']=$household_data->nuts;
      $data['cherries']=$household_data->cherries;
      $data['sourcherries']=$household_data->sourcherries;
      $data['comment']=$household_data->comment;
      //

      $key=$data['village_id'];
      $data['village']=$this->villages->find($key);

      $key=$data['social_id'];
      $data['social']=$this->socials->find($key);

      $key=$data['skill_id'];
      $data['skill']=$this->skills->find($key);
      //Second skills
      $key=$data['second_skill_id'];
      $data['second_skill']=$this->skills->find($key);

      $key=$data['source_id'];
      $data['source']=$this->sources->find($key);

      $key=$data['extended_id'];
      $data['extended']=$this->extendeds->find($key);
      //Check if household is married or unmarried with wife
      if ($data['civilstatus']=='Married' || $data['wife']==1){
          $data['civstatus']=1;
          }
          else {$data['civstatus']=0;}

      //Check and find wife referens to houshold
          if($data['wife']==1){
            $data['wifes']=DB::table('wives')
                  ->select('wives.*')
                  ->where('household_id',$household_id)
                  ->get();

          }
          else {

          }
          //return $data;

      //Check and find children referens to houshold
      if($data['has_children']==1){
        $data['childrens']=DB::table('children')
              ->select('children.*')
              ->where('household_id',$household_id)
              ->get();
            }

      //Check and find coresidents referens to houshold
      if($data['coresident']==1){
        $data['coresidents']=DB::table('coresidents')
              ->select('coresidents.*')
              ->where('household_id',$household_id)
              ->get();
            }
            else $data['coresident']=0;

      return view('household/form', $data);
    }

    //Edit household with form
    public function modify(Request $request, $household_id, Household $household, Child $children, Coresident $coresidents, Wife $wives, Stat $statical, Coresident_spouse $coresident_spouses, Coresident_child $coresident_children)
    {
      //Define arrays and variables used
        $data=[]; $stats=0;
      //Request data from form
        $data['number']=$request->input('number');
        $data['name']=$request->input('name');
        $data['fname']=$request->input('fname');
        $data['surname']=$request->input('surname');
        $data['nickname']=$request->input('nickname');
        $data['gen']=$request->input('gen');
        $data['family']=$request->input('family');
        $data['age']=$request->input('age');
        $data['civilstatus']=$request->input('civilstatus');
        //Wife
        $data['wife']=$request->input('wife');
        $wdata['wife_name']=$request->input('wife_name');
        $wdata['wife_gender']=$request->input('wife_gender');
        $wdata['wife_age']=$request->input('wife_age');
        $wdata['wife_nation']=$request->input('wife_nation');
        //
        $data['nationality']=$request->input('nationality');
        $data['extended_id']=$request->input('extended');
        $data['fiscal']=$request->input('fiscal');
        $data['village_id']=$request->input('village');
        $data['fiscalcomment']=$request->input('fiscalcomment');
        $data['ill']=$request->input('ill');
        $data['servant']=$request->input('servant');
        $data['land']=$request->input('clandn');
        $data['diagnosis']=$request->input('diagnosis');
        $data['inf_diagnosis']=$request->input('inf_diagnosis');
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
        $data['comment']=$request->input('comment');
        //Children
        $data['has_children']=$request->input('has_children');
        $cdata['id']=$request->input('child_id');
        $cdata['name']=$request->input('child_name');
        $cdata['age']=$request->input('child_age');
        $cdata['gender']=$request->input('child_gender');
        //$cdata['place']=$request->input('child_place');
        //Coresidents
        $data['coresident']=$request->input('has_resident');
        $rdata['id']=$request->input('resident_id');
        $rdata['cat']=$request->input('resident_cat');
        $rdata['name']=$request->input('resident_name');
        $rdata['gender']=$request->input('resident_gender');
        $rdata['age']=$request->input('resident_age');
        $rdata['civil']=$request->input('resident_civil');
        $rdata['nation']=$request->input('resident_nation');
        $rdata['class']=$request->input('resident_class');
        $rdata['job']=$request->input('resident_job');
        $rdata['second_job']=$request->input('resident_second_job');
        $rdata['fiscal']=$request->input('resident_fiscal');
        $rdata['illness']=$request->input('resident_illness');
        $rdata['diagnosis_formal'] = $request->input('resident_diagnosis_formal');
        $rdata['diagnosis_informal'] = $request->input('resident_diagnosis_informal');
        //Coresident_spouses
        $data['coresident_spouse']=$request->input('resident_has_spouse');
        $spdata['id']=$request->input('spouse_id');
        $spdata['name']=$request->input('spouse_name');
        $spdata['gender']=$request->input('spouse_gender');
        $spdata['age']=$request->input('spouse_age');
        $spdata['nation']=$request->input('spouse_nation');
        $spdata['job']=$request->input('spouse_job');
        $spdata['illness']=$request->input('spouse_illness');
        $spdata['diagnosis_formal']=$request->input('spouse_diagnosis_formal');
        $spdata['diagnosis_informal']=$request->input('spouse_diagnosis_informal');
        //Coresident_children
        $data['coresident_child']=$request->input('resident_has_child');
        $rcdata['id']=$request->input('resident_child_id');
        $rcdata['name']=$request->input('resident_child_name');
        $rcdata['gender']=$request->input('resident_child_gender');
        $rcdata['age']=$request->input('resident_child_age');
        $rcdata['nation']=$request->input('resident_child_nation');
        $rcdata['illness']=$request->input('resident_child_illness');
        $rcdata['diagnosis_formal']=$request->input('resident_child_diagnosis_formal');
        $rcdata['diagnosis_informal']=$request->input('resident_child_diagnosis_informal');

        if( $request->isMethod('post') )
        {
          //dd($data);

          $this->validate(
            $request,
            [
              'number'=>'required',
              'name'=>'required|min:3',
              'fname'=>'required',
              'gen'=>'required',
              'age'=>'required',
              'nationality'=>'required',
              'fiscal'=>'required',

            ]
          );
          //Load Household data
          $household_data=$this->household->find($household_id);
          //Load stats for household
          $statical_data=DB::table('stats')
                ->select('stats.*')
                ->where('household_id',$household_id)
                ->get();

          foreach($statical_data as $st){
            $stats_key=$st->id;
            $stats=$st->household_count;
          }
          $statical_data=$this->statical->find($stats_key);

          //Set new household data
          $household_data->number=$request->input('number');
          $household_data->name=$request->input('name');
          $household_data->fname=$request->input('fname');
          $household_data->surname=$request->input('surname');
          $household_data->nickname=$request->input('nickname');
          $household_data->gender=$request->input('gen');
          $household_data->family=$request->input('family');
          $household_data->age=$request->input('age');
          $household_data->civilstatus=$request->input('civilstatus');
          //Check for wife
          if($data['wife']==1){
          $household_data->wife=true;
          if($request->input('add_wife')==0){
            $key=$request->input('wife_id');
            $wife_data=$this->wives->find($key);
            $wife_data->wife_name=$wdata['wife_name'];
            $wife_data->wife_status=$data['civilstatus'];
            $wife_data->wife_gender= $wdata['wife_gender'];
            $wife_data->wife_age=$wdata['wife_age'];
            $wife_data->wife_nation= $wdata['wife_nation'];
            //return $wife_data;
            $wife_data->save();
            }
          if($request->input('add_wife')==1){
            $wifedata['wife_name']=$wdata['wife_name'];
            $wifedata['wife_status']=$data['civilstatus']; //Assumes husband and wife has same civilstatus
            $wifedata['wife_gender']=$wdata['wife_gender'];
            $wifedata['wife_age']=$wdata['wife_age'];
            $wifedata['wife_nation']=$wdata['wife_nation'];
            $wifedata['household_id']=$household_id;
            $wifedata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $wifedata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $wives->insert($wifedata);
            $stats++;
          }
        }
          //Check for children, read childrens data
          if($data['has_children']==1){
            //If household has children - update child table
            $household_data->children=true;
            if($request->input('add_flag')==0){
                //count id elements
                $n=count($cdata['id']);
                //Loop to update each childitem
                for($i=0;$i<$n;$i++){
                  $child_data=$this->children->find($cdata['id'][$i]);
                  $child_data->child_name=$cdata['name'][$i];
                  $child_data->child_age=$cdata['age'][$i];
                  $child_data->child_gender=$cdata['gender'][$i];
                  //$child_data->child_place=$cdata['place'][$i];
                  $child_data->save();
                  }
                }
            //If household childdata has been added while edit
            if($request->input('add_flag')==1){
              if($request->input('dcount')==0){
                $n=count($cdata['id']);
              }
              else $n=0;
              $added_children=count($cdata['name']);
              $added_children=$added_children-$n;
              $y=$n;
              $stats=$stats+$added_children;
              for($x=0;$x<$added_children;$x++){
                $chdata['child_name']=$cdata['name'][$y+$x];
                $chdata['child_age']=$cdata['age'][$y+$x];
                $chdata['child_gender']=$cdata['gender'][$y+$x];
                //$chdata['child_place']=$cdata['place'][$y+$x];
                $chdata['household_id']=$household_id;
                $chdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $chdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $children->insert($chdata);
              }

            }

          }
          //Check for coresidents, read residents data
          if($data['coresident']==1){
            //If household has coresidents - update coresident table
            $household_data->coresident=true;
            if($request->input('add_resident')==0){
                //count id elements
                $n=count($rdata['id']);
                //Loop to update each childitem
                for($i=0;$i<$n;$i++){
                  $resident_data=$this->coresidents->find($rdata['id'][$i]);
                  $resident_data->resident_cat=$rdata['cat'][$i];
                  $resident_data->resident_name=$rdata['name'][$i];
                  $resident_data->resident_gender=$rdata['gender'][$i];
                  $resident_data->resident_age=$rdata['age'][$i];
                  $resident_data->resident_civil=$rdata['civil'][$i];
                  $resident_data->resident_nation=$rdata['nation'][$i];
                  $resident_data->resident_class=$rdata['class'][$i];
                  $resident_data->resident_job=$rdata['job'][$i];
                  $resident_data->resident_second_job=$rdata['second_job'][$i];
                  $resident_data->resident_fiscal=$rdata['fiscal'][$i];
                  $resident_data->resident_illness=$rdata['illness'][$i];
                  $resident_data->resident_diagnosis_formal = $rdata['diagnosis_formal'][$i];
                  $resident_data->resident_diagnosis_informal = $rdata['diagnosis_informal'][$i];
                  $resident_data->save();
                  }
                }
            //If household residentdata has been added while edit
            if($request->input('add_resident')==1){
              if($request->input('residentcount')==0){
                $n=count($rdata['id']);
              }
              else $n=0;
              $added_residents=count($rdata['name']);
              $added_residents=$added_residents-$n;
              $y=$n;
              $stats=$stats+$added_residents;
              for($x=0;$x<$added_residents;$x++){
                $rhdata['resident_cat']=$rdata['cat'][$y+$x];
                $rhdata['resident_name']=$rdata['name'][$y+$x];
                $rhdata['resident_gender']=$rdata['gender'][$y+$x];
                $rhdata['resident_age']=$rdata['age'][$y+$x];
                $rhdata['resident_civil']=$rdata['civil'][$y+$x];
                $rhdata['resident_nation']=$rdata['nation'][$y+$x];
                $rhdata['resident_class']=$rdata['class'][$y+$x];
                $rhdata['resident_job']=$rdata['job'][$y+$x];
                $rhdata['resident_second_job']=$rdata['second_job'][$y+$x];
                $rhdata['resident_fiscal']=$rdata['fiscal'][$y+$x];
                $rhdata['resident_illness']=$rdata['illness'][$y+$x];
                $rhdata['resident_diagnosis_formal'] = $rdata['diagnosis_formal'][$y+$x];
                $rhdata['resident_diagnosis_informal'] = $rdata['diagnosis_informal'][$y+$x];
                $rhdata['household_id']=$household_id;
                $rhdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $rhdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                //$coresidents->insert($rhdata);
                $coresident_id=$coresidents->insertGetId($rhdata);
              }

            }

          }

          //Check for coresident_spouses, read spouse data
          if($data['coresident_spouse']==1){
            //If household has coresident_spouse - update coresident_spouse table
            $household_data->coresident_spouse=true;
            if($request->input('resident_add_spouse')==0){
                //count id elements
                $n=count($spdata['id']);
                //Loop to update each item
                for($i=0;$i<$n;$i++){
                  $spouse_data=$this->coresident_spouses->find($spdata['id'][$i]);
                  $spouse_data->spouse_name=$spdata['name'][$i];
                  $spouse_data->spouse_gender=$spdata['gender'][$i];
                  $spouse_data->spouse_age=$spdata['age'][$i];
                  $spouse_data->spouse_nation=$spdata['nation'][$i];
                  $spouse_data->spouse_job=$spdata['job'][$i];
                  $spouse_data->spouse_illness=$spdata['illness'][$i];
                    $spouse_data->spouse_diagnosis_formal=$spdata['diagnosis_formal'][$i];
                    $spouse_data->spouse_diagnosis_informal=$spdata['diagnosis_informal'][$i];
                  $spouse_data->save();
                  }
                }
            //If household residentdata has been added while edit
            if($request->input('resident_add_spouse')==1){
              if($request->input('spousecount')==0){
                //return $spdata;
                $n=count($spdata['id']);
              }
              else $n=0;
              $added_spouses=count($spdata['name']);
              $added_spouses=$added_spouses-$n;
              $y=$n;
              $stats=$stats+$added_spouses;
              for($x=0;$x<$added_spouses;$x++){
                $spousedata['spouse_name']=$spdata['name'][$y+$x];
                $spousedata['spouse_gender']=$spdata['gender'][$y+$x];
                $spousedata['spouse_age']=$spdata['age'][$y+$x];
                $spousedata['spouse_nation']=$spdata['nation'][$y+$x];
                $spousedata['spouse_job']=$spdata['job'][$y+$x];
                $spousedata['spouse_illness']=$spdata['illness'][$y+$x];
                  $spousedata['spouse_diagnosis_formal']=$spdata['diagnosis_formal'][$y+$x];
                  $spousedata['spouse_diagnosis_informal']=$spdata['diagnosis_informal'][$y+$x];
                $spousedata['household_id']=$household_id;
                $spousedata['coresident_id']=$coresident_id;
                $spousedata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $spousedata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $coresident_spouses->insert($spousedata);
              }

            }

          }
          //->
          //Check for coresident_children, read child data
          if($data['coresident_child']==1){
            //If household has coresident_child - update coresident_child table
            $household_data->coresident_child=true;
            if($request->input('resident_add_child')==0){
                //count id elements
                $n=count($rcdata['id']);
                //Loop to update each item
                for($i=0;$i<$n;$i++){
                  $resident_child_data=$this->coresident_children->find($rcdata['id'][$i]);
                  $resident_child_data->child_name=$rcdata['name'][$i];
                  $resident_child_data->child_gender=$rcdata['gender'][$i];
                  $resident_child_data->child_age=$rcdata['age'][$i];
                  $resident_child_data->child_nation=$rcdata['nation'][$i];
                  $resident_child_data->child_illness=$rcdata['illness'][$i];
                    $resident_child_data->child_diagnosis_formal=$rcdata['diagnosis_formal'][$i];
                    $resident_child_data->child_diagnosis_informal=$rcdata['diagnosis_informal'][$i];
                  $resident_child_data->save();
                  }
                }
            //If household residentdata has been added while edit
            if($request->input('resident_add_child')==1){
              if($request->input('childcount')==0){
                $n=count($spdata['id']);
              }
              else $n=0;
              $added_childs=count($rcdata['name']);
              $added_childs=$added_childs-$n;
              $y=$n;
              $stats=$stats+$added_childs;
              for($x=0;$x<$added_childs;$x++){
                $resident_childdata['child_name']=$rcdata['name'][$y+$x];
                $resident_childdata['child_gender']=$rcdata['gender'][$y+$x];
                $resident_childdata['child_age']=$rcdata['age'][$y+$x];
                $resident_childdata['child_nation']=$rcdata['nation'][$y+$x];
                $resident_childdata['child_illness']=$rcdata['illness'][$y+$x];
                  $resident_childdata['child_diagnosis_formal']=$rcdata['diagnosis_formal'][$y+$x];
                  $resident_childdata['child_diagnosis_informal']=$rcdata['diagnosis_informal'][$y+$x];
                $resident_childdata['household_id']=$household_id;
                $resident_childdata['coresident_id']=$coresident_id;
                $resident_childdata['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $resident_childdata['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $coresident_children->insert($resident_childdata);
              }

            }

          }

          //
          $household_data->fiscalcomment=$request->input('fiscalcomment');
          $household_data->extended_id=$request->input('extended');
          $household_data->nationality=$request->input('nationality');
          $household_data->fiscal=$request->input('fiscal');
          $household_data->socialclass_id=$request->input('socialclass');
          $household_data->skill_id=$request->input('skill');
          $household_data->second_skill_id=$request->input('second_skill');
          $household_data->land=$request->input('clandn');
          $household_data->diagnosis=$request->input('diagnosis');
          $household_data->inf_diagnosis=$request->input('inf_diagnosis');
          $household_data->wheat=$request->input('wheat');
          $household_data->corn=$request->input('corn');
          $household_data->fennel=$request->input('fennel');
          $household_data->barley=$request->input('barley');
          $household_data->oats=$request->input('oats');
          $household_data->millet=$request->input('millet');
          $household_data->illness=$request->input('ill');
          $household_data->servant=$request->input('servant');
          $household_data->horses=$request->input('horses');
          $household_data->bulls=$request->input('bulls');
          $household_data->cows=$request->input('cows');
          $household_data->sheep=$request->input('sheep');
          $household_data->goats=$request->input('goats');
          $household_data->pigs=$request->input('pigs');
          $household_data->buffalos=$request->input('buffalos');
          $household_data->donkeys=$request->input('donkeys');
          $household_data->mules=$request->input('mules');
          $household_data->hives=$request->input('hives');
          $household_data->fruittrees=$request->input('fruittrees');
          $household_data->plumtrees=$request->input('plumtrees');
          $household_data->Mulberrytrees=$request->input('mulberrytrees');
          $household_data->vineyards=$request->input('vineyards');
          $household_data->vineyardopt=$request->input('vineyardopt');
          $household_data->apples=$request->input('apples');
          $household_data->pears=$request->input('pears');
          $household_data->nuts=$request->input('nuts');
          $household_data->cherries=$request->input('cherries');
          $household_data->sourcherries=$request->input('sourcherries');
          $household_data->village_id=$request->input('village');
          $household_data->source_id=$request->input('source');
          $household_data->comment=$request->input('comment');
          //save $household_data;
          $household_data->save();
          //Save modified statical data
          $statical_data->household_count=$stats;
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

          $statical_data->household_land=$stats_land;
          $statical_data->household_crops=$stats_crops;
          $statical_data->householdsum_fruit=$stats_fruitsum;
          $statical_data->household_livestock=$stats_livestock;
          $statical_data->save();

          //return redirect('households');
            return redirect('/')->with('status', 'Household successfully edited!');


        }
        $data['titles']=$this->titles;
        $data['nations']=$this->nations;
        $data['genders']=$this->genders;
        $data['familys']=$this->familyline;
        $data['fiscalvalues']=$this->fiscalvalues;
        $data['illnes']=$this->illness;
        $data['modify']=0;


        return view('household/form', $data);
    }


}
