<?php

namespace App\Http\Controllers;

use App\Models\Fournisseurs;
use App\Http\Requests\StoreFournisseursRequest;
use App\Http\Requests\UpdateFournisseursRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FournisseursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // titre de la page
        $page_data= [
            "label"=>"Fournisseur",
            "link" => route("fournisseurs.index"),
            "current" => "Index"
        ];

        // colonne du tableau
        $columns = [
            "#",
            "Nom",
            "Type",
            "Contact",
            "Téléphone",
            "Email",
            "Adresse",
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


        return view("fournisseurs/index",["columns"=>$columns,"title"=>$page_data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        // titre de la page
        $page_data= [
            "label"=>"Fournisseur",
            "link" => route("fournisseurs.index"),
            "current" => "Index"
        ];

        // colonne du tableau
        $columns = [
            "#",
            "Nom",
            "Type",
            "Contact",
            "Téléphone",
            "Email",
            "Adresse",
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

        
        return view("fournisseurs/index",["columns"=>$columns,"title"=>$page_data]);
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

        $fournisseurs = Fournisseurs::where("created_at",">=", date("Y-m-d 00:00:00",strtotime($dateDeb)))
                         ->where("created_at","<=", date("Y-m-d 23:59:59",strtotime($dateEnd)))
                         ->when($status, function($query, $status){
                                return $query->where("Statut",$status);
                         })->get();

        // dd($fournisseurs);
        
        // $fournisseurs = Fournisseurs::all();

        $data = [];

        foreach ($fournisseurs as $t) {
            
            $row = [];
            //
            $buttons_details = "<button class=\"btn btn-warning mr-2\" title=\"Details\" data-toggle=\"modal\" data-target=\"#modal-details\" data-id=\"".$t->FournisseurID."\" name=\"details\"  type=\"button\"> <i class=\"i-Pen\"></i> Details</button>";
            //
            $button_activate = "<button class=\"btn btn-primary mr-2\" name=\"activer\"  title=\"Activer\" data-id=\"".$t->FournisseurID."\" type=\"button\">Activer</button>";
            //
            $button_deactivate = "<button class=\"btn btn-danger mr-2\"  name=\"desactiver\" title=\"Desactiver\"  data-id=\"".$t->FournisseurID."\" type=\"button\">Desactiver</button>";
            //liste des boutons
            $buttons = $buttons_details;
            
            $etat = "<span class=\"badge badge-pill badge-danger\">Désactivé</span>";

            if($t->Etat == "A"){
                $buttons.= $button_deactivate;
                $etat = "<span class=\"badge badge-pill badge-success\">Activé</span>";
            }

            if($t->Etat == "I"){
                $buttons.= $button_activate;
                $etat = "<span class=\"badge badge-pill badge-danger\">Désactivé</span>";
            }


            $row[] = $t->FournisseurID;
            $row[] = $t->Nom;
            $row[] = $t->Type;
            $row[] = $t->Contact;
            $row[] = $t->Telephone;
            $row[] = $t->Email;
            $row[] = $t->Adresse;
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
    public function store(StoreFournisseursRequest $request)
    {
        // The request is already validated and authorized.
        // You can access the validated data using $request->validated()
        $validated = $request->validated();

        $fournisseurs = Fournisseurs::create($validated);

        // return new ClientResource($fournisseurs);

        // 3. Optionally, return the created resource using an API Resource class
        // (See Step 3 below for the resource example)
        // return new ProductResource($product);

        // Or return a simple JSON response
        return response()->json([
            'status'=> (boolean) $fournisseurs,
            'fournisseurs' => $fournisseurs,
            'msg' => $fournisseurs
                        ? 'Appartement créé avec succes'
                        : 'Appartement créé avec succes',
        ], 201); // 201 status code for Created
    }

   /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // permettre de recuperer les infos d'une entite 
        // et de les renvoyer a la vue

        // dd($request);

        $fournisseurs = Fournisseurs::where("FournisseurID",$request->id)->first();

        $msg = "Echec recuperation de la ligne";

        if ( (boolean) $fournisseurs) {
            $msg = "Ligne retrouvée avec succès" ;
        }

        return response()->json([
            "status"=> (boolean) $fournisseurs,
            "msg" => $msg,
            "data"=> $fournisseurs
            
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
        $responseState = Fournisseurs::where("FournisseurID",$request->id)
                                ->update(["Etat"=> $state]);
        // msg par defaut
        $msg = "Mise a jour effectuee avec succes";
        // msg d'echec
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
     * Show the form for editing the specified resource.
     */
    public function edit(Fournisseurs $fournisseurs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFournisseursRequest $request, string $id)
    {
        // The $request is already validated.
        $validated = $request->validated();

        // 1. Find the product (using findOrFail to handle not found cases)
        $fournisseurs = Fournisseurs::findOrFail($id);

        // 3. Update the product attributes
        $response = $fournisseurs->update($validated);

        // dd($response,$validated,$fournisseurs);

        // 4. Return a response using an API Resource

        $msg = 'Echec mise à jour Fournisseur';
        if((boolean) $response){
            $msg = 'Fournisseur mis à jour avec succès';

        }
        
        return response()->json([
            'status' => (boolean) $response,
            'msg' => $msg
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fournisseurs $fournisseurs)
    {
        //
    }
}
