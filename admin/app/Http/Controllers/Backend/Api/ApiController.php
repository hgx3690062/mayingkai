<?php
/**
 * Created by PhpStorm.
 * User: hugangxi
 * Date: 2017/11/18
 * Time: 下午9:30
 */
namespace App\Http\Controllers\Backend\Api;
use App\Http\Controllers\Controller;
use App\Models\Blog\Message;
use App\Models\Blog\Picture;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    /*
   * 首页展示所有的文章
   */
    public function show()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'uid','title', 'content', 'created_at', 'navigation_id', 'status','sum','comment']);
        $lists = $messages->where('status',1)
            ->orderBy('created_at', 'desc')->skip(0)->take(10)->get()->toArray();
        foreach ($lists as &$message) {
            foreach ($message['hasmanynavigation'] as &$hasmanynavigation) {
                $message['navigation'] = isset($hasmanynavigation['name']) ? $hasmanynavigation['name'] : '';
            }
            if($message['uid'] == 1){
                $message['uid'] = '秋季的傍晚';
            }
            if($message['navigation_id'] == 1){
                $message['navigation_lu'] ='phpdetails';
            }else if($message['navigation_id'] == 2){
                $message['navigation_lu'] ='laraveldetails';
            }else if($message['navigation_id'] == 3){
                $message['navigation_lu'] ='gitdetails';
            }else if($message['navigation_id'] == 4){
                $message['navigation_lu'] ='Idetails';
            }else if($message['navigation_id'] == 5){
                $message['navigation_lu'] ='xiandetails';
            }
            unset($message['hasmanynavigation']);
            unset($message['hasmanypicture']);
            $message['content'] = mb_strlen($message['content'], 'utf-8') > 50 ? mb_substr($message['content'], 0, 50, 'utf-8') . '....' : $message['content'];

        }

        return $lists;
    }
    /*
     * 首页所有图片
     */
    public function showimg()
    {
        $pictures = Picture::with('hasmanypicture')->select()->orderBy('created_at','desc')->skip(0)->take(4)->get()->toArray();
        foreach($pictures as &$picture)
        {
            foreach($picture['hasmanypicture'] as $pic)
            {
                $picture['uid'] = isset($pic['uid'])?$pic['uid']:'';
                $picture['mid'] = isset($pic['id'])?$pic['id']:'';
                $picture['navigation_id'] = isset($pic['navigation_id'])?$pic['navigation_id']:'';
                $picture['title'] = isset($pic['title'])?$pic['title']:'';
                $picture['content'] = isset($pic['content'])?$pic['content']:'';
                $picture['status'] = isset($pic['status'])?$pic['status']:'';
                $picture['sum'] = isset($pic['sum'])?$pic['sum']:'';
                $picture['comment'] = isset($pic['comment'])?$pic['comment']:'';
            }
            unset($picture['hasmanypicture']);
        }
        return $pictures;
    }
    /*
     * 首页最新文章
     */
    public function showcat()
    {
        $message = Message::orderBy('created_at','desc')->skip(0)->take(1)->get()->toArray();
        foreach($message as &$mes){
            $mes['content'] = mb_strlen($mes['content'], 'utf-8') > 30 ? mb_substr($mes['content'], 0, 30, 'utf-8') . '....' : $mes['content'];
        }
        return $message;
    }




    /*
     * php api
     */
    public function phpapi()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'uid', 'title', 'content', 'created_at', 'navigation_id', 'status']);
        $lists = $messages->where('status', 1)
            ->where('navigation_id', 1)->orderBy('created_at', 'desc')->skip(0)->take(10)->get()->toArray();
        foreach ($lists as &$message) {
            foreach ($message['hasmanynavigation'] as &$hasmanynavigation) {
                $message['navigation'] = isset($hasmanynavigation['name']) ? $hasmanynavigation['name'] : '';
            }
            foreach ($message['hasmanypicture'] as &$hasmanypicture) {
                $message['picture'] = isset($hasmanypicture['url']) ? $hasmanypicture['url'] : '';
            }
            if ($message['uid'] == 1) {
                $message['uid'] = '秋季的傍晚';
            }
            unset($message['hasmanynavigation']);
            unset($message['hasmanypicture']);
            $message['content'] = mb_strlen($message['content'], 'utf-8') > 200 ? mb_substr($message['content'], 0, 200, 'utf-8') . '....' : $message['content'];

        }
        return $lists;
    }

    /*
     * 最新栏目
     */
    public function artisanphp()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'title', 'content', 'created_at', 'navigation_id','sum','status'])->
        where('status',1)->where('navigation_id',1)->orderBy('created_at','desc')
            ->skip(0)->take(10)->get()->toArray();
        return $messages;
    }

    /*
     * 热门栏目
     */
    public function commentphp()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'title', 'content', 'created_at', 'navigation_id','sum','comment','status'])->where('status',1)->where('navigation_id',1)->orderBy('comment','desc')
            ->skip(0)->take(10)->get()->toArray();
        return $messages;
    }

    /*
     * laravel api
     */
    public function laravelapi()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'uid','title', 'content', 'created_at', 'navigation_id', 'status']);
        $lists = $messages->where('status',1)
            ->where('navigation_id',2)->orderBy('created_at', 'desc')->skip(0)->take(10)->get()->toArray();
        foreach ($lists as &$message) {
            foreach ($message['hasmanynavigation'] as &$hasmanynavigation) {
                $message['navigation'] = isset($hasmanynavigation['name']) ? $hasmanynavigation['name'] : '';
            }
            foreach ($message['hasmanypicture'] as &$hasmanypicture) {
                $message['picture'] = isset($hasmanypicture['url']) ? $hasmanypicture['url'] : '';
            }
            if($message['uid'] == 1){
                $message['uid'] = '秋季的傍晚';
            }
            unset($message['hasmanynavigation']);
            unset($message['hasmanypicture']);
            $message['content'] = mb_strlen($message['content'], 'utf-8') > 200 ? mb_substr($message['content'], 0, 200, 'utf-8') . '....' : $message['content'];

        }
        return $lists;



    }


    /*
     * laravel详情
     */
    public function detailslaravel($id)
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->where('id', $id)->where('status',1)
        ->select(['id', 'title', 'content', 'created_at', 'navigation_id','sum','status'])->get()->toArray();
        foreach ($messages as &$message) {
            foreach ($message['hasmanynavigation'] as &$hasmanynavigation) {
                $message['navigation'] = isset($hasmanynavigation['name']) ? $hasmanynavigation['name'] : '';
                $message['nid'] = isset($hasmanynavigation['id']) ? $hasmanynavigation['id'] : '';
            }
            foreach ($message['hasmanypicture'] as &$hasmanypicture) {
                $message['picture'] = isset($hasmanypicture['url']) ? $hasmanypicture['url'] : '';
            }
            unset($message['hasmanynavigation']);
            unset($message['hasmanypicture']);

        }

        return $messages;

    }


    /*
     * 最新栏目
     */
    public function artisan()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'title', 'content', 'created_at', 'navigation_id','sum','status'])->
        where('status',1)->where('navigation_id',2)->orderBy('created_at','desc')
            ->skip(0)->take(10)->get()->toArray();
        return $messages;
    }


    /*
     * 热门栏目
     */
    public function comment()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'title', 'content', 'created_at', 'navigation_id','sum','comment','status'])->where('status',1)->where('navigation_id',2)->orderBy('comment','desc')
            ->skip(0)->take(10)->get()->toArray();
        return $messages;
    }


    /*
     * git api
     */
    public function gitapi()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'uid','title', 'content', 'created_at', 'navigation_id', 'status']);
        $lists = $messages->where('status',1)
            ->where('navigation_id',3)->orderBy('created_at', 'desc')->skip(0)->take(10)->get()->toArray();
        foreach ($lists as &$message) {
            foreach ($message['hasmanynavigation'] as &$hasmanynavigation) {
                $message['navigation'] = isset($hasmanynavigation['name']) ? $hasmanynavigation['name'] : '';
            }
            foreach ($message['hasmanypicture'] as &$hasmanypicture) {
                $message['picture'] = isset($hasmanypicture['url']) ? $hasmanypicture['url'] : '';
            }
            if($message['uid'] == 1){
                $message['uid'] = '秋季的傍晚';
            }
            unset($message['hasmanynavigation']);
            unset($message['hasmanypicture']);
            $message['content'] = mb_strlen($message['content'], 'utf-8') > 200 ? mb_substr($message['content'], 0, 200, 'utf-8') . '....' : $message['content'];

        }
        return $lists;

    }

    /*
     * 最新栏目
     */
    public function artisangit()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'title', 'content', 'created_at', 'navigation_id','sum','status'])->
        where('status',1)->where('navigation_id',3)->orderBy('created_at','desc')
            ->skip(0)->take(10)->get()->toArray();
        return $messages;
    }

    /*
     * 热门栏目
     */
    public function commentgit()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'title', 'content', 'created_at', 'navigation_id','sum','comment','status'])->where('status',1)->where('navigation_id',3)->orderBy('comment','desc')
            ->skip(0)->take(10)->get()->toArray();
        return $messages;
    }


    /*
     * I api
     */
    public function Iapi()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'uid','title', 'content', 'created_at', 'navigation_id', 'status']);
        $lists = $messages->where('status',1)
            ->where('navigation_id',4)->orderBy('created_at', 'desc')->skip(0)->take(10)->get()->toArray();
        foreach ($lists as &$message) {
            foreach ($message['hasmanynavigation'] as &$hasmanynavigation) {
                $message['navigation'] = isset($hasmanynavigation['name']) ? $hasmanynavigation['name'] : '';
            }
            foreach ($message['hasmanypicture'] as &$hasmanypicture) {
                $message['picture'] = isset($hasmanypicture['url']) ? $hasmanypicture['url'] : '';
            }
            if($message['uid'] == 1){
                $message['uid'] = '秋季的傍晚';
            }
            unset($message['hasmanynavigation']);
            unset($message['hasmanypicture']);
            $message['content'] = mb_strlen($message['content'], 'utf-8') > 200 ? mb_substr($message['content'], 0, 200, 'utf-8') . '....' : $message['content'];

        }
        return $lists;

    }

    /*
     * 最新栏目
     */
    public function artisanI()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'title', 'content', 'created_at', 'navigation_id','sum','status'])->
        where('status',1)->where('navigation_id',4)->orderBy('created_at','desc')
            ->skip(0)->take(10)->get()->toArray();
        return $messages;
    }

    /*
     * 热门栏目
     */
    public function commentI()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'title', 'content', 'created_at', 'navigation_id','sum','comment','status'])->where('status',1)->where('navigation_id',4)->orderBy('comment','desc')
            ->skip(0)->take(10)->get()->toArray();
        return $messages;
    }

    /*
     * xian api
     */
    public function xianapi()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'uid','title', 'content', 'created_at', 'navigation_id', 'status']);
        $lists = $messages->where('status',1)
            ->where('navigation_id',5)->orderBy('created_at', 'desc')->skip(0)->take(10)->get()->toArray();
        foreach ($lists as &$message) {
            foreach ($message['hasmanynavigation'] as &$hasmanynavigation) {
                $message['navigation'] = isset($hasmanynavigation['name']) ? $hasmanynavigation['name'] : '';
            }
            foreach ($message['hasmanypicture'] as &$hasmanypicture) {
                $message['picture'] = isset($hasmanypicture['url']) ? $hasmanypicture['url'] : '';
            }
            if($message['uid'] == 1){
                $message['uid'] = '秋季的傍晚';
            }
            unset($message['hasmanynavigation']);
            unset($message['hasmanypicture']);
            $message['content'] = mb_strlen($message['content'], 'utf-8') > 200 ? mb_substr($message['content'], 0, 200, 'utf-8') . '....' : $message['content'];

        }
        return $lists;

    }

    /*
     * 最新栏目
     */
    public function artisanxian()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'title', 'content', 'created_at', 'navigation_id','sum','status'])->
        where('status',1)->where('navigation_id',5)->orderBy('created_at','desc')
            ->skip(0)->take(10)->get()->toArray();
        return $messages;
    }

    /*
     * 热门栏目
     */
    public function commentxian()
    {
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->
        select(['id', 'title', 'content', 'created_at', 'navigation_id','sum','comment','status'])->where('status',1)->where('navigation_id',5)->orderBy('comment','desc')
            ->skip(0)->take(10)->get()->toArray();
        return $messages;
    }


   //点赞➕1
    public function create()
    {
        $sum = $_POST['sum'];
        $mid =  $_POST['mid'];

        $message = Message::find($mid);
        $message->sum = $sum;
        $message->save();
    }





}