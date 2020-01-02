<?php

namespace App\Http\Controllers\Backend;

// use Vimeo\Vimeo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vimeo\Laravel\Facades\Vimeo;

class VideoController extends Controller
{
    const INFORMATION_FIELDS = [
        'uri', 'name', 'description', 'link', 'duration', 'width', 'height', 'embed', 'pictures', 'files', 'download',
        'status', 'upload', 'transcode'
    ];

    //
    public function test()
    {
        $video_id = env('VIMEO_ID');

        $uri = '/videos/'.$video_id;
        // *官方測試呼叫 是否配置成功
        return Vimeo::request('/tutorial', array(), 'GET');

        // 取得影片 $uri=/videos/{video_id}
        return Vimeo::request($uri, array(), 'GET');
        return Vimeo::request($uri.'?fields=link,uri,name,transcode.status'); // fields:指定返回資料, 判斷轉碼狀態: 'fields=transcode.status'

        // *編輯影片標題和描述
            return Vimeo::request($uri, array(
                'name' => date('Y-m-d').'測試修改標題'.date('H:i'),
                'description' => date('Y-m-d').'測試修改'.date('H:i'),
              ), 'PATCH');

        // *上傳影片-目前無權限
        // return Vimeo::upload("videos/test2.mp4", array(
        // "name" => "影片名稱",
        // "description" => "描述"
        // ));
    }

    public function upload(Request $request)
    {
        $file = $request->file('video');
    }
}
