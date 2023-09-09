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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('body', 2000);
            $table->string('image_url', 300)->nullable();
            $table->string('use_time',10)->nullable();
            $table->date('stdate')->nullable();
            $table->time('sttime')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->date('endate')->nullable();
            $table->time('entime')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
