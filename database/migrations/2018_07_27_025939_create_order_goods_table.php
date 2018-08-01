<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->default(0)->comment('订单id');
            $table->integer('goods_id')->default(0)->comment('商品id');
            $table->integer('amount')->default(0)->comment('商品数量');
            $table->string('goods_name',10)->default('')->comment('商品名称');
            $table->string('goods_img',150)->default('')->comment('商品图片');
            $table->decimal('goods_price')->comment('商品价格');
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
        Schema::dropIfExists('order_goods');
    }
}
