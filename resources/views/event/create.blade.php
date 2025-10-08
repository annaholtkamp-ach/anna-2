<x-site-layout :title="'Create Event – Connection'">
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
        <div>
          <label for="location">Location</label><br/>
        <input type="text" name="location" value="{{ old('location') }}" required>
        </div>
       <div>
           <button type="submit">Create</button>
       </div>

    </form>

    <br/><br/>

</x-site-layout>
