<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class VillageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          DB::table('villages')->insert(
            [
            'village_name'=>'Beleti',
            'households'=>0,
            'people'=>0,
            'gypsy'=>0,
            'rudar'=>0,
            'romanian'=>0,
            'jewish'=>0,
            'serbian'=>0,
            'tax_payer'=>0,
            'exempt_tax'=>0,
            'landowner'=>0,
            'renter'=>0,
            'craftsman'=>0,
            'has_church'=>FALSE,
            'has_priest'=>FALSE,
            'has_deacon'=>FALSE,
            'has_singer'=>FALSE,
            'has_sexton'=>FALSE,
            'has_school'=>FALSE,
            'has_teacher'=>FALSE,
            'has_sdeacon'=>FALSE,
            'physical'=>0,
            'mental'=>0,
            'disabilities'=>0,
            'land'=>234,
            'wheat'=>0,
            'corn'=>0,
            'fennel'=>0,
            'barley'=>0,
            'oats'=>0,
            'millet'=>0,
            'horses'=>0,
            'bulls'=>0,
            'cows'=>0,
            'sheep'=>0,
            'goats'=>0,
            'pigs'=>0,
            'buffalos'=>0,
            'donkeys'=>0,
            'mules'=>0,
            'hives'=>0,
            'plumtrees'=>0,
            'mulberrytrees'=>0,
            'vineyards'=>0,
            'vineyardopt'=>'Rows',
            'apples'=>0,
            'pears'=>0,
            'nuts'=>0,
            'cherries'=>0,
            'sourcherries'=>0,
            'county_id'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        /*
        DB::table('villages')->insert(
          [
          'village_name'=>'Vallentuna',
          'land'=>20000,
          'horses'=>200,
          'bulls'=>50,
          'cows'=>300,
          'sheep'=>100,
          'goats'=>60,
          'pigs'=>550,
          'buffalos'=>4,
          'donkeys'=>7,
          'mules'=>2,
          'hives'=>1,
          'plumtrees'=>1125,
          'mulberrytrees'=>1,
          'vineyards'=>0,
          'apples'=>0,
          'pears'=>0,
          'nuts'=>0,
          'cherries'=>0,
          'sourcherries'=>0,
          'county_id'=>2,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]
      );
      DB::table('villages')->insert(
        [
        'village_name'=>'Sollentuna',
        'land'=>0,
        'horses'=>0,
        'bulls'=>0,
        'cows'=>0,
        'sheep'=>0,
        'goats'=>0,
        'pigs'=>0,
        'buffalos'=>0,
        'donkeys'=>0,
        'mules'=>0,
        'hives'=>0,
        'plumtrees'=>0,
        'mulberrytrees'=>0,
        'vineyards'=>0,
        'apples'=>0,
        'pears'=>0,
        'nuts'=>0,
        'cherries'=>0,
        'sourcherries'=>0,
        'county_id'=>3,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]
    );
    */
    }
}
