<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class VillageSkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>1,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>2,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>3,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>4,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>5,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>6,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>7,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>8,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>9,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>10,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>11,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>12,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>13,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>14,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>15,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('village_skills')->insert(
          [
            'village_id'=>1,
            'skill_id'=>16,
            'amount'=>0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );

    }
}
