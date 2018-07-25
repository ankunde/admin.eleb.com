<?php

namespace App\Http\Controllers;

use App\Model\ShopCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopCategoriesController extends Controller
{
    //用户列表
    public function index()//搜索分页时需要用到
    {

        $rows = ShopCategories::all();
        return view('shop_categories.index',compact('rows'));
    }
    //添加商家
    public function create()
    {
        return view('shop_categories.create');
    }
    //接受注册信息
    public function store(Request $request)
    {
//        $storage = Storage::disk('oss');
//        第一个参数为上传到服务器的地址,第二个为自己选择的图片
//        $imgputh = $storage->putFile('ShopCategories',$request->img);
//        //>>1.验证数据
        $this->validate($request,[
            'name'=>'required|max:10',
            'img'=>'required',
            'status'=>'required'
        ],[
            'name.required'=>'分类名必须填写',
            'name.max'=>'分类长度不能大于10',
            'img.required'=>'图片必选选择',
            'status'=>'状态必须选择'
        ]);
        //>>2.存入数据
        ShopCategories::create([
            'name'=>$request->name,
            'img'=>$request->img,
            'status'=>$request->status
        ]);
        //>>3.返回首页
        return redirect()->route('shopcategories.index')->with("success","分类添加成功");
    }
    //查看详细信息
    public function show(Request $request,ShopCategories $shopcategory)
{
    return view('shop_categories.show',compact('shopcategory'));
}
    //回显修改列表
    public function edit(Request $request,ShopCategories $shopcategory)
    {
        return view('shop_categories.edit',compact('shopcategory'));
    }
    //保存修改信息
    public function update(Request $request,ShopCategories $shopcategory)
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
            $data['img']=$path;
        }
        //>>2.修改数据
        $shopcategory->update($data);
        //>>3.返回首页
        return redirect()->route('shopcategories.index')->with("success","修改分类成功");
    }

    public function destroy(Request $request,ShopCategories $shopcategory)
    {
        $shopcategory->delete();
        return redirect()->route('shopcategories.index')->with('success','删除分类成功');
    }
}
