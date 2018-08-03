<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    protected $fillable=['events_id','name','description','member_id'];
    /**
     * 关联活动 一对多(反向)
     */
    public function event()
    {
        return $this->belongsTo(Event::class,'events_id','id');
    }
    /**
     * 关联商家账号 一对一
     */
    public function user(){
        return $this->hasOne(User::class,'member_id','id');
    }
}
