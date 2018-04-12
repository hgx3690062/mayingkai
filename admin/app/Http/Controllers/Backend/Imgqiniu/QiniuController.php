<?php
/**
 * Created by PhpStorm.
 * User: hugangxi
 * Date: 2017/11/14
 * Time: 下午2:13
 */
namespace App\Http\Controllers\Backend\Imgqiniu;
use App\Http\Controllers\Controller;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Illuminate\Http\Request;
class QiniuController extends Controller
{
    public function test()
    {
        $bucket = 'teach';
        $accessKey = 'VX3F8VlHwxIXSSqWGqou6SixDX9_-IlHYBVLM1ly';
        $secretKey = '90hLIZv6K3ci0FyQGNJe2GffbtnW_JOt9HL1JOdJ';
        $auth = new Auth($accessKey, $secretKey);
        $upToken = $auth->uploadToken($bucket);
        return  $upToken ;
    }


    public function index()
    {
        return view('backend.news.test');
    }

}