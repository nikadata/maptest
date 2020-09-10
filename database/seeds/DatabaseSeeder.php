<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        //$this->call(UserTableSeeder::class);
      //$this->call(RoomTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(DistrictTableSeeder::class);
        $this->call(CountyTableSeeder::class);
        $this->call(VillageTableSeeder::class);
        $this->call(SocialClassTableSeeder::class);
        $this->call(SkillTableSeeder::class);
        $this->call(SourceTableSeeder::class);
        //$this->call(ClientTableSeeder::class);
        $this->call(ExtendeTableSeeder::class);
        $this->call(HouseholdTableSeeder::class);
        $this->call(ChildTableSeeder::class);
        $this->call(WifeTableSeeder::class);
        $this->call(StatTableSeeder::class);
        //$this->call(LinkTableSeeder::class);
        $this->call(GroupTypeSeeder::class);
        //$this->call(ChurchTableSeeder::class);
        $this->call(Village_statsTableSeeder::class);
        $this->call(VillageSkillsTableSeeder::class);


    }
}
