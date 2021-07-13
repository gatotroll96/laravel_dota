<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
        	'username' 	=> 'admin',
        	'email'		=> 'admin@gmail.com',
        	'password'	=> bcrypt('123456cc')

        ]);
    }
}
