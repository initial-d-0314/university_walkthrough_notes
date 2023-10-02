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
    }
}
