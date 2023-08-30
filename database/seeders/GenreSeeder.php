<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
                'name' => '食べ物',
                'description' => '学食や、学内の自販機などの食べ物に関する情報はこのジャンルです。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('genres')->insert([
                'name' => '場所',
                'description' => '自習場所、景色のきれいな場所についての情報はこのジャンルです。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('genres')->insert([
                'name' => '集まり',
                'description' => 'サークル活動や集会などのイベントに関する情報はこのジャンルです。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('genres')->insert([
                'name' => '遊び',
                'description' => 'ゲームセンターや、運動場などの情報はこのジャンルです。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('genres')->insert([
                'name' => '周辺施設',
                'description' => '近隣の公共施設や、お店などの情報はこのジャンルです。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('genres')->insert([
                'name' => '学業',
                'description' => '学業に関する情報はこのジャンルです。ルールを参照した上で投稿すること。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('genres')->insert([
                'name' => 'その他',
                'description' => '上記のいずれにも当てはまらない情報はこのジャンルです。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
    }
}
