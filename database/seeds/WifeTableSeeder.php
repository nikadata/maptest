<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class WifeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('wives')->insert(
        [
        'wife_name'=>'Dumitra',
        'wife_status'=>'Married',
        'wife_age'=>55,
        'wife_gender'=>'Female',
        'household_id'=>1,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]
        );
      DB::table('wives')->insert(
      [
      'wife_name'=>'Dobra',
      'wife_status'=>'Married',
      'wife_age'=>30,
      'wife_gender'=>'Female',
      'household_id'=>2,
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]
      );
      DB::table('wives')->insert(
      [
      'wife_name'=>'Prodana',
      'wife_status'=>'Married',
      'wife_age'=>28,
      'wife_gender'=>'Female',
      'household_id'=>3,
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]
      );
      DB::table('wives')->insert(
      [
      'wife_name'=>'Ioana',
      'wife_status'=>'Married',
      'wife_age'=>28,
      'wife_gender'=>'Female',
      'household_id'=>4,
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]
      );
      DB::table('wives')->insert(
      [
      'wife_name'=>'Dumitrana',
      'wife_status'=>'Married',
      'wife_age'=>18,
      'wife_gender'=>'Female',
      'household_id'=>5,
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]
      );
      DB::table('wives')->insert(
      [
      'wife_name'=>'Ilinca',
      'wife_status'=>'Married',
      'wife_age'=>0,
      'wife_gender'=>'Female',
      'household_id'=>6,
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]
      );
      DB::table('wives')->insert(
      [
      'wife_name'=>'Cârstina',
      'wife_status'=>'Married',
      'wife_age'=>25,
      'wife_gender'=>'Female',
      'household_id'=>7,
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]
      );
      DB::table('wives')->insert(
      [
      'wife_name'=>'Ioana',
      'wife_status'=>'Married',
      'wife_age'=>35,
      'wife_gender'=>'Female',
      'household_id'=>8,
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]
      );
    }
}
