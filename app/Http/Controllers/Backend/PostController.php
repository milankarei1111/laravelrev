<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 路徑為: public/images/
        $origin_add_watermark = 'images/origin_add_watermark.jpg';
        $logo = 'images/logo.jpg';

        $pathArr = array();
        $pathArr['origin_path'] = 'images/test.jpg';
        $pathArr['origin_resize_path'] = 'images/newtest2.jpg';
        $pathArr['watermark_right'] = 'images/watermark_right.jpg';
        $pathArr['watermark_left'] = 'images/watermark_left.jpg';
        $pathArr['origin_widen_path'] = 'images/widen_path.jpg';
        $pathArr['canvas_path'] = 'images/canvas_path.jpg';
        $pathArr['canvas_watermark_path'] = 'images/canvas_watermark_path.jpg';
        $pathArr['examples'] = 'images/examples.jpg';


        // // 讀取資料
        $img = Image::make($pathArr['origin_path']);

        // 測試1 - 修改指定图片的大小
        $img->resize(900, 200);
        // 調整後重新儲存到其他路径
        $img->save($pathArr['origin_resize_path']);

        // 測試2 -插入水印, 水印位置在原图片的右下角,  距离右边距 15 像素,距离下边距 10 像素,
        $img->insert($origin_add_watermark, 'bottom-right', 50, 10);
        $img->save($pathArr['watermark_right']);

        // 測試3 左邊浮水印
        $img = Image::make($pathArr['origin_path'])->resize(900, 200)
                    ->insert($origin_add_watermark, 'bottom-left', 1, 2)
                    ->save($pathArr['watermark_left']);

        // 測試4 加寬1500 並且加入模糊特效
        $img = Image::make($pathArr['origin_path'])->widen(1500)->blur(15);

        $img->save($pathArr['origin_widen_path']);

         // 產生畫布
        $image = Image::canvas(200, 200,'#ff0000');
        $image->save($pathArr['canvas_path']);

        // 產生浮水印
        $image = Image::canvas(280, 280);
        $image->text('text', 150, 20, function ($font) {
            $font->file(5); // 為True Type字體文件或GD庫內部字體之一的1到5之間的整數值。默認值：1
            $font->valign('top');
            $font->align('right');
            $font->color(array(255, 255, 255, 0.3));
        })
        ->insert($origin_add_watermark, 'bottom-right', 10, 15)
        ->resize(200, 200)
        ->save($pathArr['canvas_watermark_path']);

        // create Image from file
            $img = Image::make($logo);
            $img->text('The quick brown fox jumps over the lazy dog.', 50, 100);
            // use callback to define details
            $img->text('Hi', 40, 50, function($font) {
                $font->file('5');
                $font->size(100);
                $font->color('#fdf6e3');
                $font->align('center');
                $font->valign('top');
                $font->angle(10);  // 旋轉角度
            })->save($pathArr['examples']);
        return view('backend.post.index', compact('pathArr'));

        // http直接回傳畫布
        // $img = Image::canvas(200, 300, '#ff0000');
        // // send HTTP header and output image data
        // return $img->response();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd('test');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
