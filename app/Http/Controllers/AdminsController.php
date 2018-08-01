<?php

namespace App\Http\Controllers;

use App\Model\Admins;
use App\Model\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['index']
        ]);
    }

    //重置商户密码
    public function pwd(Request $request,Users $admin)
    {
//        dd($admin);
        return view('admins.pwd',compact('admin'));
    }
    //保存重置密码
    public function newpwd(Request $request,Users $user){
//        dd($request->password);
        //>>1.验证规则
        $this->validate($request,[
            'password'=>'required|confirmed'
        ],[
            'password.required'=>'密码必须填写',
            'password.confirmed'=>'2次输入密码必须一致'
        ]);
        //>>2.修改密码
        $user->update([
            'password'=>bcrypt($request->password),
            ]);
        //>>3.返回列表,并友好提示
        return redirect()->route('admins.index')->with('success','商户密码修改成功');
    }
    //修改密码显示页
    public function change(Request $request,Admins $admin)
    {
        return view('admins.change');
    }
    //修改密码
    public function reset(Admins $admin,Request $request)
    {
        //查询数据库密码
        $password=Auth::user()->password;
        //验证原密码是否输入正确
        if (!Hash::check($request->password,$password)) {
            return redirect()->back()->with('danger','对不起,你的原密码不正确');
        }
        //>>1.验证规则
        $this->validate($request,[
            'newpassword'=>'required|confirmed'
        ],[
            'newpassword.required'=>'新密码必须填写',
            'newpassword.confirmed'=>'2次输入的密码不一致'
        ]);
        //>>2.修改字段
        $admin->update([
            'password'=>bcrypt($request->newpassword)
        ]);
        //>>3.跳转并进行友好提示
        return redirect()->route('admins.index')->with('success','修改密码成功');
    }
    //列表
    public function index()
    {
        $rows = Admins::all();
        return view('admins.index',compact('rows'));
    }
    //添加页
    public function create()
    {
        $role = Role::all();
        return view('admins.create',compact('role'));
    }
    //保存数据
    public function store(Request $request){
//        dd($request->role_name);
        //>>1.验证数据
        $this->validate($request,[
            'name'=>'required|max:10',
            'email'=>'required|unique:admins',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required'
        ],[
            'name.required'=>'名称不能为空',
            'name.max'=>'名称长度不能超过10',
            'email.required'=>'邮箱不能为空',
            'email.unique'=>'该邮箱已经注册',
            'password.required'=>'密码不能为空',
            'password.confirmed'=>'2次输入的密码不一致',
            'password_confirmation.required'=>'再次输入密码不能为空',
        ]);
        //创建时间
        $time = date('Y-m-d H:i:s',time());
        //>>2.添加数据
           $admin = Admins::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'create_time'=>$time
            ])->assignRole($request->role_name);
        //>>3.添加成功跳转页面
        return redirect()->route('admins.index')->with('success','添加管理员成功');
    }
    //删除数据
    public function destroy(Request $request,Admins $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('success','删除用户成功');
    }
    //显示修改页面
    public function edit(Request $request,Admins $admin)
    {
        $role = Role::all();
        return view('admins.edit',compact('admin','role'));
    }
    //修改数据
    public function update(Request $request,Admins $admin)
    {
        $this->validate($request,[
            'name'=>'required|max:10',
            'email'=>'required'
        ],[
            'name.required'=>'商户名称必须填写',
            'name.max'=>'商户名长度不能大于10',
            'email'=>'邮箱必须填写'
        ]);
        //>>2.修改数据
        $admin->syncRoles($request->role_name)->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);
        //>>3.返回首页
        return redirect()->route('admins.index')->with("success","修改管理员基础信息成功");
    }
}
