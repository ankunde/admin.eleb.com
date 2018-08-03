<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Model\EventPrize;
use Illuminate\Http\Request;

class EventPrizesController extends Controller
{
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
        $eventprize = EventPrize::all();
        return view('eventprize.index',compact('eventprize'));
    }
    /**
     * 查看活动
     */
    public function show(Request $request,EventPrize $eventprize){
        return view('eventprize.show',compact('eventprize'));
    }
    /**
     * 添加活动
     */
    public function create()
    {
        //>>1.查询活动表
        $event = Event::all();
        return view('eventprize.create',compact('event'));
    }
    /**
     * 保存添加活动
     */
    public function store(Request $request)
    {
        //>>1.验证数据
        $this->validate($request,[
            'name'=>'required|unique:event_prizes|max:10',
            'events_id'=>'required',
            'description'=>'required'
        ],[
            'name.required'=>'活动名称必须填写',
            'name.unique'=>'活动名称已注册',
            'name.max'=>'活动名称已超出10个字',
            'events_id.required'=>'活动必须选择',
            'description.required'=>'活动详情必须填写'
        ]);
        //>>2.保存数据
        EventPrize::create([
            'name'=>$request->name,
            'events_id'=>$request->events_id,
            'description'=>$request->description,
//            'member_id'=>$request->member_id,
        ]);
        //>>3.返回列表
        return redirect()->route('eventprizes.index')->with('success','添加活动商品成功');
    }
    /**
     * 回显活动
     */
    public function edit(Request $request,EventPrize $eventprize)
    {
        //>>1.查询活动表
        $event = Event::all();
        return view('eventprize.edit',compact('eventprize','event'));
    }
    /**
     * 跟新活动
     */
    public function update(Request $request,EventPrize $eventprize)
    {
        //>>1.验证数据
        $this->validate($request,[
            'name'=>'required|unique:event_prizes|max:10',
            'description'=>'required',
            'events_id'=>'required',
        ],[
            'name.required'=>'活动商品名称必须填写',
            'name.unique'=>'活动商品名称已注册',
            'name.max'=>'活动商品名称已超出10个字',
            'description.required'=>'活动商品详情必须填写',
            'events_id.required'=>'活动必须选则'
        ]);
        //>>2.保存数据
        $eventprize->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'events_id'=>$request->events_id
        ]);
        //>>3.返回列表
        return redirect()->route('eventprizes.index')->with('success','修改活动商品成功');
    }
    /**
     * 删除已过期的活动
     */
    public function destroy(Request $request,EventPrize $eventprize){
        $eventprize->delete();
        return redirect()->route('eventprize.index')->with('success','当前活动商品已经删除');
    }
}
