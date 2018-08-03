<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventMembersTable extends Migration
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
        member_id	int	商家账号id
         */
        Schema::create('event_members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('events_id')->default(0)->comment('活动id');
            $table->integer('member_id')->default(0)->comment('商家账号id');
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
        Schema::dropIfExists('event_members');
    }
}
