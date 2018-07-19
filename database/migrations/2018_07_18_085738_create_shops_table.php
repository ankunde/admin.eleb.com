<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_category_id')->comment('店铺分类ID');
            $table->string('shop_name',20)->comment('名称');
            $table->string('shop_img',150)->comment('店铺图片');
            $table->float('shop_rating')->default(4)->comment('评分');
            $table->tinyInteger('brand')->default(0)->comment('是否是品牌');
            $table->tinyInteger('on_time')->default(0)->comment('是否准时送达');
            $table->tinyInteger('fengniao')->default(0)->comment('是否蜂鸟配送');
            $table->tinyInteger('bao')->default(0)->comment('是否保标记');
            $table->tinyInteger('piao')->default(0)->comment('是否标准达');
            $table->float('start_send')->comment('起送金额');
            $table->float("send_cost")->default(4)->comment('配送费');
            $table->string('notice',150)->comment('店公告');
            $table->string('discount')->default('')->comment('优惠信息');
            $table->integer('status')->default(0)->comment('状态:1正常,0待审核,-1禁用');
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
        Schema::dropIfExists('shops');
    }
}
