<?php
/**
 * Created by PhpStorm.
 * User: hugangxi
 * Date: 2017/11/21
 * Time: 下午3:29
 */
Route::get('commentindex','news\CommentController@commentindex')->name('commentindex');
Route::get('commentpost','news\CommentController@commentpost')->name('commentpost');