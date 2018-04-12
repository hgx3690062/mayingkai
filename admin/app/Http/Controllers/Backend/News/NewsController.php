<?php
namespace App\Http\Controllers\Backend\News;

use App\Http\Controllers\Controller;
use App\Models\Blog\Message;
use App\Models\Blog\Navigation;
use App\Models\Blog\Picture;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /*
     * 系统消息发布
     */
    public function newshow()
    {
        return view('backend.news.newshow', compact('messages'));
    }

    /*
     * 系统消息展示
     */
    public function datapost(Request $req)
    {
//        $req = $req->all();
//        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->select(['id', 'title', 'content', 'created_at', 'navigation_id', 'status']);
//
//        $offset = $req['offset'];
//        $limit = $req['limit'];
//        $status = $req['status'];
//        if ($status == 1) {
//            $messages->where('status', 1);
//        }
//        if ($status == 2) {
//            $messages->where('status', 0);
//        }
//
//        if ($name = $req['title']) {
//            $messages->where('title', 'like', "%$name%");
//        }
//        $start = $req['start_time'];
//        //截止时间
//        $end = $req['end_time'];
//        if ($start && $end) {
//            //whereBetween 查询在某某之间
//            $messages->whereBetween('created_at', [$start, $end]);
//        }
//
//        $total = $messages->count();
//        $lists = $messages->skip($offset)->take($limit)->orderBy('created_at', 'desc')->get()->toArray();
//        foreach ($lists as &$message) {
//            foreach ($message['hasmanynavigation'] as &$hasmanynavigation) {
//                $message['navigation'] = isset($hasmanynavigation['name']) ? $hasmanynavigation['name'] : '';
//            }
//            foreach ($message['hasmanypicture'] as &$hasmanypicture) {
//                $message['picture'] = isset($hasmanypicture['url']) ? $hasmanypicture['url'] : '';
//            }
//            unset($message['hasmanynavigation']);
//            unset($message['hasmanypicture']);
//            if ($message['status'] == 1) {
//                $message['statuss'] = '已发布';
//            } else if ($message['status'] == 0) {
//                $message['statuss'] = '未发布';
//            }
//            $message['content'] = mb_strlen($message['content'], 'utf-8') > 10 ? mb_substr($message['content'], 0, 11, 'utf-8') . '....' : $message['content'];
//
//        }
        $total=[];
        $lists=3;
        return ['total' => $total, 'rows' => $lists];
    }



    /*
     * 系统消息编辑发布
     */
    public function create()
    {

        return view('backend.news.create', compact(''));
    }


    /*
     * 系统消息入库
     */
    public function createpost(Request $req)
    {
        try {
            //编辑发布入库
            $content = str_replace(array("<p>", "<strong>", "<br/>", "</p>", "</strong>"), "", $req->names);
            $message = new Message();
            $message->uid = 1;
            $message->navigation_id = $req['navigation_id'];
            $message->title = $req['first_name'];
            $message->content = $content;
            $message->status = $req['status'];
            $message->save();

            if ($req['filename'] != '') {
                //图片URL入库
                $picture = new Picture();
                $picture->url = $req['filename'];
                $picture->type = 1;
                $picture->relation_id = $message->id;
                $picture->relation_table = 'message';
                $picture->save();
            }
        } catch (\Exception $e) {
            return '发布失败';
        }
        return redirect('admin/newshow');


    }


    /*
     * 系统消息删除
     */
    public function del($id)
    {
        $message = Message::find($id);
        $message->delete();
        if ($message->trashed()) {
            return return_json(2000, '删除成功');
        }
        return return_json(1000, '删除失败');
    }


    /*
     * 系统消息编辑
     */
    public function edit($id)
    {
        $message = Message::find($id);
        $messages = Message::with('hasmanypicture', 'hasmanynavigation')->where('id', $id)->
        select(['id', 'title', 'content', 'created_at', 'navigation_id', 'status'])->get()->toArray();
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
        return view('backend.news.edit', compact('messages'));
    }

    /*
     * 系统消息编辑入库
     */
    public function editpost(Request $req, $id)
    {
        try {
            $message = Message::find($id);
            $content = ltrim(str_replace(array("<p>", "<strong>", "<br/>", "</p>", "</strong>", "&nbsp;"), "", $req->names));

            $message->uid = 1;
            $message->navigation_id = $req['navigation_id'];
            $message->title = $req['title'];
            $message->content = $content;
            $message->status = $req['status'];
            $message->save();
            if ($req['filename'] != '') {
                //图片URL入库
                $pictures = Picture::where('relation_id', $id)->first();
                if ($pictures == null) {
                    $picture = new Picture();
                    $picture->url = $req['filename'];
                    $picture->type = 1;
                    $picture->relation_id = $message->id;
                    $picture->relation_table = 'message';
                    $picture->save();
                } else {
                    $pictures->url = $req['filename'];
                    $pictures->save();
                }
            }
        } catch (\Exception $e) {
            return '发布失败';
        }
        return redirect('admin/newshow');


    }


}


