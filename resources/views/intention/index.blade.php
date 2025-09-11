<html>
<head>
    hi hello  test
</head>
<body>
@foreach($intention as $test)
    <a href="/intention/{{$test->id}}">{{ $test->intention_text }}</a>
@endforeach
</body>
</html>
