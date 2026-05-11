<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Http\Requests\StorecommandeRequest;
use App\Http\Requests\UpdatecommandeRequest;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // titre de la page
        $page_data= [
            "label"=>"Commande",
            "link" => route("commande.index"),
            "current" => "Index"
        ];

        // colonne du tableau
        $columns = [
            "#",
            "Reference",
            "Date Commande",
            "Date Livraison Prévue",
            "Date Livraison Réelle",
            "Statut",
            "Montant Total",
        ];

        // initialiser les donnees de session par defaut
        $sessions = [
            "dateDeb"=>date("Y-m-01"),
            "dateFin"=>date("Y-m-d"),
            "Statut"=>false,
        ];

        // Valeurs pour la recherche
        $search_column = [
            'route'=>route('commande.search'),
            'name'=>'Etat',
            'values'=>[
                [
                    'lib'=>'Initié',
                    'value'=>'0',
                ],
                [
                    'lib'=>'En cours de livraison',
                    'value'=>'1',
                ],
                [
                    'lib'=>'Livré',
                    'value'=>'2',
                ],
                [
                    'lib'=>'Annulé',
                    'value'=>'3',
                ],
                
            ]
        ];

        // initialisation des valeurs par defauts
        session($sessions);

        // $commande = Commande::all();

        return view("commande/index",["columns"=>$columns,"title"=>$page_data,'search'=> $search_column]);
    }

    /**
     * Display the specified resource.
     */
    public function search(Request $request)
    {
        
        //
        // titre de la page
        $page_data= [
            "label"=>"Commande",
            "link" => route("commande.index"),
            "current" => "Index"
        ];

        // colonne du tableau
        $columns = [
            "#",
            "Reference",
            "Date Commande",
            "Date Livraison Prévue",
            "Date Livraison Réelle",
            "Statut",
            "Montant Total",
        ];

        // Valeurs pour la recherche
        $search_column = [
            'route'=>route('commande.search'),
            'name'=>'Etat',
            'values'=>[
                [
                    'lib'=>'Initié',
                    'value'=>'0',
                ],
                [
                    'lib'=>'En cours de livraison',
                    'value'=>'1',
                ],
                [
                    'lib'=>'Livré',
                    'value'=>'2',
                ],
                [
                    'lib'=>'Annulé',
                    'value'=>'3',
                ],
                
            ]
        ];

        // initialiser les donnees de session par defaut
        $sessions = [
            "dateDeb"=>date("Y-m-01",strtotime($request->dateDeb)),
            "dateFin"=>date("Y-m-d",strtotime($request->dateFin)),
            "Statut"=>$request->Statut,
        ];

        // initialisation des valeurs par defauts
        session($sessions);

        
        return view("commande/index",["columns"=>$columns,"title"=>$page_data,'search'=> $search_column]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecommandeRequest $request)
    {
        // The request is already validated and authorized.
        // You can access the validated data using $request->validated()
        $validated = $request->validated();

        $commande = Commande::create($validated);

        // return new ClientResource($commande);

        // 3. Optionally, return the created resource using an API Resource class
        // (See Step 3 below for the resource example)
        // return new ProductResource($product);

        // Or return a simple JSON response
        return response()->json([
            'commande' => $commande,
            'msg' => $commande 
                    ? 'Commande crée avec succès'
                    : 'Echec création commande',
        ], 201); // 201 status code for Created
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        // permettre de recuperer les infos d'une entite 
        // et de les renvoyer a la vue

        // dd($request);

        $commande = Commande::where("CommandeID",$request->id)->first();

        $msg = "Echec recuperation de la ligne";

        if ( (boolean) $commande) {
            $msg = "Ligne retrouvée avec succès" ;
        }

        return response()->json([
            "status"=> (boolean) $commande,
            "msg" => $msg,
            "data"=> $commande
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function setState(Request $request)
    {
        //
        $validatedData = $request->validate([
            'state' => ['required', 'numeric'],
        ]);

        //
        $responseState =  Commande::where("CommandeID",$request->id)
                                ->update(["Statut"=> $request->state]);
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

        $commande = Commande::where("created_at",">=", date("Y-m-d 00:00:00",strtotime($dateDeb)))
                         ->where("created_at","<=", date("Y-m-d 23:59:59",strtotime($dateEnd)))
                         ->when($status, function($query, $status){
                                return $query->where("Statut",$status);
                         })->orderBy('created_at','DESC')
                         ->get();

        // dd($commande);
        
        // $commande = Commande::all();

        $data = [];

        foreach ($commande as $t) {
            
            $row = [];
            // bouton details commande
            $buttons_details = "<button class=\"btn btn-warning mr-2\" title=\"Details\" data-toggle=\"modal\" data-target=\"#modal-details\" data-id=\"".$t->CommandeID."\" name=\"details\"  type=\"button\"> <i class=\"i-Pen\"></i> Details</button>";
            // bouton commande en cours
            $button_activate = "<button class=\"btn btn-primary mr-2\" name=\"activer\"  title=\"En cours de livraison\" data-id=\"".$t->CommandeID."\" type=\"button\">En cours</button>";
            // bouton commande livree
            $button_deactivate = "<button class=\"btn btn-success mr-2\"  name=\"desactiver\" title=\"Livré\"  data-id=\"".$t->CommandeID."\" type=\"button\">Livré</button>";
            // bouton commande annuler
            $button_annule = "<button class=\"btn btn-danger mr-2\" name=\"annuler\"  title=\"Activer\" data-id=\"".$t->CommandeID."\" type=\"button\">Annuler</button>";
            //liste des boutons
            $buttons = $buttons_details;
            
            // etat par defaut 
            $etat = "<span class=\"badge badge-pill badge-danger\">Désactivé</span>";
            // commande annulee
            if($t->Statut == "3"){
                // Affichage etat annulép
                $etat = "<span class=\"badge badge-pill badge-danger\">Annulé</span>";
            }

            // commande livree
            if($t->Statut == "2"){
                // affichage etat livree
                $etat = "<span class=\"badge badge-pill badge-success\">Livré</span>";
            }

            // commande en cours
            if($t->Statut == "1"){
                // ajout bouton cmd livree + ajout bouton cmd annulee
                $buttons.= $button_deactivate.$button_annule;
                // affichhage etat en cours
                $etat = "<span class=\"badge badge-pill badge-primary\">En cours</span>";
            }

            // commande initiee
            if($t->Statut == "0"){
                $buttons.= $button_activate.$button_deactivate.$button_annule;
                $etat = "<span class=\"badge badge-pill badge-warning\">Initié</span>";
            }


            $row[] = $t->CommandeID;
            $row[] = $t->Reference;
            $row[] = $t->DateCommande;
            $row[] = $t->DateLivraisonPrévue;
            $row[] = $t->DateLivraisonRéelle;
            // $row[] = $t->Statut;
            $row[] = $etat;
            $row[] = $t->MontantTotal;
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
     * Update the specified resource in storage.
     */
    public function update(UpdatecommandeRequest $request, String $id)
    {
        //

        // The $request is already validated.
        $validated = $request->validated();

        // 1. Find the product (using findOrFail to handle not found cases)
        $commande = Commande::findOrFail($id);

        // 3. Update the product attributes
        $response = $commande->update($validated);

        // dd($response,$validated,$commande);

        // 4. Return a response using an API Resource

        $msg = 'Echec mise à jour Commande';
        if((boolean) $response){
            $msg = 'Commande mis à jour avec succès';

        }
        
        return response()->json([
            'status' => (boolean) $response,
            'msg' => $msg
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        //
    }
}
