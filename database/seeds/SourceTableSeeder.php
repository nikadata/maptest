<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sources')->insert(
          [
            'source_name'=>'ANIC',
            'source_description'=>'Catagrafii, inv. 501, Partea I, dos. 53/1838, vol. II, Jud. Muscel, Pl. Podgoria, Beleti, f.242v-sqv.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        /*
        DB::table('sources')->insert(
          [
            'source_name'=>'Svenska Dagbladet',
            'source_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        DB::table('sources')->insert(
          [
            'source_name'=>'Uppsala Nytt',
            'source_description'=>'Description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]
        );
        */
    }
}
