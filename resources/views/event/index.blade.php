<x-site-layout :title="'Events – Connection'">
@foreach($event as $test)
    <a href="{{ route('event.show', $test->id) }}">{{ $test->title }}</a><br>
@endforeach
</x-site-layout>
