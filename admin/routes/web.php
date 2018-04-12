<?php

/**
 * Global Routes
 * Routes that are used between both frontend and backend.
 */
header( "Access-Control-Allow-Origin:*" );
header( "Access-Control-Allow-Methods:POST,GET" );
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->post('create','App\Http\Controllers\Backend\Api\ApiController@create');
    //首页展示
    $api->get('show','App\Http\Controllers\Backend\Api\ApiController@show');
    //首页图片
    $api->get('showimg','App\Http\Controllers\Backend\Api\ApiController@showimg');
    //首页最新文章
    $api->get('showcat','App\Http\Controllers\Backend\Api\ApiController@showcat');
    //php所有数据
    $api->get('phpapi','App\Http\Controllers\Backend\Api\ApiController@phpapi');
    //最新栏目
    $api->get('artisanphp','App\Http\Controllers\Backend\Api\ApiController@artisanphp');
    //最热栏目
    $api->get('commentphp','App\Http\Controllers\Backend\Api\ApiController@commentphp');

    //laravel所有数据
    $api->get('users', 'App\Http\Controllers\Backend\Api\ApiController@laravelapi');
    //laravel详情
    $api->get('detailslaravel/{id}','App\Http\Controllers\Backend\Api\ApiController@detailslaravel');
    //最新栏目
    $api->get('artisan','App\Http\Controllers\Backend\Api\ApiController@artisan');
    //最热栏目
    $api->get('comment','App\Http\Controllers\Backend\Api\ApiController@comment');

    //git所有数据
    $api->get('gitapi','App\Http\Controllers\Backend\Api\ApiController@gitapi');
    $api->get('artisangit','App\Http\Controllers\Backend\Api\ApiController@artisangit');
    $api->get('commentgit','App\Http\Controllers\Backend\Api\ApiController@commentgit');

    //I所有数据
    $api->get('Iapi','App\Http\Controllers\Backend\Api\ApiController@Iapi');
    $api->get('artisanI','App\Http\Controllers\Backend\Api\ApiController@artisanI');
    $api->get('commentI','App\Http\Controllers\Backend\Api\ApiController@commentI');

    //xian所有数据
    $api->get('xianapi','App\Http\Controllers\Backend\Api\ApiController@xianapi');
    $api->get('artisanxian','App\Http\Controllers\Backend\Api\ApiController@artisanxian');
    $api->get('commentxian','App\Http\Controllers\Backend\Api\ApiController@commentxian');
});



// Switch between the included languages
Route::get('lang/{lang}', 'LanguageController@swap');

/* ----------------------------------------------------------------------- */

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/Frontend/');
});

/* ----------------------------------------------------------------------- */

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    includeRouteFiles(__DIR__.'/Backend/');
});

