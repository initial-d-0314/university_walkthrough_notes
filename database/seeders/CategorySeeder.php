<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
                'genre_id' =>1,
                'name' => '学食',
                'description' => '学生食堂について。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('categories')->insert([
                'genre_id' =>1,
                'name' => '自販機',
                'description' => '学内の自販機について。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('categories')->insert([
                'genre_id' =>1,
                'name' => '飲食店',
                'description' => '学校近隣の飲食店について。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);

        DB::table('categories')->insert([
                'genre_id' =>2,
                'name' => '自習',
                'description' => '自習できる場所について。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('categories')->insert([
                'genre_id' =>2,
                'name' => '休憩場所',
                'description' => '学内で休憩できそうな場所について。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);

        DB::table('categories')->insert([
                'genre_id' =>3,
                'name' => 'サークル・部活動',
                'description' => 'サークルや部活動について。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('categories')->insert([
                'genre_id' =>3,
                'name' => 'イベント',
                'description' => 'サークルなどが関連しないイベントについて。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);

        DB::table('categories')->insert([
                'genre_id' =>4,
                'name' => 'ゲームセンター',
                'description' => 'ゲームセンターについて。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('categories')->insert([
                'genre_id' =>4,
                'name' => 'レジャー施設',
                'description' => 'ゲームセンター以外の、レジャー施設について。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);

        DB::table('categories')->insert([
                'genre_id' =>5,
                'name' => 'お店',
                'description' => '食料品やスーパーなどのお店について。。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('categories')->insert([
                'genre_id' =>5,
                'name' => '図書館',
                'description' => '学校に付属している図書館について。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('categories')->insert([
                'genre_id' =>5,
                'name' => '公共施設',
                'description' => '学校近隣の公共施設について。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);

        DB::table('categories')->insert([
                'genre_id' =>6,
                'name' => '授業',
                'description' => '授業に関連する事項について。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('categories')->insert([
                'genre_id' =>6,
                'name' => '就職',
                'description' => '就職に関連する事項について。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);

        DB::table('categories')->insert([
                'genre_id' =>7,
                'name' => '遺失物',
                'description' => '学内で見かけた遺失物について。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
    }
}
