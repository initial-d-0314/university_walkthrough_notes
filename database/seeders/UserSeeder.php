<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DateTime;

class UserSeeder extends Seeder
{
     /**
     * Run the database seeds.
     * @return void
     *(人名のパスワードはpasswordです)
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('test'),
            'section'=>'理系',
            'grade'=>1,
            'introduction'=>'テスト用アカウントです。',
            'university_id'=>1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
