<?php

namespace App\Http\Controllers;

use App\Model\Menus;
use App\Model\OrderGoods;
use App\Model\Orders;
use App\Model\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]
        ]);
    }

    public function order(Request $request){
        $shop = Shops::where('status',1)->get();
        $arr = [];
        foreach ($shop as $v){
            $time = date('Y-m-d',time());
            $time1 = date('Y-m',time());
            $day = Orders::where([['shop_id',$v->id],['created_at','like',"%{$time}%"]])->count();
            $v['day']=$day;
            $month = Orders::where([['shop_id',$v->id],['created_at','like',"%{$time1}%"]])->count();
            $v['mouth']=$month;
            $count = Orders::where('shop_id',$v->id)->count();
            $v['count']=$count;
            $arr[] = $v;
        }
        usort($arr,function($a,$b){
            return  -($a['count']<=>$b['count']);
        });
        return view('count/order',compact('shop','total'));

    }
    public function order_month(Request $request)
    {
        $shop_create_min_time = substr(Shops::min('created_at'),0,4);
        $now_time = date('Y',time());
        $years = [];
        for($i=$shop_create_min_time;$i<=$now_time;++$i){
            $years[] = $i;
        }
        $year = date('Y',time());
        $month = date('m',time());
        if($request->year>$year){
            return redirect()->back()->with('danger','不能查看未来的订单');
        }
        if($request->month){
            $month = $request->month;
        }
        if($request->year){
            $year = $request->year;
        }
        $year_month =$year.'-'.$month ;

        $order =  DB::select("select s.shop_name,sum(o.shop_id) as sum  from `orders` as o join `shops` as s on s.id=o.shop_id where o.created_at like '%{$year_month}%' order by sum desc limit 0,10");
        return view('count/order_month',compact('years','order','year','month'));
    }
    public function order_day (Request $request)
    {
        $time = date('Y-m-d',time());
        if($time<$request->day){
            return redirect()->back()->with('danger','不能查看未来的订单');
        }
        if($request->day){
            $time = $request->day;
        }
        $day =  DB::select("select s.shop_name,sum(o.shop_id) as sum  from `orders` as o join `shops` as s on s.id=o.shop_id where o.created_at like '%{$time}%' order by sum desc limit 0,10");
        return view('count/order_day',compact('day','time'));
    }

    public function menu ()
    {
        $menu = Menus::all();
        $arr = [];
        foreach ($menu as &$v){
            $time = date('Y-m-d',time());
            $day = OrderGoods::select('amount')->where([['goods_id',$v->id],['created_at','like',"%{$time}%"]])->sum('amount');
            $v['day']=$day;
            $time1 = date('Y-m',time());
            $mouth = OrderGoods::select('amount')->where([['goods_id',$v->id],['created_at','like',"%{$time1}%"]])->sum('amount');
            $v['mouth']=$mouth;
            $count = OrderGoods::select('amount')->where([['goods_id',$v->id]])->sum('amount');
            $v['count']=$count;
            $arr[] = $v;
        }
        usort($arr,function($a,$b){
            return  -($a['count']<=>$b['count']);
        });
        return view('count/menu',compact('menu'));
    }
    public function menu_month (Request $request)
    {
        $min_year = Menus::min('created_at');
        $now_time = date('Y',time());
        $years = [];
        for($i=substr($min_year,0,4);$i<=$now_time;++$i){
            $years[] = $i;
        }
        $year = date('Y',time());
        $month = date('m',time());
        if($request->year > $year){
            return redirect()->back()->with('danger','不能查看未来的菜品销量');
        }
        if($request->year){
            $year = $request->year;
        }
        if($request->month){
            $month = $request->month;
        }
        $year_month =$year.'-'.$month ;
        $menu = DB::select("select s.shop_name,m.goods_name,sum(g.goods_id) as sum from `menuses` as m join `shops` as s on s.id=m.shop_id join `order_goods` as g on g.goods_id=m.id where g.created_at like '%{$year_month}%' group by g.goods_id order by sum desc limit 0,10");
        return view('count/menu_month',compact('menu','years','year','month'));
    }
    public function menu_day (Request $request)
    {
        $time = date('Y-m-d',time());
        if($time<$request->day){
            return redirect()->back()->with('danger','不能查看未来的菜品销量');
        }
        if($request->day){
            $time = $request->day;
        }
        $day = DB::select("select s.shop_name,m.goods_name,sum(g.goods_id) as sum from `menuses` as m join `shops` as s on s.id=m.shop_id join `order_goods` as g on g.goods_id=m.id where g.created_at like '%{$time}%' group by g.goods_id order by sum desc limit 0,10");
        return view('count/menu_day',compact('day','time'));
    }
}
