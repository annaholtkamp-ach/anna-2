<html>
<div>
    <div> Title:
        {{$event->title}}
    </div>
    <div> Description:
        {{$event->description}}
    </div>
    <div> Scheduled at:
        {{$event->scheduled_at}}
    </div>
    <div> Location:
        {{$event->location}}
    </div>
</div>

<form action="{{ route('event.destroy', $event->id) }}" method="post">
    @method('DELETE')
    @csrf
    <button>DELETE</button>
</form>

<br>
<a href="{{ route('event.edit', $event->id) }}">
    <button type="button">Edit</button>
</a>
<br>
</html>
