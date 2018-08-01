<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户id');
            $table->string('province',10)->default('')->comment('省');
            $table->string('city',10)->default('')->comment('市');
            $table->string('county',10)->default('')->comment('县');
            $table->string('address',100)->default('')->comment('详细地址');
            $table->string('tel',15)->default('')->comment('收货人电话');
            $table->string('name',10)->default('')->comment('收货人姓名');
            $table->integer('is_default')->default(0)->comment('是否是默认地址');
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
        Schema::dropIfExists('addresses');
    }
}
