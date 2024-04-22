<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use App\Models\positions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;


class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
    return view('position',[
        'positions'=>positions::with('user')->latest()->get()
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

        $validated = $request->validate([
            'name' =>'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);        
        // dd('Reached the store method.', $request->all());


        $request->user()->positions()->create($validated);
        return redirect(route('positions.index'));

    }

    

    /**
     * Display the specified resource.
     */
    public function show(positions $positions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(positions $position): View
    {
        // Gate::authorize('update',$positions);
        return view('positionEdit',[
            'position' => $position
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, positions $position) : RedirectResponse
    {
        // Gate::authorize('update',$positions);
        $validated = $request->validate([
            'name' =>'required|string|max:255',
            'description' => 'required|string|max:255'  
        ]);

        // Log the validated data for debugging
        Log::debug('Validated Data:', $validated);

        // Attempt to update the position
        $position->update($validated);

        // Check if the position was updated successfully
        if ($position->wasChanged()) {
            Log::info('Position updated successfully.');
        } else {
            Log::warning('Position update failed or no changes were made.');
        }

        return redirect(route('positions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(positions $position): RedirectResponse
    {   $position->delete();
        return redirect(route('positions.index'));
    }
}
