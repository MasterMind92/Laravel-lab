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
        // titre de la page
        $page_data= [
            "label"=>"Clients",
            "link" => route("clients.index"),
            "current" => "Index"
        ];

        // colonne du tableau
        $columns = [
            "#",
            "Name",
            "Phone",
            "Email",
            "Type Client",
            "Etat",
            "Role",
        ];

        // initialiser les donnees de session par defaut
        $sessions = [
            "dateDeb"=>date("Y-m-01"),
            "dateFin"=>date("Y-m-d"),
            "etat"=>"0",
        ];

        // initialisation des valeurs par defauts
        session($sessions);

        // recuperation de client selon la date
        // $clients = Clients::where("created_at",">=", date("Y-m-01"))
        //                     ->where("created_at","<=", date("Y-m-d"))
        //                     ->get();

        $clients = Clients::all();

        // dd($clients);

        return view("clients/index",["columns"=>$columns,"title"=>$page_data,"clients"=>$clients]);
    }

    /**
     * Display the specified resource.
     */
    public function search(Request $request)
    {
        //

        
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
    public function setState(Request $request)
    {
        //
        dd($request->id,$request->id);
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
