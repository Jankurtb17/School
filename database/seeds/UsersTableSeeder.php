<?php

use Illuminate\Database\Seeder;
use App\User; 

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
            'role_id'        => '2',
            'firstName'      => 'Jan Kurt',
            'lastName'       => 'Bayaras',
            'email'          => 'kurtb4@yopmail.com',
            'password'       => Hash::make('password'),
            'remember_token' => str_random(20),
            'user_type'      => 'admin',
        ]);
    }
}
