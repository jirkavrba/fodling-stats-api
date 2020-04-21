<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

class AuthenticationController extends Controller
{
    public function gate(): BaseResponse
    {
        // If the user is already logged in, redirect him to the application instead
        if (Auth::guard()->check())
        {
            return redirect()->route('administration.index');
        }

        // Otherwise return the page with login form
        return response()->view('authentication.gate');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('username', 'password');

        // If the login info provided is correct and matches an user in the database return a redirect to the app
        if (Auth::attempt($credentials, true))
        {
            return redirect()->route('administration.index');
        }

        // Otherwise return back with an error
        return redirect()->back()->withErrors('Bad credentials.');
    }

    public function logout(): RedirectResponse
    {
        // Destroy the user session and return redirect back to login gate
        Auth::logout();

        return redirect()->route('authentication.gate');
    }
}
