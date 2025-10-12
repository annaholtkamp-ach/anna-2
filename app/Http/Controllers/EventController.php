<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function index()
    {
        $events = \App\Models\event::with('organiser')
            ->orderBy('scheduled_at', 'asc')
            ->get();

        return view('event.index', compact('events'));
    }

    public function show($id)
    {
        // Load the event with organiser and all participants (intentions + their users)
        $event = \App\Models\event::with(['organiser', 'intentions.user'])->findOrFail($id);

        // If a user is logged in, check if they already signed up for this event
        $myIntention = null;
        if (auth()->check()) {
            $myIntention = \App\Models\Intention::where('event_id', $event->id)
                ->where('user_id', auth()->id())
                ->first();
        }

        // Send both variables to the Blade view
        return view('event.show', compact('event', 'myIntention'));
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

        abort_if(! $event->canEditOrDelete(auth()->user()), 403, 'You are not allowed to edit this event.');

        return view('event.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        // Step 1: load the correct event from MODEL
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
        $event = \App\Models\event::findOrFail($id);

        // block if not organiser and not admin
        if (! $event->canEditOrDelete(auth()->user())) {
            abort(403, 'You are not allowed to delete this event.');
        }

        $event->delete();

        return redirect()->route('event.index')
            ->with('status', 'Event deleted!');
    }
}
