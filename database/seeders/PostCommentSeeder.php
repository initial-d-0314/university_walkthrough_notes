<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_comments')->insert([
            'post_id' => 1,
            'title'=>'南の学食',
            'body'=>'あくまでもそう呼ばれているだけで学食の電子マネーとかには対応していないので注意',
            'user_id'=>3,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('post_comments')->insert([
            'post_id' => 1,
            'title'=>'こういう所の麻婆豆腐は',
            'body'=>'さぞかし辛いんだろうな…',
            'user_id'=>4,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('post_comments')->insert([
            'post_id' => 2,
            'title'=>'激闘というほかない体験',
            'body'=>'楽しいけどそれはそれとして大変だった',
            'user_id'=>5,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
