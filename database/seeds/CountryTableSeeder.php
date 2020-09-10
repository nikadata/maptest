<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('countries')->insert(
          [
            'country_name'=>'Wallachia',
            'country_population'=>0,
            'country_description'=>'16 districts',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        /*
        DB::table('countries')->insert(
          [
            'country_name'=>'Sweden',
            'country_population'=>9000000,
            'country_description'=>'Nordic country',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('countries')->insert(
          [
            'country_name'=>'Norway',
            'country_population'=>8000000,
            'country_description'=>'Nordic Country',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('countries')->insert(
          [
            'country_name'=>'Denmark',
            'country_population'=>9500000,
            'country_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        */
    }
}
