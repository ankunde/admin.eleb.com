<?php

namespace App\Http\Controllers;

use App\Model\EventMember;
use Illuminate\Http\Request;

class EventMembersController extends Controller
{
    /**
     * 活动列表
     */
    public function index(){
        $eventmember = EventMember::all();
        return view('eventmember.index',compact('eventmember'));
    }
}
