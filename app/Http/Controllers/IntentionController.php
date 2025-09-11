<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
