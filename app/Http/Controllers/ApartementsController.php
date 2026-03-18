<?php

namespace App\Http\Controllers;

use App\Models\Apartements;
use App\Http\Requests\StoreApartementsRequest;
use App\Http\Requests\UpdateApartementsRequest;

class ApartementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $appartement = Apartements::all();

        var_dump($appartements);
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
    public function store(StoreApartementsRequest $request): RedirectResponse
    {
        
        // Retrieve the validated input data...
        $validated = $request->validated();

        dd($validated);

        $appartement = new Flight;
 
        $appartement->name = $request->name;
 
        $appartement->save();
 
        return redirect('/flights');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartements $apartements)
    {
        //

        dd($appartements);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartements $apartements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartementsRequest $request, Apartements $apartements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartements $apartements)
    {
        //
    }
}
