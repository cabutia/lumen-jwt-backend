<?php

use \App\User;
use Illuminate\Database\Seeder;

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
            "username" => "Leandro Gomez",
            "email" => "gleandro@ceres.solutions",
            "password" => app('hash')->make('2205367a')
        ]);
    }
}
