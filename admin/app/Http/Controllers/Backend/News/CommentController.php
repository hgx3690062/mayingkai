<?php
/**
 * Created by PhpStorm.
 * User: hugangxi
 * Date: 2017/11/21
 * Time: 下午3:27
 */

namespace App\Http\Controllers\Backend\News;


use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /*
     * 评论管理
     */
    public function  commentindex()
    {
        return view('backend.comment.commentindex');
    }

    /*
     * 评论赋值
     */
    public function commentpost()
    {

    }
}