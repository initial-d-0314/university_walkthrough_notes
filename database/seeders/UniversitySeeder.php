<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('universities')->insert([
                'name' => '電気通信大学',
                'section' =>'情報系',
                'url' => 'https://www.uec.ac.jp/',
                'nearest_station' => '京王線　調布駅',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('universities')->insert([
                'name' => '早稲田大学（早稲田キャンパス）',
                'nearest_station' => '東京メトロ東西線　早稲田駅',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('universities')->insert([
                'name' => '東京工業大学（大岡山キャンパス）',
                'section' => '工学系',
                'nearest_station' => '大井町線　大岡山駅',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
    }
}
