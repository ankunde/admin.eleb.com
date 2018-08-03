<?php

namespace App\Http\Controllers;

use App\Model\Admins;
use App\Model\Navs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class NavsController extends Controller
{
    public function __construct()
    {
        //>>1.设置中间件
        $this->middleware('auth',[
            'except'=>[]
        ]);
        //>>2.设置RBAC权限
        $this->middleware(['permission:list'],[
            'only'=>['list']
        ]);
        $this->middleware(['permission:add'],[
            'only'=>['add']
        ]);
        $this->middleware(['permission:admin_index'],[
            'only'=>['admin_index']
        ]);
    }
    /**
     * 显示导航条
     */
    public function index()
    {
        $nav_all = Navs::all();
        return view('navs.index',compact('nav','nav_all'));
    }
    /**
     * 添加导航条
     */
    public function create()
    {
        //>>1.查询所有权限
        $permission = Permission::all();
        //>>2.查询所有顶级菜单
        $navs = Navs::where('pid',0)->get();
        return view('navs.create',compact('permission','navs'));
    }
    /**
     * 保存导航条
     */
    public function store(Request $request)
    {
        //>>1.验证数据
        $this->validate($request,[
            'name'=>'required',
            'url'=>'required|unique:navs',
            'permission_id'=>'required'
        ],[
            'name.required'=>'菜单名必须填写',
            'url.required'=>'地址必须填写',
            'permission_id.required'=>'权限必须填写'
        ]);
        //>>2.保存数据
        Navs::create([
            'name'=>$request->name,
            'url'=>$request->url,
            'pid'=>$request->pid,
            'permission_id'=>$request->permission_id
        ]);
        //>>3.返回列表
        return redirect()->route('navs.index')->with('success','添加菜单成功');
    }
    /**
     * 显示修改导航条
     */
    public function edit(Request $request,Navs $nav)
    {
        if(!Auth::user()->can('edit')){
            return redirect()->back()->with('danger','你没有该权限');
        }
        //>>1.查询所有权限
        $permission = Permission::all();

        //>>2.查询上级目录
        $pid_name='';
        if($nav->pid!=0){
            $pid_name = Navs::where('id',$nav->pid)->first();
        }
        //>>3.查询顶级目录分级
        $navs = Navs::where('pid',0)->get();
        return view('navs.edit',compact('navs','nav','permission','pid_name'));
    }
    /**
     * 跟新导航条
     */
    public function update(Request $request,Navs $nav)
    {
        //>>1.验证数据
        $this->validate($request,[
            'name'=>'required',
            'url'=>'required',
            'permission_id'=>'required'
        ],[
            'name.required'=>'菜单名必须填写',
            'url.required'=>'地址必须填写',
            'permission_id.required'=>'权限必须填写'
        ]);
        //>>2.跟新数据库
        $nav->update([
            'name'=>$request->name,
            'url'=>$request->url,
            'permission_id'=>$request->permission_id,
            'pid'=>$request->pid
        ]);
        return redirect()->route('navs.index')->with('success','修改导航成功');
    }
    /**
     * 删除导航条
     */
    public function destroy(Request $request,Navs $nav)
    {
        if(!Auth::user()->can('delete')){
            return redirect()->back()->with('danger','你没有该权限');
        }
        if(!$nav->pid){
            return redirect()->back()->with('danger','顶级菜单不能删除,只能修改');
        }
        $nav->delete();
        return redirect()->route('navs.index')->with('success','删除导航成功');
    }
}
