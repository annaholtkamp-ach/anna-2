<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        // load the needed data
        $users = \App\Models\User::all();

        // send to view + return response

        return view('user.index', compact('users'));
    }

    public function show($id)
    {
        $user = \App\Models\User::find($id);

        return view('user.show', compact('user'));
    }
}
