<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;

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

        $event = event::create($validated);

        return redirect()->route('event.show', $event->id)
                        ->with('status', 'Event created!');
    }
    public function edit($id)
    {
        $event = \App\Models\event::find($id);

        return view('event.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        // Step 1: load the correct article from MODEL
        $event = \App\Models\event::find($id);

        // Step 2: Update the changes
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'scheduled_at'=> $request->scheduled_at,
        ]);

        // Redirect to show
        return redirect()->route('event.show', $event->id);
    }
    public function destroy($id)
    {
        // fetch the one article that is requested
        $event = \App\Models\event::find($id);

        $event->delete();

        return redirect()->route('event.index');
    }
}
