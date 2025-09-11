<html>
<head>
    hi hello  test
</head>
<body>
@foreach($user as $test)
    <a href="/user/{{$test->id}}">{{ $test->user_name }}</a>
@endforeach
</body>
</html>
