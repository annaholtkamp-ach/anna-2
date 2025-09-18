<html>
<head>
   Create Event here
</head>

    <form method="POST" action="{{ route('event.store') }}">
        @csrf
        <div>
            <label for="title"> Title</label><br/>
            <input type="text" name="title">
        </div>
        <div>
            <label for="description">Description</label><br/>
            <textarea name="description" ></textarea>
        </div>
        <div><label>Scheduled At</label>
            <input type="datetime-local" name="scheduled_at" required>
        </div>

    </form>

    <br/><br/>
<button type="submit">Create</button>
</form>

</html>
