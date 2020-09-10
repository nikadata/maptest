<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ChildTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('children')->insert(
          [
            'child_name'=>'Dinu',
            'child_age'=>5,
            'child_gender'=>'Male',
            'child_place'=>'inhousehold',
            'household_id'=>2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Rada',
            'child_age'=>12,
            'child_gender'=>'Female',
            'child_place'=>'inhousehold',
            'household_id'=>2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Catrina',
            'child_age'=>1,
            'child_gender'=>'Female',
            'child_place'=>'inhousehold',
            'household_id'=>2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Ioana',
            'child_age'=>7,
            'child_gender'=>'Female',
            'child_place'=>'inhousehold',
            'household_id'=>2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Stanciu',
            'child_age'=>5,
            'child_gender'=>'Male',
            'child_place'=>'inhousehold',
            'household_id'=>3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Neaga',
            'child_age'=>7,
            'child_gender'=>'Female',
            'child_place'=>'inhousehold',
            'household_id'=>3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Nița',
            'child_age'=>3,
            'child_gender'=>'Female',
            'child_place'=>'inhousehold',
            'household_id'=>3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Sandu',
            'child_age'=>5,
            'child_gender'=>'Male',
            'child_place'=>'inhousehold',
            'household_id'=>4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Cârstina',
            'child_age'=>7,
            'child_gender'=>'Female',
            'child_place'=>'inhousehold',
            'household_id'=>4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Ilinca',
            'child_age'=>3,
            'child_gender'=>'Female',
            'child_place'=>'inhousehold',
            'household_id'=>4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Marin',
            'child_age'=>1,
            'child_gender'=>'Male',
            'child_place'=>'inhousehold',
            'household_id'=>5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Tudor',
            'child_age'=>12,
            'child_gender'=>'Male',
            'child_place'=>'inhousehold',
            'household_id'=>6,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Maria',
            'child_age'=>8,
            'child_gender'=>'Female',
            'child_place'=>'inhousehold',
            'household_id'=>6,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Rada',
            'child_age'=>6,
            'child_gender'=>'Female',
            'child_place'=>'inhousehold',
            'household_id'=>6,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Stancu',
            'child_age'=>1,
            'child_gender'=>'Male',
            'child_place'=>'inhousehold',
            'household_id'=>7,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Nița',
            'child_age'=>3,
            'child_gender'=>'Female',
            'child_place'=>'inhousehold',
            'household_id'=>7,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Stan',
            'child_age'=>13,
            'child_gender'=>'Male',
            'child_place'=>'inhousehold',
            'household_id'=>8,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Stana',
            'child_age'=>10,
            'child_gender'=>'Female',
            'child_place'=>'inhousehold',
            'household_id'=>8,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('children')->insert(
          [
            'child_name'=>'Maria',
            'child_age'=>8,
            'child_gender'=>'Female',
            'child_place'=>'inhousehold',
            'household_id'=>8,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
    }
}
