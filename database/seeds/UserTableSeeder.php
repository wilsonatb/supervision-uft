<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_operat = Role::where('name','operat')->first();
        $role_admin = Role::where('name','admin')->first();
        $role_direct = Role::where('name','direct')->first();

        $user = new User();
        $user->name = 'Valery';
        $user->lastname = 'Gomez';
        $user->email = 'valery@gmail.com';
        $user->document = '2465478964';
        $user->password = Hash::make('123456789');
        $user->save();
        $user->roles()->attach($role_operat);
    }
}
