<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CountyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('counties')->insert(
          [
            'county_name'=>'Gălășești',
            'county_description'=>'Plasă',
            'district_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Pitești',
            'county_description'=>'Plasă',
            'district_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Olt',
            'county_description'=>'Plasă',
            'district_id'=>3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Arefu',
            'county_description'=>'Plai',
            'district_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Loviștea',
            'county_description'=>'Plai',
            'district_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Topolog',
            'county_description'=>'Plasă',
            'district_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Argeș/Argeșel',
            'county_description'=>'Plasă',
            'district_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Vădeni',
            'county_description'=>'Plasă',
            'district_id'=>2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Balta',
            'county_description'=>'Plasă',
            'district_id'=>2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Sărata',
            'county_description'=>'Plasă',
            'district_id'=>3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Câmpul',
            'county_description'=>'Plasă',
            'district_id'=>3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Slănic',
            'county_description'=>'Plai',
            'district_id'=>3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Pârșcovu',
            'county_description'=>'Plai',
            'district_id'=>3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Bolintin',
            'county_description'=>'Plasă',
            'district_id'=>4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Ialomița',
            'county_description'=>'Plasă',
            'district_id'=>4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Cobia',
            'county_description'=>'Plasă',
            'district_id'=>4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Dâmbovița',
            'county_description'=>'Plasă',
            'district_id'=>4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Ialomița',
            'county_description'=>'Plai',
            'district_id'=>4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Dâmbovița',
            'county_description'=>'Plai',
            'district_id'=>4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Gilort',
            'county_description'=>'Plasă',
            'district_id'=>5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Câmpu',
            'county_description'=>'Plasă',
            'district_id'=>5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Amaradia',
            'county_description'=>'Plasă',
            'district_id'=>5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Balta plasă',
            'county_description'=>'Plasă',
            'district_id'=>5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Jiu',
            'county_description'=>'Plasă',
            'district_id'=>5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Ialomița',
            'county_description'=>'Plasă',
            'district_id'=>6,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Borcea',
            'county_description'=>'Plasă',
            'district_id'=>6,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Snagov',
            'county_description'=>'Plasă',
            'district_id'=>7,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Ciocănești',
            'county_description'=>'Plasă',
            'district_id'=>7,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Sabar',
            'county_description'=>'Plasă',
            'district_id'=>7,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Oltenița/Obilești',
            'county_description'=>'Plasă',
            'district_id'=>7,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Gherghița',
            'county_description'=>'Plasă',
            'district_id'=>7,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Dâmbovița',
            'county_description'=>'Plasă',
            'district_id'=>7,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Argeș',
            'county_description'=>'Plasă',
            'district_id'=>9,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Râurile',
            'county_description'=>'Plasă',
            'district_id'=>9,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Podgoria',
            'county_description'=>'Plasă',
            'district_id'=>9,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Nucșoara',
            'county_description'=>'Plai',
            'district_id'=>9,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Dâmbovița',
            'county_description'=>'Plai',
            'district_id'=>9,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Oltul de Jos ',
            'county_description'=>'Plasă',
            'district_id'=>10,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Oltul de Sus',
            'county_description'=>'Plasă',
            'district_id'=>10,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Marginea',
            'county_description'=>'Plasă',
            'district_id'=>10,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Șerbănești',
            'county_description'=>'Plasă',
            'district_id'=>10,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Câmpu',
            'county_description'=>'Plasă',
            'district_id'=>11,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Târgșor',
            'county_description'=>'Plasă',
            'district_id'=>11,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Filipești',
            'county_description'=>'Plasă',
            'district_id'=>11,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Prahova',
            'county_description'=>'Plai',
            'district_id'=>11,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Mijloc',
            'county_description'=>'Plasă',
            'district_id'=>12,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Olt',
            'county_description'=>'Plasă',
            'district_id'=>12,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Tăzlui',
            'county_description'=>'Plasă',
            'district_id'=>12,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Câmpuc',
            'county_description'=>'Plasă',
            'district_id'=>12,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Câmpu',
            'county_description'=>'Plasă',
            'district_id'=>13,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Teleajen',
            'county_description'=>'Plai',
            'district_id'=>13,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Despărțitura Buzăului ',
            'county_description'=>'Plai',
            'district_id'=>13,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Podgoria',
            'county_description'=>'Plasă',
            'district_id'=>13,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Tohani',
            'county_description'=>'Plasă',
            'district_id'=>13,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Râmnic',
            'county_description'=>'Plai',
            'district_id'=>14,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Râmnicul de Jos',
            'county_description'=>'Plasă',
            'district_id'=>14,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Marginea de Jos',
            'county_description'=>'Plasă',
            'district_id'=>14,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Marginea de Sus',
            'county_description'=>'Plasă',
            'district_id'=>14,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Oraș',
            'county_description'=>'Plasă',
            'district_id'=>14,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Gradiștea',
            'county_description'=>'Plasă',
            'district_id'=>14,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Râmnicul de Sus',
            'county_description'=>'Plasă',
            'district_id'=>14,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Teleroman',
            'county_description'=>'Plasă',
            'district_id'=>15,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Cotmeana',
            'county_description'=>'Plasă',
            'district_id'=>15,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Târgu',
            'county_description'=>'Plasă',
            'district_id'=>15,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Mijlocul',
            'county_description'=>'Plasă',
            'district_id'=>15,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Marginea',
            'county_description'=>'Plasă',
            'district_id'=>15,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Izvoarele',
            'county_description'=>'Plasă',
            'district_id'=>16,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Ogrăzeni',
            'county_description'=>'Plasă',
            'district_id'=>16,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Marginea',
            'county_description'=>'Plasă',
            'district_id'=>16,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('counties')->insert(
          [
            'county_name'=>'Balta/Neajlov ',
            'county_description'=>'Plasă',
            'district_id'=>16,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
    }
}
