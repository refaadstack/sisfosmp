<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role' =>'admin',
            'name' => 'Redho Fadillah Adha',
            'username' => 'admin',
            'email' => 'Redho@gmail.com',
            'password' => bcrypt('redhoredho'),
            'remember_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'role' =>'siswa',
            'name' => 'Melsy Septiani Barlin',
            'username' => 'siswa',
            'email' => 'Melsy@gmail.com',
            'password' => bcrypt('melsymelsy'),
            'remember_token' => Str::random(60),
        ]);
        
    }
}
