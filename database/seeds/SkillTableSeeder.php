<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('skills')->insert(
          [
            'skill_name'=>'Bear tamer',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Blacksmith',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Brickmaker',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Coachman',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Cobza player',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Daily laborer',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Domestic/servant',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Drum player',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Farmer',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Lăutar',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Nurse',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Ploughman',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Spoon maker',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Tinsmith',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Violin player',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('skills')->insert(
          [
            'skill_name'=>'Estate caretaker',
            'skill_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
    }
}
