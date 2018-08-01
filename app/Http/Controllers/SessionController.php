<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    //显示登录页
    public function create(){
        return view('session.create');
    }
    //创建会话(登录)
    public function store(Request $request){

        //>>1.验证数据
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha'
        ],[
            'email.required'=>'邮箱必须填写',
            'password.required'=>'密码必须填写',
            'captcha.required'=>'验证码必须填写',
            'captcha.captcha'=>'验证码填写错误'
        ]);
//        //>>2.核实数据
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],$request->status)){
            return redirect()->route('shops.index',[Auth::user()])->with('success','欢迎回来');
        }else{
            return redirect()->route('login')->with('danger','密码或邮箱不正确');
        }
    }
    //关闭会话
    public function destroy(){

        Auth::logout();
        return redirect()->route('login')->with('success','已退出当前用户');
    }
}
