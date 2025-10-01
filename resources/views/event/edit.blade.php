<html>
<head>
   Create Event here
</head>

    <form action="/event/{{$event->id}}" method="post">

        @method('PUT')
        @csrf

        <div>
            <label for="title">Title</label><br/>
            <input type="text" name="title" value="{{$event->title}}">
        </div>

        <div>
            <label for="description">Description</label><br/>
            <textarea name="description" >{{$event->description}}</textarea>
        </div>
        <div><label>Scheduled At</label>
            <input type="datetime-local" name="scheduled_at" required>
        </div>
        <div>
            <label for="location">Location</label><br/>
            <input type="text" name="location" value="{{ old('location') }}" required>
        </div>
        <br/><br/>
        <button type="submit">Update</button>

    </form>


</html>
