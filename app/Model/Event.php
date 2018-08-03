<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title','content','signup_start','signup_end','prize_date','signup_num','is_prize'];
    /**
     * 关联奖品表 关系 一对多
     */
    public function event_prize()
    {
        return $this->hasMany(EventPrize::class,'events_id','id');
    }
    /**
     * 关联报名表 关系一对多
     */
    public function event_member()
    {
        return $this->hasMany(EventMember::class,'events_id','id');
    }
}
