<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $fillable=['goods_name','rating','shop_id','category_id','goods_price','description','month_sales','rating_count','tips','satisfy_count','satisfy_rate','goods_img'];
    public function menucategories()
    {
        return $this->belongsTo(MenuCategories::class,'category_id','id');
    }

    public function shops()
    {
        return $this->belongsTo(Shops::class,'shop_id','id');
    }
}
