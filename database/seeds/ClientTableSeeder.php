<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('clients')->insert(
          [
            'name'=>'John',
            'last_name'=>'Doe',
            'age'=>50,
            'maritalstatus'=>'Married',
            'nationality'=>'Rumanian',
            'taxpayer'=>'Yes',
            'village_id'=>1,
            'socialclass_id'=>1,
            'skill_id'=>1,
            'source_id'=>1,
          ]
        );
        DB::table('clients')->insert(
          [
            'name'=>'Jane',
            'last_name'=>'Doe',
            'age'=>30,
            'maritalstatus'=>'Married',
            'nationality'=>'Rumanian',
            'taxpayer'=>'No',
            'village_id'=>2,
            'socialclass_id'=>2,
            'skill_id'=>2,
            'source_id'=>2,
          ]
        );
        DB::table('clients')->insert(
          [
            'name'=>'Peter',
            'last_name'=>'Pan',
            'age'=>15,
            'maritalstatus'=>'Unmarried',
            'nationality'=>'German',
            'taxpayer'=>'No',
            'village_id'=>3,
            'socialclass_id'=>3,
            'skill_id'=>3,
            'source_id'=>3,
          ]
        );
        DB::table('clients')->insert(
          [
            'name'=>'Edvard',
            'last_name'=>'Shoue',
            'age'=>33,
            'maritalstatus'=>'Married',
            'nationality'=>'Rumanian',
            'taxpayer'=>'Yes',
            'village_id'=>1,
            'socialclass_id'=>2,
            'skill_id'=>3,
            'source_id'=>1,
          ]
        );
    }
}
