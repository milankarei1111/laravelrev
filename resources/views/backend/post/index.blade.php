<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="title">Laravel image Demo</div>
            <div>
                <p>Origin Image 1221 * 264</p>
                <img src="{{ asset($pathArr['origin_path']) }}"><br/>
            </div>

            <div class="hr"><i class="fa fa-hand-o-down"></i></div>
            <div class="item2">
                <p>Resize To 500 * 100 Image</p>
                <img src="{{  asset($pathArr['origin_resize_path']) }}"><br/>
            </div>

            <div class="hr"><i class="fa fa-hand-o-down"></i></div>
            <div>
                <p>Resize And Add Watermark Image right</p>
                <img src="{{  asset($pathArr['watermark_left']) }}"><br/>
            </div>
            <div>
                <p>Resize And Add Watermark Image left </p>
                <img src="{{  asset($pathArr['watermark_right']) }}"><br/>
            </div>
            <div>
                <p>Resize widen 1500 and blur</p>
                <img src="{{  asset($pathArr['origin_widen_path']) }}"><br/>
            </div>
            <div>
                <p>And canvas</p>
                <img src="{{  asset($pathArr['canvas_path']) }}"><br/>
            </div>
            <div>
                <p>And canvas and Watermark</p>
                <img src="{{  asset($pathArr['canvas_watermark_path']) }}"><br/>
            </div>
            <div class="hr"><i class="fa fa-hand-o-down"></i></div>
            <div>
                <p>And canvas and Watermark</p>
                <img src="{{  asset($pathArr['examples']) }}"><br/>
            </div>
        </div>
    </div>
</body>
</html>


