<html>
<head>
    hi hello  test
</head>
<body>
@foreach($host as $test)
    <a href="/host/{{$test->id}}">{{ $test->bio }}</a>
@endforeach
</body>
</html>
