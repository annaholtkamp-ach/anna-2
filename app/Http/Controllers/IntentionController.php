<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intention;

class IntentionController extends Controller
{
    public function index()
    {
        // load the needed data
        $intentions = Intention::all();

        // send to view + return response
        return view('intention.index', compact('intentions'));
    }

    public function show($id)
    {
        $intention = Intention::findOrFail($id);
        return view('intention.show', compact('intention'));
    }

    public function create()
    {
        return view('intention.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id'
        ]);

        Intention::create($validated);

        return redirect()->route('intention.index');
    }

    public function edit($id)
    {
        $intention = Intention::findOrFail($id);
        return view('intention.edit', compact('intention'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'type' => 'required|string'
        ]);

        $intention = Intention::findOrFail($id);
        $intention->update($validated);

        return redirect()->route('intention.show', $intention->id);
    }

    public function destroy($id)
    {
        $intention = Intention::findOrFail($id);
        $intention->delete();

        return redirect()->route('intention.index');
    }
}
