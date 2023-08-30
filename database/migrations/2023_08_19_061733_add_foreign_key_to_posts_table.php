<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('genre_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('university_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('posts_genre_id_foreign');
            $table->dropColumn('genre_id');
            $table->dropForeign('posts_category_id_foreign');
            $table->dropColumn('category_id');
            $table->dropForeign('posts_university_id_foreign');
            $table->dropColumn('university_id');
        });
    }
};
