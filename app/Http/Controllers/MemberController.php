<?php

namespace App\Http\Controllers;

use App\Model\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $search = [];
        if($request->keyword){
            $search[] = ['username','like',"%{$request->keyword}%"];
        }
        if($request->tel){
            $search[] = ['tel','like',"%{$request->tel}%"];
        }
        $where['username']=$request->keyword;
        $where['tel']=$request->tel;
        if($search){
            $member = Member::where($search)->paginate(5);
        }else{
            $member = Member::paginate(5);
        }
        return view('member.index',compact('member','where'));
    }

    public function status(Request $request,Member $member)
    {
        $member->update([
            'status'=>$request->status
        ]);
        if($request->status){
            return redirect()->back()->with('success','启用成功');
        }else{
            return redirect()->back()->with('success','禁用成功');
        }
    }
}
