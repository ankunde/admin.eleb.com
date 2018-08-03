<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',20)->default('')->comment('名称');
            $table->text('content')->default('')->comment('详情');
            $table->dateTime('signup_start')->comment('报名开始时间');
            $table->dateTime('signup_end')->comment('报名结束时间');
            $table->dateTime('prize_date')->comment('开奖时间');
            $table->integer('signup_num')->default(0)->comment('报名人数限制');
            $table->integer('is_prize')->default(0)->comment('是否已开奖');
            $table->engine='InnoDB';
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
        Schema::dropIfExists('events');
    }
}
