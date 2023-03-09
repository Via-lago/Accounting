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
            'username' => 'admin',
            'nama'     => 'admin',
            'password' => 'admin',
            'level' => 'admin',
        ]);

        User::create([
            'username' => 'bendahara',
            'nama'     => 'bendahara',
            'password' => '123456',
            'level' => 'bendahara',
        ]);

        User::create([
            'username' => 'user',
            'nama'     => 'user',
            'password' => '123456',
            'level' => 'user',
        ]);
    }
}
