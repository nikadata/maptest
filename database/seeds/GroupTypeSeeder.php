<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GroupTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          DB::table('group_types')->insert(
            [
              'type'=>'Father',
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
          );
          DB::table('group_types')->insert(
            [
              'type'=>'Mother',
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
          );
        DB::table('group_types')->insert(
          [
            'type'=>'Brother',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('group_types')->insert(
          [
            'type'=>'Sister',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('group_types')->insert(
          [
            'type'=>'Cousin',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
    }
}
