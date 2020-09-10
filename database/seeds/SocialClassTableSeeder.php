<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SocialClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('social_classes')->insert(
          [
            'social_name'=>'Landowner',
            'social_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('social_classes')->insert(
          [
            'social_name'=>'Clăcaș',
            'social_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('social_classes')->insert(
          [
            'social_name'=>'Craftsman',
            'social_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
    }
}
