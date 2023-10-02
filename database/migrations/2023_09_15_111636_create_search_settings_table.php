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
        Schema::create('search_settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('university_id')->nullable()->constrained();
            $table->foreignId('genre_id')->nullable()->constrained();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->string('eventb',5)->nullable();
            $table->string('eventd',5)->nullable();
            $table->string('eventa',5)->nullable();
            $table->string('eventn',5)->nullable();
            $table->string('keyword',300)->nullable();
            $table->bigInteger('make_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('search_settings', function (Blueprint $table) {
        $table->dropForeign('search_settings_user_id_foreign');
        $table->dropColumn('user_id');
        $table->dropForeign('search_settings_genre_id_foreign');
        $table->dropColumn('genre_id');
        $table->dropForeign('search_settings_category_id_foreign');
        $table->dropColumn('category_id');
        $table->dropForeign('search_settings_university_id_foreign');
        $table->dropColumn('university_id');
        });
        Schema::dropIfExists('search_settings');
    }
};
