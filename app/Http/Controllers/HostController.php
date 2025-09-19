<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Host;

class HostController extends Controller
{
    public function index()
    {
        // load the needed data
        $hosts = Host::all();

        // send to view + return response
        return view('host.index', compact('hosts'));
    }

    public function show($id)
    {
        $host = Host::findOrFail($id);
        return view('host.show', compact('host'));
    }

    public function create()
    {
        return view('host.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bio' => 'required|string',
            'user_id' => 'required|exists:users,id|unique:hosts,user_id'
        ]);

        Host::create($validated);

        return redirect()->route('host.index');
    }

    public function edit($id)
    {
        $host = Host::findOrFail($id);
        return view('host.edit', compact('host'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'bio' => 'required|string'
        ]);

        $host = Host::findOrFail($id);
        $host->update($validated);

        return redirect()->route('host.show', $host->id);
    }

    public function destroy($id)
    {
        $host = Host::findOrFail($id);
        $host->delete();

        return redirect()->route('host.index');
    }
}
