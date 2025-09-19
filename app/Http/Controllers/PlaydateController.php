<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playdate;

class PlaydateController extends Controller
{
    public function index()
    {
        $playdates = Playdate::all();
        return view('playdates.index', compact('playdates'));
    }

    public function show($id)
    {
        $playdate = Playdate::findOrFail($id);
        return view('playdates.show', compact('playdate'));
    }

    public function create()
    {
        return view('playdates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required'
        ]);

        Playdate::create($validated);

        return redirect()->route('playdates.index');
    }

    public function edit($id)
    {
        $playdate = Playdate::findOrFail($id);
        return view('playdates.edit', compact('playdate'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required'
        ]);

        $playdate = Playdate::findOrFail($id);
        $playdate->update($validated);

        return redirect()->route('playdates.show', $playdate->id);
    }

    public function destroy($id)
    {
        $playdate = Playdate::findOrFail($id);
        $playdate->delete();

        return redirect()->route('playdates.index');
    }
}