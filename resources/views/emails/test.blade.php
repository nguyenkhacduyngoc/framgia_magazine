<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>
 
<body>
<h2>Welcome to the site {{$user['name']}}</h2>
<br/>
{!! Form::open(['route' => 'verifyEmail','method' => 'post']) !!}
    {{--  <a id="submit" href="{!! route('verifyEmail', $user->verifyUser->token) !!}">Verify Email</a>  --}}
    {!! Form::input('text', 'token', $user->verifyUser->token, ['display' => 'None'])  !!}
    {!! Form::button('<i class="">Submit</i>', ['id'=> 'submit', 'type' => 'submit', 'class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
<br/>
</body>
 
</html>