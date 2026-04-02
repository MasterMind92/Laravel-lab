<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Http\Requests\StoreClientsRequest;
use App\Http\Resources\ClientResource;
use App\Http\Requests\UpdateClientsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Clients::all(); 
        return view("clients/index");
    }


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request): JsonResponse
    public function store(StoreClientsRequest $request)
    {
        // The request is already validated and authorized.
        // You can access the validated data using $request->validated()
        $validated = $request->validated();

        $clients = Clients::create($validated);

        return new ClientResource($clients);

        // 3. Optionally, return the created resource using an API Resource class
        // (See Step 3 below for the resource example)
        // return new ProductResource($product);

        // Or return a simple JSON response
        // return response()->json([
        //     'message' => 'Client créé avec succes',
        //     'client' => $clients
        // ], 201); // 201 status code for Created

    }

    /**
     * Display the specified resource.
     */
    public function show(Clients $clients)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clients $clients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    public function update(UpdateClientsRequest $request, Clients $clients)
    {
        // dd($request);
        // The $request is already validated.
        $validated = $request->validated();

        // 1. Find the product (using findOrFail to handle not found cases)
        // $client = Clients::findOrFail($id);

        // 3. Update the product attributes
        $clients->update($validated);

        // 4. Return a response using an API Resource
        // return new ClientResource($validated);
        return redirect();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clients $clients)
    {
        //

        
    }
}
