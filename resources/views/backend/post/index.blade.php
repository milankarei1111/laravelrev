<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{ Form::open(['url' => route('posts.store'), 'method' => 'POST']) }}
    @csrf
    <div class="form-group bol-fileinput-group video-group">
        <label>測試vimeo影片</label>
        <div class="preview video-responsive">
            <iframe src="https://player.vimeo.com/video/381976962" width="1024" height="768" frameborder="0" allow="autoplay; fullscreen" allowfullscreen="" title="Untitled"></iframe>
        </div>

        <span class="btn btn-default btn-md fileinput-button">
            <input class="video-uploader" data-url={{route('videos.upload')}} data-role="videos" data-width="640" data-height="360" accept="video/*" name="video" type="file">
        </span>

        <input type="submit" value="儲存">
       {{Form::close()}}
</body>
</html>


