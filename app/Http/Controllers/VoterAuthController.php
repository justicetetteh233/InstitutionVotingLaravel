<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Voter;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class VoterAuthController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.voter-login');
    }


    public function login(Request $request): View | RedirectResponse
    {
    try {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('voter')->attempt($credentials)) {
            // Authentication passed, return the voter dashboard view with the authenticated voter data
            return view('vote.voteCastPage', [
                'voter' => Auth::guard('voter')->user()
            ]);
        }

        // Authentication failed
        throw ValidationException::withMessages(['email' => 'Invalid credentials']);
    } catch (ValidationException $e) {
        // Validation exception occurred (invalid input data)
        return back()->withErrors($e->validator->errors()->all())->withInput();
    }
    }


}
