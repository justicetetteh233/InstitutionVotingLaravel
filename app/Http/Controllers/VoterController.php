<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('vote.votersIndex',[
            'voters'=>Voter::with('user')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|max:255|min:8', 
            'email' => 'required|string|max:255',
        ]);
    
        $validatedData['password'] = Hash::make($validatedData['password']); 
    
        $request->user()->voters()->create($validatedData);
    
        return redirect()->route('voters.index');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Voter $voter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voter $voter):View
    {
        return view('vote.votersEdit',[
            'voter' => $voter
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voter $voter):RedirectResponse
    {
        $validatedData = $request->validate([
            'name' =>'required|string|max:255',
            'password' =>'required|string|max:255',
            'email' =>'required|string|max:255',
        ]);
        $voter->update($validatedData);
        return redirect(route('voters.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voter $voter):RedirectResponse
    {
        $voter->delete();
        return redirect(route('voters.index'));
    }

    // public function castvote(voter $voter):View
    // {
    //     return view('vote.voteCastPage',[
    //         'voter'=>$voter
    //     ]);
    // }

    // public function login(Request $request)
    // {
    // $credentials = $request->validate([
    //     'email' => 'required|email',
    //     'password' => 'required',
    // ]);

    // if (Auth::attempt($credentials, true, 'voters')) {
    //     return redirect('voters.castvote');
    // }

    // return back()->withErrors(['email' => 'Invalid credentials']);
    // }



}
