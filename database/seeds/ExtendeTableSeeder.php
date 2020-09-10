<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExtendeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('extendeds')->insert(
          [
            'type'=>'No extended',
            'extended_description'=>'No extended family',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('extendeds')->insert(
          [
            'type'=>'Three generations',
            'extended_description'=>'Three generations living together',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('extendeds')->insert(
          [
            'type'=>'Two married brothers',
            'extended_description'=>'Two married brothers living together',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('extendeds')->insert(
          [
            'type'=>'Unmarried siblings',
            'extended_description'=>'Unmarried siblings living together',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
    }
}
