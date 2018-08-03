<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
        name	string	名称
        url	string	地址
        permission_id	int	关联权限id
        pid	int	上级菜单id
         */
        Schema::create('navs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',10)->default('')->comment('名称');
            $table->string('url')->default('')->comment('地址');
            $table->integer('permission_id')->default(0)->comment('关联权限id');
            $table->integer('pid')->default(0)->comment('上级菜单id');
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
        Schema::dropIfExists('navs');
    }
}
