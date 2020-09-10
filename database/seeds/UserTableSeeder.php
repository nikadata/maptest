<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user=Role::where('name','User')->first();
        $role_admin=Role::where('name','Admin')->first();

        $user=new User();
        $user->name='Ryan';
        $user->email='ryan@dias.se';
        $user->password=bcrypt('7932');
        $user->save();
        $user->roles()->attach($role_user);

        $admin=new User();
        $admin->name='Admin';
        $admin->email='admin@maprom.se';
        $admin->password=bcrypt('1234');
        $admin->save();
        $admin->roles()->attach($role_admin);

        /*
        DB::table('users')->insert(
          [
            'name'=>'admin',
            'email'=>'admin@maprom.se',
            'password'=>bcrypt('1234'),
          ]
        );
        */
    }
}
