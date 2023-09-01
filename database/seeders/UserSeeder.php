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
            'name' => 'lev',
            'email' => 'lev@gmail.com',
            'password' => Hash::make('lev'),
            'section'=>'理系',
            'grade'=>1,
            'introduction'=>'levです。gradeは1（大学生）になってます。',
            'university_id'=>1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('users')->insert([
            'name' => 'tech',
            'email' => 'tech@gmail.com',
            'section'=>'文系',
            'grade'=>0,
            'introduction'=>'techです。gradeは0（大学入学前）になってます。',
            'university_id'=>1,
            'password' => Hash::make('tech'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('users')->insert([
            'name' => 'kuroki',
            'email' => 'kuroki@gmail.com',
            'section'=>'情報系',
            'grade'=>2,
            'introduction'=>'kurokiです。gradeは2（大学院生）になってます。',
            'university_id'=>1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('users')->insert([
            'name' => 'hamada',
            'email' => 'hamada@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('users')->insert([
            'name' => 'iwaki',
            'email' => 'iwaki@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('users')->insert([
            'name' => 'kamiya',
            'email' => 'kamiya@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
