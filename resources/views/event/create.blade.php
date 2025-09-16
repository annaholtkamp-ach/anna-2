<html>
<head>
   Create Event here
</head>
<div>
    form will be added
    <form action="/event" method="post">
    @csrf
        <div>
            <label for="title"> Title</label><br/>
            <input type="text" name="title">
        </div>
        <div>
            <label for="description">Description</label><br/>
            <textarea name="description" ></textarea>
        </div>
    <br/><br/>
<button type="submit">Create</button>
</form>

</html>
