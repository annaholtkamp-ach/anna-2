<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Intention;

class IntentionController extends Controller
{
    //
    public function index()
    {
        // load the needed data
        $intention = \App\Models\intention::all();

        // send to view + return response
        return view('intention.index', compact( 'intention'));
    }

    public function show($id)
    {
        $intention = \App\Models\intention::find($id);

        return view('intention.show', compact('intention'));
    }


    public function store(Request $request, event $event)
    {
        $data = $request->validate([
            'intention_text' => ['required','string','max:255'],
            'category'       => ['nullable','string','max:50'],
            'is_permanent'   => ['sometimes','boolean'],
        ]);

        Intention::updateOrCreate(
            ['event_id' => $event->id, 'user_id' => auth()->id()],
            [
                'intention_text' => $data['intention_text'],
                'category'       => $data['category'] ?? null,
                'is_permanent'   => (bool)($data['is_permanent'] ?? false),
            ]
        );

        return redirect()->route('event.show', $event->id)
            ->with('success', 'You signed up for this event.');
    }


    public function update(Request $request, event $event, Intention $intention)
    {
        abort_unless($intention->user_id === auth()->id() || auth()->user()->isAdmin(), 403);

        $data = $request->validate([
            'intention_text' => ['required','string','max:255'],
            'category'       => ['nullable','string','max:50'],
            'is_permanent'   => ['sometimes','boolean'],
        ]);

        $intention->update([
            'intention_text' => $data['intention_text'],
            'category'       => $data['category'] ?? null,
            'is_permanent'   => (bool)($data['is_permanent'] ?? false),
        ]);

        return redirect()->route('event.show', $event->id)
            ->with('success', 'Your intention was updated.');

    }


    public function destroy(event $event, Intention $intention)
    {
        abort_unless($intention->user_id === auth()->id() || auth()->user()->isAdmin(), 403);

        $intention->delete();

        return redirect()->route('event.show', $event->id)
            ->with('success', 'You withdrew from this event.');

    }

}
