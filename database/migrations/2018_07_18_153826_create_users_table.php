<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20)->comment('名称');
            $table->string('email',50)->comment('邮箱');
            $table->string("password",100)->comment('密码');
            $table->string("rememberToken")->default('')->comment('token');
            $table->integer('status')->default(0)->comment('1启用，0禁用');
            $table->integer("shop_id")->comment('所属商家');
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
        Schema::dropIfExists('users');
    }
}
