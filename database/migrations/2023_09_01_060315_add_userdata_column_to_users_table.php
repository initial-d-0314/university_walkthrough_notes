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
        Schema::table('users', function (Blueprint $table) {
            $table->string('section', 100)->nullable();
            $table->string('grade',30)->nullable();
            $table->string('introduction', 2000)->nullable();
            $table->string('image_url', 300)->nullable();
            $table->foreignId('university_id')->nullable()->constrained();
            //外部キーもnullableにできるので利用する
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('user_additionals_university_id_foreign');
            $table->dropColumn('university_id');
        });
    }
};
