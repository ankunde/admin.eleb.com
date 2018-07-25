<?php

namespace App\Http\Controllers;

use App\Model\Shops;
use App\Model\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
//    //中间件控制
//    public function __construct()
//    {
//
//    }
    //用户列表
    public function index()//搜索分页时需要用到
    {
        $rows = Users::all();
        return view('users.index',compact('rows'));
    }
    //添加商家
    public function create()
    {
        return view('users.create');
    }
    //接受注册信息
    public function store(Request $request)
    {
//        //>>1.验证数据
        $this->validate($request,[
            'name'=>'required|max:10',
            'email'=>'required|unique:users',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
            'status'=>'required',
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
            'status'=>'状态必须选择',
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
        //>>2.开启事物
        DB::transaction(function ()  use($request){
            //>>2.存入数据
            $value = Shops::create([
                'shop_category_id'=>$request->shop_category_id,
                'shop_name'=>$request->shop_name,
                'shop_img'=>$request->shop_img,
                'brand'=>$request->brand,
                'on_time'=>$request->on_time,
                'fengniao'=>$request->fengniao,
                'bao'=>$request->bao,
                'piao'=>$request->piao,
                'start_send'=>$request->start_send,
                'notice'=>$request->notice,
                'discount'=>$request->discount,
                'status'=>$request->status,
            ]);
            Users::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'status'=>$request->status,
                'shop_id'=>$value->id
            ]);
        });


        //>>3.返回首页
        return redirect()->route('users.index')->with("success","商户账号添加成功,默认审核已通过,可直接使用");
    }
    //回显修改列表
    public function edit(Request $request,Users $user)
    {
        return view('users.edit',compact('user'));
    }
    //保存修改信息
    public function update(Request $request,Users $user)
    {
        $this->validate($request,[
            'name'=>'required|max:10',
            'img'=>'required',
            'status'=>'required'
        ],[
            'name.required'=>'商户名称必须填写',
            'name.max'=>'商户名长度不能大于10',
            'status'=>'状态必须选择'
        ]);
        //>>2.处理上传图片
        $path=$request->img;
        $data=[
            'name'=>$request->name,
            'status'=>$request->status
        ];
        if($path){
            $path = $request->file('img')->store('/public/'.date('Y-m-d'));
            $data['img']=$path;
        }
        //>>2.修改数据
        $shopcategory->update($data);
        //>>3.返回首页
        return redirect()->route('shopcategories.index')->with("success","修改分类成功");
    }

    public function destroy(Request $request,Users $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success','删除分类成功');
    }
}
