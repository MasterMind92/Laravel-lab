<?php

namespace App\Http\Controllers;

use App\Models\Inventaires;
use App\Http\Requests\StoreInventairesRequest;
use App\Http\Requests\UpdateInventairesRequest;
use Illuminate\Http\Request;

class InventairesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // titre de la page
        $page_data= [
            "label"=>"Inventaire",
            "link" => route("inventaire.index"),
            "current" => "Index"
        ];

        // colonne du tableau
        $columns = [
            "#",
            "Reference",
            "Libelle",
            "Categorie",
            "QuantiteStock",
            "SeuilMin",
            "Localisation",
            "Etat",
            "Date",
        ];

        // initialiser les donnees de session par defaut
        $sessions = [
            "dateDeb"=>date("Y-m-01"),
            "dateFin"=>date("Y-m-d"),
            "Statut"=>false,
        ];

        // initialisation des valeurs par defauts
        session($sessions);


        return view("clients/index",["columns"=>$columns,"title"=>$page_data]);
    }

    /**
     * Display the specified resource.
     */
    public function search(Request $request)
    {
        
        //
        // titre de la page
        $page_data= [
            "label"=>"Inventaire",
            "link" => route("inventaire.index"),
            "current" => "Index"
        ];

        // colonne du tableau
        $columns = [
            "#",
            "Reference",
            "Libelle",
            "Categorie",
            "QuantiteStock",
            "SeuilMin",
            "Localisation",
            "Etat",
            "Date",
        ];

        // initialiser les donnees de session par defaut
        $sessions = [
            "dateDeb"=>date("Y-m-01",strtotime($request->dateDeb)),
            "dateFin"=>date("Y-m-d",strtotime($request->dateFin)),
            "Statut"=>$request->Statut,
        ];

        // initialisation des valeurs par defauts
        session($sessions);

        
        return view("clients/index",["columns"=>$columns,"title"=>$page_data]);
        
    }

    /**
     * Display the specified resource.
     */
    public function list(Request $request)
    {   
        // mettre en place la reponses de la fonction ajax qui permet
        // de lister clients presents en base selon le parametres date de debut
        // date de fin et etat
        
        // recuperation des variables
        $dateDeb = $request->dateDeb ?? $request->session()->get('dateDeb');
        $dateEnd = $request->dateEnd ?? $request->session()->get('dateFin');
        $status = $request->status ?? $request->session()->get('Statut');

        $inventaire = Inventaires::where("created_at",">=", date("Y-m-d 00:00:00",strtotime($dateDeb)))
                         ->where("created_at","<=", date("Y-m-d 23:59:59",strtotime($dateEnd)))
                         ->when($status, function($query, $status){
                                return $query->where("Statut",$status);
                         })->get();

        // dd($inventaire);
        
        // $inventaire = Inventaires::all();

        $data = [];

        foreach ($inventaire as $t) {
            
            $row = [];
            //
            $buttons_details = "<button class=\"btn btn-warning mr-2\" title=\"Details\" data-toggle=\"modal\" data-target=\"#modal-details\" data-id=\"".$t->ClientID."\" name=\"details\"  type=\"button\"> <i class=\"i-Pen\"></i> Details</button>";
            //
            $button_activate = "<button class=\"btn btn-primary mr-2\" name=\"activer\"  title=\"Activer\" data-id=\"".$t->ClientID."\" type=\"button\">Activer</button>";
            //
            $button_deactivate = "<button class=\"btn btn-danger mr-2\"  name=\"desactiver\" title=\"Desactiver\"  data-id=\"".$t->ClientID."\" type=\"button\">Desactiver</button>";
            //liste des boutons
            $buttons = $buttons_details;
            
            $etat = "<span class=\"badge badge-pill badge-danger\">Désactivé</span>";

            if($t->Statut == "A"){
                $buttons.= $button_deactivate;
                $etat = "<span class=\"badge badge-pill badge-success\">Activé</span>";
            }

            if($t->Statut == "I"){
                $buttons.= $button_activate;
                $etat = "<span class=\"badge badge-pill badge-danger\">Désactivé</span>";
            }


            $row[] = $t->ClientID;
            $row[] = $t->Nom;
            $row[] = $t->Telephone;
            $row[] = $t->Email;
            $row[] = $t->TypeClient;
            $row[] = $etat;
            $row[] = $t->created_at;
            $row[] = $buttons;

            $data[] = $row;
        }

        // puis afficher la reponse finale
        $output = [
            "draw" => (int) html_entity_decode(0),
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => $data,
        ];

        echo json_encode($output);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventairesRequest $request)
    {
        //
        // The request is already validated and authorized.
        // You can access the validated data using $request->validated()
        $validated = $request->validated();

        $inventaire = Inventaires::create($validated);

        return new ClientResource($inventaire);

        // 3. Optionally, return the created resource using an API Resource class
        // (See Step 3 below for the resource example)
        // return new ProductResource($product);

        // Or return a simple JSON response
        // return response()->json([
        //     'message' => 'Client créé avec succes',
        //     'client' => $inventaire
        // ], 201); // 201 status code for Created
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // permettre de recuperer les infos d'une entite 
        // et de les renvoyer a la vue

        // dd($request);

        $client = Inventaires::where("ClientID",$request->id)->first();

        $msg = "Echec recuperation de la ligne";

        if ( (boolean) $client) {
            $msg = "Ligne retrouvée avec succès" ;
        }

        return response()->json([
            "status"=> (boolean) $client,
            "msg" => $msg,
            "data"=> $client
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function setState(Request $request)
    {
        //

        $state = ($request->state) ? "A":"I" ;

        //
        $responseState = Inventaires::where("ClientID",$request->id)
                                ->update(["Statut"=> $state]);
        // message par defaut
        $msg = "Mise a jour effectuee avec succes";
        // message d'echec
        if($responseState != true){
            $msg = "Echec mise a jour";
        }

        // reponse de fin
        return response()->json([
            "status"=>$responseState,
            "msg" => $msg
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventairesRequest $request, string $id)
    {
        // The $request is already validated.
        $validated = $request->validated();

        // 1. Find the product (using findOrFail to handle not found cases)
        $inventaire = Inventaires::findOrFail($id);

        // 3. Update the product attributes
        $response = $inventaire->update($validated);

        // dd($response,$validated,$inventaire);

        // 4. Return a response using an API Resource

        $msg = 'Echec mise à jour Client';
        if((boolean) $response){
            $msg = 'Client mis à jour avec succès';

        }
        
        return response()->json([
            'status' => (boolean) $response,
            'msg' => $msg
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventaires $inventaires)
    {
        //
    }
}
