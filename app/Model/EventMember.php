<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventMember extends Model
{
    protected $fillable=['events_id','member_id'];
    /**
     * 关联活动 一对多(反向)
     */
    public function event()
    {
        return $this->belongsTo(Event::class,'events_id','id');
    }
    /**
     * 关联商家账号 多对多
     */
    public function user(){
        return $this->hasOne(Users::class,'id','member_id');
    }
}
