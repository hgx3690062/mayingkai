<?php
namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Picture extends Model
{
    use SoftDeletes;
    protected $connection = 'woo';//声明链接哪个数据库
    protected $table = 'picture';//声明链接哪个表
    protected $guarded = [];

    public function hasmanypicture()
    {
        return $this->hasMany('App\Models\Blog\Message','id','relation_id');
    }

}