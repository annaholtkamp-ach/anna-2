<html>
<head>
    hi hello  test
</head>
<body>
@foreach($event as $test)
    <a href="{{ route('event.show', $test->id) }}">{{ $test->title }}</a><br>
@endforeach
</body>
</html>
