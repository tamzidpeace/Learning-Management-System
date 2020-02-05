<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['role_id' => '3', 'name' => 'admin', 'email' => 'admin@lms.com', 'password' => bcrypt('11111111'), 'remember_token' =>  Str::random(10),],
            ['role_id' => '1', 'name' => 'student', 'email' => 'student@lms.com', 'password' => bcrypt('11111111'), 'remember_token' =>  Str::random(10),],
            ['role_id' => '2', 'name' => 'teacher', 'email' => 'teacher@lms.com', 'password' => bcrypt('11111111'), 'remember_token' =>  Str::random(10),],
        ]);

        DB::table('roles')->insert([['name' => 'Student'], 
        ['name' => 'Teacher'], ['name' => 'Admin'],]);
    }
}
