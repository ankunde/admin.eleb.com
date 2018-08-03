<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('permission.index',compact('permissions'));
    }
    public function create(){
        return view('permission.create');
    }
    public function store(Request $request){
        //>>1.验证数据
        $this->validate($request,[
            'name'=>'required|unique:permissions'
        ],[
            'name.required'=>'权限名不能为空',
            'name.unique'=>'该权限名已被注册',
        ]);
        //>>2.添加权限
        Permission::create([
            'name'=>$request->name
        ]);
        //>>3.返回权限列表
        return redirect()->route('Permission.index')->with('success','添加权限成功');
    }
    public function edit(Request $request,Permission $Permission)
    {
        return view('permission.edit',compact('Permission'));
    }
    public function update(Request $request,Permission $Permission)
    {
        $Permission->update([
                'name'=>$request->name
        ]);
        return redirect()->route('Permission.index')->with('success','修改权限成功');
    }
    public function destroy(Request $request,Permission $permission){

        $permission->delete();
        return redirect()->route('Permission.index')->with('success','删除权限成功');
    }
}
