<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    //

    public function create()
    {
        //
        return inertia(
            'Auth/Login',

        );
    }
    public function store(Request $request)
    {
        //
        if (!Auth::attempt(
            $request->validate([
                'email' => 'required|email|string',
                'password' => 'required|string|',
            ]),
            true
        )) {
            throw ValidationException::withMessages([
                'incorrectEmailOrPass' => 'Incorrect email or password'
            ]);
        }
        $request->session()->regenerate();

        return redirect()->intended();
    }
    public function destroy(Request $request)
    {
        //
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended();
    }
}