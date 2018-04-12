<?php
namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Navigation extends Model
{
    use SoftDeletes;
    protected $connection = 'woo';//声明链接哪个数据库
    protected $table = 'navigation';//声明链接哪个表
    protected $guarded = [];

}