<?php

namespace App\Http\Controllers;

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
}
