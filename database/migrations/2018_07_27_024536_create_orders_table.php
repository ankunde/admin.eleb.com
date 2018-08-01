<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * user_id	int	用户ID
        shop_id	int	商家ID
        sn	string	订单编号
        province	string	省
        city	string	市
        county	string	县
        address	string	详细地址
        tel	string	收货人电话
        name	string	收货人姓名
        total	decimal	价格
        status	int	状态(-1:已取消,0:待支付,1:待发货,2:待确认,3:完成)
        created_at	datetime	创建时间
        out_trade_no	string	第三方交易号（微信支付需要）
         */
        Schema::create('count', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0)->comment('用户id');
            $table->integer('shop_id')->default(0)->comment('商家id');
            $table->string('sn',100)->default('')->comment('订单编号');
            $table->string('province',10)->default('')->comment('省');
            $table->string('city',10)->default('')->comment('市');
            $table->string('count',10)->default('')->comment('县');
            $table->string('address',150)->default('')->comment('详细地址');
            $table->string('tel',15)->default('')->comment('收货人电话');
            $table->string('name',10)->default('')->comment('收货人姓名');
            $table->decimal('total')->comment('价格');
            $table->integer('status')->default(0)->comment('-1:已取消,0:待支付,1:待发货,2:待确认,3:完成');
            $table->string('out_trade_no',150)->default('')->comment('第三方交易号（微信支付需要）');
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
        Schema::dropIfExists('count');
    }
}
