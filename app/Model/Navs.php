<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class Navs extends Model
{
    protected $fillable=['id','name','url','permission_id','pid'];
    //菜单管理权限,一对多(反向)
    public function permission()
    {
        return $this->belongsTo(Permission::class,'permission_id','id');

    }
    /**
     * 1级菜单和2级菜单的关系为一对多
     */
    public function children(){
        return $this->hasMany(self::class,'pid','id');
    }
    //>>显示目录
    public static function getNavHtml()
    {
        $html = '';
        foreach (self::where('pid', 0)->get() as $value) {
            $html_children = '';
            foreach ($value->children as $val) {
                if (Auth::user()->can($val->permission->name)) {
                    $html_children .= '<li><a href="' . route($val->url) . '">' . $val->name . '</a></li>';
                }
            }
            if(empty($html_children)){
                continue;
            }
            $html .= '<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $value->name . '<span class="caret"></span></a>
                            <ul class="dropdown-menu">';

            $html .= $html_children;
            $html .= '</ul></li>';
        }
        return $html;
    }
}
