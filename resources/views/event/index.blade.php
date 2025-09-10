<html>
<head>
    hi hello  test
</head>
<body>
@foreach($event as $test)
    <a href="/events/{{$test->id}}">{{ $test->title }}</a>
@endforeach
</body>
</html>
