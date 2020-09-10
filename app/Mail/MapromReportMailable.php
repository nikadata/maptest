<?php

namespace App\Mail;

use App\Child as Child;
use App\Coresident as Coresident;
use App\CoresidentChild as Coresident_child;
use App\CoresidentSpouse as Coresident_spouse;
use App\Country as Country;
use App\County as County;
use App\District as District;
use App\DistrictStats as DistrictStats;
use App\Household as Household;
use App\Services\StatsCounter;
use App\Skill\Skill as Skill;
use App\SocialClass as Social;
use App\Source as Source;
use App\Stat as Stat;
use App\Village as Village;
use App\Wife as Wife;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class MapromReportMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $households, $romans, $romstotal, $country_records, $district_records, $county_records, $village_records;
    public $social_records, $skill_records, $source_records, $village_roms, $village_nroms, $ext_stats, $single_stats;
    public $avg, $avg_max, $avg_min, $youngest, $oldest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($households, $romans, $romstotal, $country_records, $district_records, $county_records, $village_records,
$social_records, $skill_records, $source_records, $village_roms, $village_nroms, $ext_stats, $single_stats, $avg, $avg_max, $avg_min, $youngest, $oldest)
    {
        $this->households = $households;
        $this->romans = $romans;
        $this->romstotal = $romstotal;
        $this->country_records = $country_records;
        $this->district_records = $district_records;
        $this->county_records = $county_records;
        $this->village_records = $village_records;
        $this->social_records = $social_records;
        $this->skill_records = $skill_records;
        $this->source_records = $source_records;
        $this->village_roms = $village_roms;
        $this->village_nroms = $village_nroms;
        $this->ext_stats = $ext_stats;
        $this->single_stats = $single_stats;
        $this->avg = $avg;
        $this->avg_max = $avg_max;
        $this->avg_min = $avg_min;
        $this->youngest = $youngest;
        $this->oldest = $oldest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.daily');
    }
}
