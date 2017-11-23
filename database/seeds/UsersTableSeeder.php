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
        User::truncate();
        DB::table('users')->insert([
            'email' =>'juan_perez@gmail.com',
            'password' => bcrypt('123456'),
        ]);
		DB::table('users')->insert([
            'email' =>'maria_lopez@gmail.com',
            'password' => bcrypt('654321'),
        ]);
		DB::table('users')->insert([
            'email' =>'jose_sanchez@gmail.com',
            'password' => bcrypt('675346'),
        ]);
    }
}
