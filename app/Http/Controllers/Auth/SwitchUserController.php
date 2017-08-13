<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class SwitchUserController extends Controller
{
    /**
     * Display a listing of roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.switchUser');
    }

    public function switch(Request $request)
    {
        // Validate the user
        $this->validate($request, [
            'user' => 'required|exists:users,id',
        ]);
        $user = Auth::loginUsingId($request->input('user'));
        return redirect()->route('home')->with('success', 'Successfully logged in as user: "' . $user->name . '"');
    }
}
