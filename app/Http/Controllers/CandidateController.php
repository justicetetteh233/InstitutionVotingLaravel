<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\positions;
use Illuminate\Http\RedirectResponse;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vote.candidatesIndex',[
            'positions'=>positions::with('user')->latest()->get(),
            'candidates'=>Candidate::with(['user','position'])->latest()->get()
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
    public function store(Request $request):RedirectResponse
    {
      
        $validatedData = $request->validate([
            'name' =>'required|string|max:255',
            'picture' => 'nullable|image|mimes:png,jpeg,jpg',
            'positions_id'=>'required|string|max:255'
        ]);
       

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $pictureUrl = $file->storeAs('uploads', $fileName, 'public');        } else {
            $pictureUrl = null; 
        }

        unset($validatedData['picture']);

        $validatedData['pictureUrl'] = $pictureUrl;

        // $validatedData['user_id']= auth()->id();

        $request->user()->candidates()->create($validatedData);
        return redirect(route('positions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
