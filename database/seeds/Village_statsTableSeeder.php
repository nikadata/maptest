<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class Village_statsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('village_stats')->insert(
          [
            'village_id'=>1,
            'church_count'=>0,
            'priest_count'=>0,
            'deacon_count'=>0,
            'singer_count'=>0,
            'sexton_count'=>0,
            'school_count'=>0,
            'teacher_count'=>0,
            'sdeacon_count'=>0,
            'village_land'=>0,
            'village_crops'=>0,
            'villagesum_fruit'=>0,
            'village_livestock'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
    }
}
