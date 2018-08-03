<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventPrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * events_id	int	活动id
        name	string	奖品名称
        description	text	奖品详情
        member_id	int	中奖商家账号id
         */
        Schema::create('event_prizes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('events_id')->default(0)->comment('活动id');
            $table->string('name',10)->default('')->comment('奖品名称');
            $table->text('description')->default('')->comment('奖品详情');
            $table->integer('member_id')->default(0)->comment('中奖商家账号id');
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
        Schema::dropIfExists('event_prizes');
    }
}
