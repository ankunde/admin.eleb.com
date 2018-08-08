<?php

namespace App\Http\Controllers;

use App\Model\Shops;
use App\Model\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;

class ShopsController extends Controller
{
    //用户列表
    public function index()//搜索分页时需要用到
    {
        $rows = Shops::all();
        return view('shops.index',compact('rows'));
    }
    //添加商家
    public function create()
    {
        return view('shops.create');
    }
    //接受注册信息
    public function store(Request $request)
    {
        //>>1.验证数据
        $this->validate($request,[
            'name'=>'required|max:10',
            'email'=>'required|unique:users',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
//            'status'=>'required',
//            'shop_id'=>'required',
            //商户信息表
            'shop_category_id'=>'required',
            'shop_name'=>'required|max:20',
            'shop_img'=>'required',
            'start_send'=>'required',
            'notice'=>'required|max:255'
        ],[
            'name.required'=>'名称必须填写',
            'name.max'=>'名称长度不能大于10',
            'email.required'=>'邮箱必须填写',
            'email.unique:users'=>'该邮箱已经被注册',
            'password.required'=>'密码必须填写',
            'password.confirmed'=>'两次密码不一致',
            'password_confirmation'=>'确认密码必须填写',
//            'status'=>'状态必须选择',
//            'shop_id'=>'所属商户必须填写',

            //商户信息
            'shop_category_idrequired'=>'商户分类必须选择',
            'shop_name.required'=>'商户名称必须填写',
            'shop_name.max'=>'商户名长度不能大于20',
            'shop_img.required'=>'商品图片必选选择',
            'start_send'=>'起送金额必须填写',
            'notice.required'=>'店铺公告必须填写',
            'notice.max'=>'店铺公告最长255'
        ]);
        //>>1.1处理上传图片
        $path = $request->file('shop_img')->store('/public/'.date('Y-m-d'));
        //>>2.开启事物
        DB::transaction(function ()  use($request,$path){
            //>>2.存入数据
            $value = Shops::create([
                'shop_category_id'=>$request->shop_category_id,
                'shop_name'=>$request->shop_name,
                'shop_img'=>$path,
                'brand'=>$request->brand,
                'on_time'=>$request->on_time,
                'fengniao'=>$request->fengniao,
                'bao'=>$request->bao,
                'piao'=>$request->piao,
                'start_send'=>$request->start_send,
                'notice'=>$request->notice,
                'discount'=>$request->discount
            ]);
            Users::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'shop_id'=>$value->id
            ]);
        });
        //>>3.返回首页
        return redirect()->route('shops.index')->with("success","商户添加成功,请静等审核");
    }
//    查看详细信息
    public function show(Request $request,Shops $shop)
    {
        return view('shops.show',compact('shop'));

    }
    public function stusta(Request $request,Shops $shop){

        //>>2.发送邮件测试
        Mail::send('welcome',[],function ($message){
            $message->from('yukuaiguyi@163.com','饿了吧外卖');
            $message->to(['yukuaiguyi@163.com'])->subject('商户审核认证通过');
        });
//        Mail::raw('商户认证审核已经通过',function ($message){
//                $message->subject('饿了吧外卖');
//                $message->to('yukuaiguyi@163.com');
//        });
        //>>1.审核通过
        $shop->update([
            'status'=>$request->status
        ]);
        return redirect()->route('shops.index')->with("success",'该商户审核通过');
    }
    //回显修改列表
    public function edit(Shops $shop)
    {
        return view('shops.edit',compact('shop'));
    }
    //保存修改信息
    public function update(Request $request,Shops $shop)
    {
        $this->validate($request,[
            'shop_category_id'=>'required',
            'shop_name'=>'required|max:20',
            'start_send'=>'required',
            'notice'=>'required|max:255'
        ],[
            'shop_category_idrequired'=>'商户分类必须选择',
            'shop_name.required'=>'商户名称必须填写',
            'shop_name.max'=>'商户名长度不能大于20',
            'start_send'=>'起送金额必须填写',
            'notice.required'=>'店铺公告必须填写',
            'notice.max'=>'店铺公告最长255'
        ]);
        //>>2.处理上传图片
        $path=$request->shop_img;
        $data=[
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$path,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'start_send'=>$request->start_send,
            'notice'=>$request->notice,
            'discount'=>$request->discount
        ];
        if($path){
            $path = $request->file('shop_img')->store('/public/'.date('Y-m-d'));
            $data['shop_img']=$path;
        }
        //>>2.修改数据
        $shop->update($data);
        //>>3.返回首页
        return redirect()->route('shops.index')->with("success","修改商户");
    }

    public function destroy(Request $request,Shops $shop)
    {
        $shop->delete();
        return redirect()->route('shops.index')->with('success','删除用户成功');
    }
}
