<?php

namespace App\Console\Commands;

use App\Child as Child;
use App\Coresident as Coresident;
use App\CoresidentChild as Coresident_child;
use App\CoresidentSpouse as Coresident_spouse;
use App\Country as Country;
use App\County as County;
use App\District as District;
use App\DistrictStats as DistrictStats;
use App\Household as Household;
use App\Skill\Skill as Skill;
use App\SocialClass as Social;
use App\Source as Source;
use App\Stat as Stat;
use App\Village as Village;
use App\Wife as Wife;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Services\StatsCounter;
//use App\Mail\SendMailable;
use App\Mail\MapromReportMailable;
use App\Village_stat as Villagestat;


class RegisteredUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registered:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email of registered users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Villagestat $village_stat)
    {
        parent::__construct();
        $this->roms = app(StatsCounter::class)->getRoms(); //Roms attribute from service container
        $this->village_stat = $village_stat->all();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Request $request, StatsCounter $statscounter)
    {
        //Db data
        $roms = $this->roms;
        $household_records = Household::count();
        $romans = DB::table('households')
            ->whereIn('households.nationality',$roms)
            ->count();
        //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
        $romstotal = DB::table('nations')->sum('total');
        $country_records = Country::count();
        $district_records = District::count();
        $county_records = County::count();
        $village_records = Village::count();
        $social_records = Social::count();
        $skill_records = Skill::count();
        $source_records = Source::count();
        //$total = Household::count()+Child::count()+Coresident::count()+Coresident_spouse::count()+Coresident_child::count()+Wife::count();

        //Village data
        $villageStats = new Villagestat;
        $village_roms = $villageStats->getVillagesRoms();
        $village_nroms = $villageStats->getVillagesWithoutRoms();

        $single_rom = DistrictStats::sum('single_roms_household');
        $extended_rom = DistrictStats::sum('extended_roms_household');
        $ext_stats = round(($extended_rom/$romans)*100,2);
        $single_stats = round(($single_rom/$romans)*100,2);

        $stats = new Stat;
        //Average householdssize
        $avg = $stats->avgHouseholdSize();
        //Range of householdssize - Maxsize
        $avg_max = $stats->avgMaxHouseholdsSize();
        //Range of householdssize - Minsize
        $avg_min = $stats->avgMinHouseholdsSize();

        $youngest = $statscounter->getYoungest();

        $oldest = $statscounter->getOldest();

        // Old

      $data['roms'] = $this->roms;
      $totalUsers = \DB::table('users')
               //->whereRaw('Date(created_at) = CURDATE()')
               ->count();
               /*
      $totalH=\DB::table('households')
                ->count();
                */
      $totalH = DB::table('households')
                  ->whereIn('households.nationality',$roms)
                  ->count();
      $romstotal = DB::table('nations')->sum('total');
      //Mail::to('ryan.dias@sh.se')->send(new SendMailable($totalUsers,$totalH,$romstotal));
      //Mail::to('ryan@dias.se')->send(new SendMailable($totalUsers,$totalH,$romstotal));
      //Mail::to('julieta.rotaru@sh.se')->send(new SendMailable($totalUsers,$totalH,$romstotal));
      //Mail::to('david.gaunt@sh.se')->send(new SendMailable($totalUsers,$totalH,$romstotal));

        Mail::to('ryan@dias.se')->send(new MapromReportMailable($household_records, $romans, $romstotal, $country_records,
        $district_records, $county_records, $village_records, $social_records,$skill_records, $source_records, $village_roms,
        $village_nroms, $ext_stats, $single_stats, $avg, $avg_max, $avg_min, $youngest, $oldest));
/*
        Mail::to('ryan.dias@sh.se')->send(new MapromReportMailable($household_records, $romans, $romstotal, $country_records,
            $district_records, $county_records, $village_records, $social_records,$skill_records, $source_records, $village_roms,
            $village_nroms, $ext_stats, $single_stats, $avg, $avg_max, $avg_min, $youngest, $oldest));
    */
        Mail::to('julieta.rotaru@sh.se')->send(new MapromReportMailable($household_records, $romans, $romstotal, $country_records,
            $district_records, $county_records, $village_records, $social_records,$skill_records, $source_records, $village_roms,
            $village_nroms, $ext_stats, $single_stats, $avg, $avg_max, $avg_min, $youngest, $oldest));

        Mail::to('david.gaunt@sh.se')->send(new MapromReportMailable($household_records, $romans, $romstotal, $country_records,
            $district_records, $county_records, $village_records, $social_records,$skill_records, $source_records, $village_roms,
            $village_nroms, $ext_stats, $single_stats, $avg, $avg_max, $avg_min, $youngest, $oldest));

    }
}
