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

</html>
