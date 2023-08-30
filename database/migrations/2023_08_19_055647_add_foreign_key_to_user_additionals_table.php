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
        Schema::table('user_additionals', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
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
        Schema::table('user_additionals', function (Blueprint $table) {
            $table->dropForeign('user_additionals_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('user_additionals_university_id_foreign');
            $table->dropColumn('university_id');
        });
    }
};
