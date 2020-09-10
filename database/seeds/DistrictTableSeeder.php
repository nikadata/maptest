<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('districts')->insert(
          [
            'district_name'=>'Argeș',
            'district_description'=>'Pitești',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Brăila',
            'district_description'=>'Brăila',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Buzău',
            'district_description'=>'Buzău',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Dâmbovița',
            'district_description'=>'None',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Dolj',
            'district_description'=>'Craiova',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Ialomița',
            'district_description'=>'None',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Ilfov',
            'district_description'=>'None',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Mehedinț',
            'district_description'=>'Cerneți',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Mușcel',
            'district_description'=>'Câmpulung',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Olt',
            'district_description'=>'Slatina',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Prahova',
            'district_description'=>'Ploiești',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Romanați',
            'district_description'=>'Caracal',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Săcueni',
            'district_description'=>'N/A',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Râmnic',
            'district_description'=>'Focșani',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Teleorman',
            'district_description'=>'Zimnicea',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('districts')->insert(
          [
            'district_name'=>'Vlașca',
            'district_description'=>'Giurgiu town',
            'country_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
    }
}
