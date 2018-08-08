<?php

namespace App\Http\Controllers;

use App\Model\Activity;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ActivityController extends Controller
{

    //用户列表
    public function index(Request $request)//搜索分页时需要用到
    {
        $result = Activity::all();//获取所有数据
        $keyword = $request->keyword;
        $rows = [];
        foreach ($result as $value){//获取所有单条数据
            $start_time =  $value->start_time;
            $start_time = strtotime($start_time);
            $end_time = $value->end_time;
            $end_time = strtotime($end_time);
            if($keyword==1){//活动未开始
                if ($start_time - time()>0){
                    $rows[] = $value;
                }
            }
            elseif($keyword==2){//活动进行中
                if($start_time - time() < 0 && $end_time -time() >0 ){
                    $rows[] = $value;
                }
            }
            elseif ($keyword==3){//活动已过期
                if ($end_time-time()<0){
                    $rows[] = $value;
                }
            }
            else{
                $rows[] = $value;
            }
        }
        return view('activity.index',compact('rows'));
    }
    //添加商家
    public function create()
    {
        return view('activity.create');
    }
    //接受注册信息
    public function store(Request $request)
    {
        //>>1.验证数据
        $this->validate($request,[
            'title'=>'required|max:20',
            'content'=>'required',
            'start_time'=>'required|before:end_time',
            'end_time'=>'required|after:start_time',
        ],[
            'title.required'=>'活动名称必须填写',
            'title.max'=>'活动名称长度不能大于20',
            'content.required'=>'活动内容必须填写',
            'start_time.required'=>'开始时间必须填写必须填写',
            'start_time.before'=>'开始时间必须在结束时间之前',
            'end_time.required'=>'结束时间必须填写必须填写',
            'end_time.after'=>'结束时间必须在开始时间之前'
        ]);
            //>>2.存入数据
            $value = Activity::create([
                'title'=>$request->title,
                'content'=>$request->content,
                'start_time'=>$request->start_time,
                'end_time'=>$request->end_time
            ]);
        //>>3.返回首页
        return redirect()->route('activity.index')->with("success","活动添加成功");
    }
//    查看详细信息
    public function show(Request $request,Activity $activity)
    {
        return view('activity.show',compact('activity'));

    }
    //回显修改列表
    public function edit(Activity $activity)
    {
        return view('activity.edit',compact('activity'));
    }
    //保存修改信息
    public function update(Request $request,Activity $activity)
    {
        $this->validate($request,[
            'title'=>'required|max:20',
            'content'=>'required',
            'start_time'=>'required|before:end_time',
            'end_time'=>'required|after:start_time',
        ],[
            'title.required'=>'活动名称必须填写',
            'title.max'=>'活动名称长度不能大于20',
            'content.required'=>'活动内容必须填写',
            'start_time.required'=>'开始时间必须填写必须填写',
            'start_time.before'=>'开始时间必须在结束时间之前',
            'end_time.required'=>'结束时间必须填写必须填写',
            'end_time.after'=>'结束时间必须在开始时间之前'
        ]);
        $activity->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time
        ]);
        return redirect()->route('activity.index')->with("success","修改活动成功");
    }

    public function destroy(Request $request,Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activity.index')->with('success','删除活动成功');
    }
}
