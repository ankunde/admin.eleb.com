<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//资源重定向
Route::resource('shops', 'ShopsController');
Route::post('/shops/{shop}', 'ShopsController@stusta')->name('shops.stusta');//审核通过

Route::resource('shopcategories','ShopcategoriesController');
Route::resource('users','UsersController');


Route::get('/admins','AdminsController@index')->name('admins.index');//用户列表
Route::get('/admins/create','AdminsController@create')->name('admins.create');//添加页面
Route::post('/admins','AdminsController@store')->name('admins.store');
Route::delete('/admins/{admin}','AdminsController@destroy')->name('admins.destroy');
Route::get('/admins/{admin}/edit','AdminsController@edit')->name('admins.edit');
Route::patch('/admins/{admin}','AdminsController@update')->name('admins.update');
Route::get('/admins/{admin}/change','AdminsController@change')->name('admins.change');//修改密码显示页
Route::post('/admins/{admin}/editpwd','AdminsController@reset')->name('admins.reset');//重置密码
Route::post('/admins/{admin}/pwd','AdminsController@pwd')->name('admins.pwd');//管理员重置商户密码
Route::post('/admin/{user}/newpwd','AdminsController@newpwd')->name('admins.newpwd');//保存重置密码

Route::get('login', 'SessionController@create')->name('login');//显示登录页面
Route::post('login', 'SessionController@store')->name('login');//创建新会话(登录)
Route::get('logout', 'SessionController@destroy')->name('logout');//关闭会话(退出)

//商品分类文件上传路由
Route::post('upload',function (){
    $storage = \Illuminate\Support\Facades\Storage::disk('oss');
    $imgputh = $storage->url($storage->putFile('ShopCategories',request()->file));
    return ['imgputh'=>$imgputh];
})->name('upload');


Route::resource('activity','ActivityController');//活动列表


//订单统计
Route::get('/CountOrder','CountController@order')->name('CountOrder');
Route::get('/OrderDay','CountController@order_day')->name('OrderDay');
Route::get('/OrderMonth','CountController@order_month')->name('OrderMonth');
//菜品统计
Route::get('/CountMenu','CountController@menu')->name('CountMenu');
Route::get('/MenuDay','CountController@menu_day')->name('MenuDay');
Route::get('/MenuMonth','CountController@menu_month')->name('MenuMonth');

//会员账号启用和禁用
Route::get('/member','MemberController@index')->name('member.index');
Route::get('/memberph/{member}','MemberController@status')->name('member.status');




Route::resource('Permission', 'PermissionController');//权限管理
Route::resource('Role', 'RoleController');//角色管理


Route::get('navs','NavsController@index')->name('navs.index');//菜单导航列表
Route::get('navs/create','NavsController@create')->name('navs.create')/*->middleware('permission:create')*/;//导航添加显示
Route::post('navs/store','NavsController@store')->name('navs.store');//保存导航菜单
Route::get('navs/{nav}/edit','NavsController@edit')->name('navs.edit');//修改导航页面
Route::post('navs/{nav}','NavsController@update')->name('navs.update');//跟新菜单导航
Route::get('users/{nav}/destroy','NavsController@destroy')->name('navs.destroy');//删除当前菜单分类


Route::get('events/lottery/{event}','EventController@lottery')->name('events.lottery');//当前活动开奖
Route::resource('events','EventController');//抽奖活动表
Route::get('eventmembers','EventMembersController@index');//活动报名表!!!!!!!!!!!!!
Route::resource('eventprizes','EventPrizesController');//抽奖活动奖品表
/**
Route::get('/users', 'UsersController@index')->name('users.index');//用户列表
Route::get('/users/{user}', 'UsersController@show')->name('users.show');//查看单个用户信息
Route::get('/users/create', 'UsersController@create')->name('users.create');//显示添加表单
Route::post('/users', 'UsersController@store')->name('users.store');//接收添加表单数据
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');//修改用户表单
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');//更新用户信息
Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');//删除用户信息

 */


