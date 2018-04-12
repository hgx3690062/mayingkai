<?php
namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    protected $connection = 'woo';//声明链接哪个数据库
    protected $table = 'message';//声明链接哪个表
    protected $guarded = [];

    public function hasmanypicture()
    {
        return $this->hasMany('App\Models\Blog\Picture','relation_id','id')->select(['relation_id','url','relation_id']);
    }

    public function hasmanynavigation()
    {
        return $this->hasMany('App\Models\Blog\navigation','id','navigation_id')->select(['id','name']);
    }

}