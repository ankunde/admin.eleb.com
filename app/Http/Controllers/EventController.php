<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Model\EventMember;
use App\Model\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class EventController extends Controller
{
    /**
     * 设置权限
     */
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]
        ]);
    }
    /**
     * 活动列表
     */
    public function index(){
        $event = Event::all();
        return view('event.index',compact('event'));
    }
    /**
     * 查看活动
     */
    public function show(Request $request,Event $event){
        return view('event.show',compact('event'));
    }
    /**
     * 添加活动
     */
    public function create()
    {
        return view('event.create');
    }
    /**
     * 保存添加活动
     */
    public function store(Request $request,Event $event)
    {
        //>>1.验证数据
        $this->validate($request,[
            'title'=>'required|unique:events|max:10',
            'content'=>'required',
            'signup_start'=>'required|before:signup_end',
            'signup_end'=>'required|after:signup_start',
            'prize_date'=>'required|after:signup_end',
            'signup_num'=>'required',
        ],[
            'title.required'=>'活动名称必须填写',
            'title.unique'=>'活动名称已注册',
            'title.max'=>'活动名称已超出10个字',
            'content.required'=>'活动详情必须填写',
            'signup_start.required'=>'报名开始时间必须填写',
            'signup_start.before'=>'报名开始时间必须小于结束时间',
            'signup_end.required'=>'报名结束时间必须填写',
            'signup_end.after'=>'报名结束时间必须大于开始时间',
            'prize_date.required'=>'开奖日期必须填写',
            'prize_date.after'=>'开奖日期必须大于结束时间',
            'signup_num.required'=>'报名人数限制必须填写'
        ]);
        //>>2.保存数据
            Event::create([
                'title'=>$request->title,
                'content'=>$request->content,
                'signup_start'=>$request->signup_start,
                'signup_end'=>$request->signup_end,
                'prize_date'=>$request->prize_date,
                'signup_num'=>$request->signup_num,
                'is_prize'=>$request->is_prize
            ]);
        //>>3.返回列表
        return redirect()->route('events.index')->with('success','添加活动成功');
    }
    /**
     * 回显活动
     */
    public function edit(Request $request,Event $event)
    {
        return view('event.edit',compact('event'));
    }
    /**
     * 跟新活动
     */
    public function update(Request $request,Event $event)
    {
        //>>1.验证数据
        $this->validate($request,[
            'title'=>'required|unique:events|max:10',
            'content'=>'required',
            'signup_start'=>'required|before:signup_end',
            'signup_end'=>'required|after:signup_start',
            'prize_date'=>'required|after:signup_end',
            'signup_num'=>'required',
        ],[
            'title.required'=>'活动名称必须填写',
            'title.unique'=>'活动名称已注册',
            'title.max'=>'活动名称已超出10个字',
            'content.required'=>'活动详情必须填写',
            'signup_start.required'=>'报名开始时间必须填写',
            'signup_start.before'=>'报名开始时间必须小于结束时间',
            'signup_end.required'=>'报名结束时间必须填写',
            'signup_end.after'=>'报名结束时间必须大于开始时间',
            'prize_date.required'=>'开奖日期必须填写',
            'prize_date.after'=>'开奖日期必须大于结束时间',
            'signup_num.required'=>'报名人数限制必须填写'
        ]);
        //>>2.保存数据
        $event->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'signup_start'=>$request->signup_start,
            'signup_end'=>$request->signup_end,
            'prize_date'=>$request->prize_date,
            'is_prize'=>$request->is_prize
        ]);
        //>>3.返回列表
        return redirect()->route('events.index')->with('success','修改活动成功');
    }
    /**
     * 删除已过期的活动
     */
    public function destroy(Request $request,Event $event){
        if(strtotime($event->signup_start)<time()){
           return redirect()->back()->with('danger','当前活动已经开始不能删除');
        }
        $event->delete();
        return redirect()->route('events.index')->with('success','当前活动已经删除');
    }
    /**
     * 开奖
     */
    public function lottery(Request $request,Event $event)
    {
        //>>0.判断当前活动是否开奖
        if($event->is_prize){
            return redirect()->back()->with('danger','当前活动已开奖,不能再次开奖');
        }
        DB::transaction(function () use($event) {
            $id = $event->id;//活动id
            //>>1.查询当前活动
            $event = Event::where('id',$id)->first();
            //>>2.跟改活动开奖状态
            $event->update([
                'is_prize'=>1
            ]);
            //>>3.查询此次活动的所有商品
            $eventprize = EventPrize::where('events_id',$id)->get();
            //>>4.查询此次活动的所有报名人员
            $eventmember = EventMember::where('events_id',$id)->get();
            //>>5.将报名人员压入一个数组
            $member_id = [];
            foreach ($eventmember as $value){
                $member_id[] = $value->member_id;
            }
            //>>6.打乱这个数组
            shuffle($member_id);
            //>>7.遍历所有商品
            foreach($eventprize as $value){
                $value->update([
                    'member_id'=>array_pop($member_id)
                ]);
                //>>8.如果报名人员都有一个奖品,且奖品没发完,停止循环
                if(!isset($eventmember)){
                    break;
                }
            }
        });
        return redirect()->route('events.index')->with('success','活动开奖成功');
    }
}
