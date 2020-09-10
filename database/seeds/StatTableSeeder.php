<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('stats')->insert(
          [
            'household_id'=>1,
            'household_count'=>2,
            'household_land'=>0,
            'household_crops'=>0,
            'householdsum_fruit'=>0,
            'household_livestock'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('stats')->insert(
          [
            'household_id'=>2,
            'household_count'=>6,
            'household_land'=>0,
            'household_crops'=>0,
            'householdsum_fruit'=>0,
            'household_livestock'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('stats')->insert(
          [
            'household_id'=>3,
            'household_count'=>5,
            'household_land'=>0,
            'household_crops'=>0,
            'householdsum_fruit'=>0,
            'household_livestock'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('stats')->insert(
          [
            'household_id'=>4,
            'household_count'=>5,
            'household_land'=>0,
            'household_crops'=>0,
            'householdsum_fruit'=>0,
            'household_livestock'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('stats')->insert(
          [
            'household_id'=>5,
            'household_count'=>3,
            'household_land'=>0,
            'household_crops'=>0,
            'householdsum_fruit'=>0,
            'household_livestock'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('stats')->insert(
          [
            'household_id'=>6,
            'household_count'=>5,
            'household_land'=>0,
            'household_crops'=>0,
            'householdsum_fruit'=>0,
            'household_livestock'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('stats')->insert(
          [
            'household_id'=>7,
            'household_count'=>4,
            'household_land'=>0,
            'household_crops'=>0,
            'householdsum_fruit'=>0,
            'household_livestock'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('stats')->insert(
          [
            'household_id'=>8,
            'household_count'=>5,
            'household_land'=>0,
            'household_crops'=>0,
            'householdsum_fruit'=>0,
            'household_livestock'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
    }
}
