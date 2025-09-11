<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HostControler extends Controller
{
    //
    public function index()
    {
        // load the needed data
        $host = \App\Models\host::all();

        // send to view + return response

        return view('host.index', compact( 'host'));
    }

    public function show($id)
    {
        $host = \App\Models\host::find($id);

        return view('host.show', compact('host'));
    }
}
