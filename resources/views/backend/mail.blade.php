<!DOCTYPE html>
<html>
<head>
    <title>Daily Email</title>
</head>
 
<body>
<h2>Hello {{$user['name']}} here is the news for today </h2>
<br/>
    @foreach ($daily_posts as $daily_post)
        <div>
            <a href="{!! route('posts.show', $daily_post->slug ? $daily_post->slug : $daily_post->id) !!}">{!! $daily_post->title !!}</a>
            <img src="{!! $daily_post->img !!}" alt="None">
            <h4>{!! $daily_post->subtitle !!}</h4>
        </div>
    @endforeach
<br/>
</body>
 
</html>