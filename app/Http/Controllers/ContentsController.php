<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StatsCounter;
use App\Household as Household;
use App\Country as Country;
use App\District as District;
use App\County as County;
use App\Village as Village;
use App\Village_stat as Villagestat;
use App\SocialClass as Social;
use App\Skill\Skill as Skill;
use App\NationStats as NationStats;
use App\Nationality as Nationality;
use App\Nation as Nation;
use App\Source as Source;
use App\Child as Child;
use App\Wife as Wife;
use App\Coresident as Coresident;
use App\CoresidentSpouse as Coresident_spouse;
use App\CoresidentChild as Coresident_child;
use App\User as User;
use App\Role as Role;
use App\Stat as Stat;
use Carbon\Carbon;

class ContentsController extends Controller
{
    public function __construct(Nationality $nationality, Villagestat $village_stat,NationStats $nation_stats, Nation $nation)
      {
      $this->nationality = $nationality->all();
      $this->village_stat = $village_stat->all();
      $this->nations_stats = $nation_stats;
      $this->nation = $nation;
      }
    public function list()
    {
        $data['households']=Household::latest()->take(10)->get();
        return view('contents.list', $data);
    }

    public function search()
    {
        if(request()->ajax())
        {
            return datatables()->of(Household::latest()->get())
                ->addColumn('action', function($data){
                    $button = '<a href="/household_detail/'.$data->id.'" class="btn btn-outline-success btn-sm"><i class="fas fa-eye"></i></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="/households/'.$data->id.'" class="btn btn-outline-primary btn-sm"><i class="far fa-edit"></i></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a class="btn btn-danger btn-sm" href="/del/'.$data->id.'"><i class="far fa-trash-alt"></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('contents.search');
    }

    public function index()
    {
      $data=[];
      $data['users']=User::all();
      return view('tools/admin', $data);
    }

    public function postAdminAssignRoles(Request $request)
    {
      $user = User::where('email', $request['email'])->first();
      $user->roles()->detach();
      if($request['role_user']){
        $user->roles()->attach(Role::where('name','User')->first());
      }
      if($request['role_admin']){
        $user->roles()->attach(Role::where('name','Admin')->first());
      }
      return redirect()->back();
    }

    public function load()
    {
        return view('contents/index');
    }

    public function home(Request $request, StatsCounter $statscounter)
    {
        $data=[];
        //Get version from StatsCounter
        $data['version'] = $statscounter->version;

        $now = Carbon::now();
        //Reset nations stats
        //$statscounter->NationsReset();
        //Count stats and store in db
        $nation = new Nation;
        $nation->NationsReset();
        $nation->UpdateNation();

        //Oldest Youngest

        $roms = $statscounter->getRoms();

        $data['youngest'] = $statscounter->getYoungest();

        $data['oldest'] = $statscounter->getOldest();

        //
        //Total Households
        $data['household_records'] = Household::count();
        //Total Romani Households
        $data['roms'] = $statscounter->countRomHouseholds();
        //Total Roms
        $data['romstotal'] = $nation->TotalRoms();
        //Countries
        $data['country_records']=Country::count();
        //Districs
        $data['district_records']=District::count();
        //Counties
        $data['county_records']=County::count();
        //Villages
        $data['village_records']=Village::count();
        //Social classes
        $data['social_records']=Social::count();
        //Skills
        $data['skill_records']=Skill::count();
        //Sources
        $data['source_records']=Source::count();
        //Total number of persons
        $data['total']=Household::count()+Child::count()+Coresident::count()+Coresident_spouse::count()+Coresident_child::count()+Wife::count();
        //Update Village Statistics
        $villageStats = new Villagestat;
        $villageStats->VillageStatReset();
        $villageStats->updateRomHouseholds();
        //Villages with Rom population
        $data['village_roms'] = $villageStats->getVillagesRoms();
        //Villages without Rom population
        $data['village_nroms'] = $villageStats->getVillagesWithoutRoms();

        return view('contents/home', $data);
    }


    public function dbseed()
    {
      //Test seeder for entering 1000 households in database
      for($i=0;$i<1000;$i++){
          $households = factory(Household::class)->create([
            'number'=> 70+$i
          ]);
          $stats=factory(Stat::class)->create([
            'household_id'=>9+$i
          ]);
        }


    return redirect('households');
    }
}
