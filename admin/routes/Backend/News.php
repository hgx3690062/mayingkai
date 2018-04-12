<?php
/**
 * Created by PhpStorm.
 * User: hugangxi
 * Date: 2017/11/10
 * Time: 下午5:18
 */
//系统消息管理
Route::get('newshow','news\NewsController@newshow')->name('newshow');
Route::get('datapost','news\NewsController@datapost')->name('datapost');
//系统消息发布
Route::get('create','news\NewsController@create')->name('create');
Route::post('createpost','news\NewsController@createpost')->name('createpost');


//系统消息删除
Route::delete('del/{id}','news\NewsController@del')->name('del');
//系统消息编辑
Route::get('edit/{id}','news\NewsController@edit')->name('edit');
Route::post('editpost/{id}','news\NewsController@editpost')->name('editpost');

//七牛
Route::get('qiniu','Imgqiniu\QiniuController@index')->name('qiniu');
Route::get('test','Imgqiniu\QiniuController@test')->name('test');
Route::post('qiniupost','Imgqiniu\QiniuController@qiniu')->name('qiniupost');







