<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
        title	string	活动名称
        content	text	活动详情
        start_time	datetime	活动开始时间
        end_time	datetime	活动结束时间
         */
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',20)->comment('活动名称');
            $table->text('content')->comment('活动详情');
            $table->dateTime('start_time')->comment('活动开始时间');
            $table->dateTime('end_time')->comment('活动结束时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
