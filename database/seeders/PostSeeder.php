<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title'=>'電気通信大学には南の学食がある',
            'body'=>'電気通信大学には南の学食がある。といっても学外の店ではあるが。麻婆豆腐のおいしいお店なので食神というお店をぜひ。',
            'user_id'=>1,
            'genre_id'=>1,
            'category_id'=>3,
            'university_id'=>1,
            'use_time' => false,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('posts')->insert([
            'title'=>'チーム開発会！（終了済み）',
            'body'=>'渋谷でチーム開発会を行います！！',
            'user_id'=>1,
            'genre_id'=>6,
            'category_id'=>13,
            'university_id'=>2,
            'use_time' => true,
            'sttime' => '11:00:00',
            'stdate' => '2023-08-27',
            'start_time' => '2023-08-27 11:00:00',
            'entime' => '20:00:00',
            'endate' => '2023-08-29',
            'end_time' => '2023-08-29 20:00:00',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('posts')->insert([
            'title'=>'夏休み中の図書館に関して(期間内)',
            'body'=>'追加の貸出が行えます！！',
            'user_id'=>3,
            'genre_id'=>5,
            'category_id'=>11,
            'university_id'=>3,
            'use_time' => true,
            'sttime' => '00:00:00',
            'stdate' => '2023-08-01',
            'start_time' => '2023-08-01 00:00:00',
            'entime' => '00:00:00',
            'endate' => '2023-10-01',
            'end_time' => '2023-10-01 00:00:00',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('posts')->insert([
            'title'=>'新学期記念セールについて(開催前)',
            'body'=>'新学期を応援するために生協はセールを行います！',
            'user_id'=>4,
            'genre_id'=>6,
            'category_id'=>13,
            'university_id'=>3,
            'use_time' => true,
            'sttime' => '00:00:00',
            'stdate' => '2023-08-01',
            'start_time' => '2023-08-01 00:00:00',
            'entime' => '00:00:00',
            'endate' => '2023-10-01',
            'end_time' => '2023-10-01 00:00:00',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
