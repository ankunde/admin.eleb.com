<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $role = Role::all();
        return view('Role.index',compact('role'));
    }
    public function create(){
        $permission = Permission::all();
        return view('Role.create',compact('permission'));
    }
    public function store(Request $request){
        //>>1.验证数据
        $this->validate($request,[
            'name'=>'required|unique:permissions',
            'permissions_name'=>'required'
        ],[
            'name.required'=>'权限名不能为空',
            'name.unique'=>'该权限名已被注册',
            'permissions_name.required'=>'权限不能为空'
        ]);
        //>>2.添加权限
        Role::create(['name'=>$request->name])->syncPermissions($request->permissions_name);
        //>>3.返回权限列表
        return redirect()->route('Role.index')->with('success','添加角色成功');
    }
    public function edit(Request $request,Role $Role)
    {
        $permission = Permission::all();
        return view('Role.edit',compact('Role','permission'));
    }
    public function update(Request $request,Role $Role)
    {
        $Role->syncPermissions($request->permission_id)
             ->update(['id'=>$request->id,'name'=>$request->name]);
        return redirect()->route('Role.index')->with('success','修改角色成功');
    }
    public function destroy(Request $request,Role $Role){
        $Role->delete();
        return redirect()->route('Role.index')->with('success','删除角色成功');
    }
}
