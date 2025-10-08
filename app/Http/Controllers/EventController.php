<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function index()
    {
        // load the needed data
        $event = \App\Models\event::all();

        // send to view + return response

        return view('event.index', compact('event'));
    }

    public function show($id)
    {
        $event = \App\Models\Event::find($id);

        return view('event.show', compact('event'));
    }

    public function create()
    {
        return view('event.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'scheduled_at' => 'required|date',
            'location'     => 'required|string|max:255',
        ]);
        $event = \App\Models\event::create($validated + [
                'user_id' => Auth::id(),
            ]);

        return redirect()->route('event.show', $event->id)
            ->with('status', 'Event created!');

        $event = event::create($validated);

        return redirect()->route('event.show', $event->id)
                        ->with('status', 'Event created!');
    }
    public function edit($id)
    {
        $event = \App\Models\event::findOrFail($id);

        abort_if(! $event->canEditOrDelete(auth()->user()), 403);

        return view('event.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        // Step 1: load the correct article from MODEL
        $event = \App\Models\event::find($id);

        // Step 2: validate the incoming request data
        $request->validate([
            'title' => ['required', 'string', 'max:25', 'min:10'],
            'description' => ['required', 'string'],
            'scheduled_at' => ['required','date'],
            'location'     => ['required','string'],
        ]);

        // Step 3: Update the changes
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'scheduled_at'=> $request->scheduled_at,
            'location'     => $request->location,
        ]);


        // Redirect to show
        return redirect()->route('event.show', $event->id)
                        ->with('status', 'Event updated!');
    }
    public function destroy($id)
    {
        // fetch the one article that is requested
        $event = \App\Models\event::find($id);

        $event = \App\Models\event::findOrFail($id);

        $event->delete();

        return redirect()->route('event.index');
    }
}
