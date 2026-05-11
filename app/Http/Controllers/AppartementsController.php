<?php

namespace App\Http\Controllers;

use App\Models\Appartements;
use App\Http\Requests\StoreAppartementsRequest;
use App\Http\Requests\UpdateAppartementsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AppartementsController extends Controller
{   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // titre de la page
        $page_data= [
            "label"=>"Appartement",
            "link" => route("appartements.index"),
            "current" => "Index"
        ];

        // colonne du tableau
        $columns = [
            "Code",
            "Type",
            "Surface",
            "Etage",
            "Capacite Max",
            "Date Dernier Nettoyage",
            "Date Derniere Renovation",
            "Observations",
            "Etat",
        ];

        // Valeurs pour la recherche
        $search_column = [
            'route'=>route('appartements.search'),
            'name'=>'Etat',
            'values'=>[
                [
                    'lib'=>'Disponible',
                    'value'=>'Disponible',
                ],
                [
                    'lib'=>'Occupe',
                    'value'=>'Occupe',
                ],
                [
                    'lib'=>'Maintenance',
                    'value'=>'Maintenance',
                ],
            ]
        ];

        // initialiser les donnees de session par defaut
        $sessions = [
            "dateDeb"=>date("Y-m-01"),
            "dateFin"=>date("Y-m-d"),
            "Etat"=>"0",
        ];

        // initialisation des valeurs par defauts
        session($sessions);


        return view("appartements/index",["columns"=>$columns,"title"=>$page_data,'search'=>$search_column]);

    }

    /**
     * Generer a listing of the resource.
     */

    public function generate_id(){
        // recuperer l'identifiant du dernier appartement existant
        $appartement = Appartements::latest()->first();
        // Incrementer puis retourner la chaine de caractere
        // $paddedNumber = sprintf('%04d', $appartement->appartementID+1);
        // dd($appartement,$appartement->AppartementID+1);
        $paddedNumber = ((boolean) $appartement) ? sprintf('%05d', (int) $appartement->AppartementID+1) : sprintf('%05d', 1);


        return response()->json([
            "status"=> (boolean) $appartement,
            "msg" => "Appartement recuperé avec succès",
            "data"=> ['ID'=>"Appart-".$paddedNumber]
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function search(Request $request)
    {
        
        //
        // titre de la page
        $page_data= [
            "label"=>"Appartement",
            "link" => route("appartements.index"),
            "current" => "Index"
        ];

        // colonne du tableau
        $columns = [
            "Code",
            "Type",
            "Surface",
            "Etage",
            "Capacite Max",
            "Date Dernier Nettoyage",
            "Date Derniere Renovation",
            "Etat",
            "Observations",
        ];

        // Valeurs pour la recherche
        $search_column = [
            'route'=>route('appartements.search'),
            'name'=>'Etat',
            'values'=>[
                [
                    'lib'=>'Disponible',
                    'value'=>'Disponible',
                ],
                [
                    'lib'=>'Occupe',
                    'value'=>'Occupe',
                ],
                [
                    'lib'=>'Maintenance',
                    'value'=>'Maintenance',
                ],
            ]
        ];

        // initialiser les donnees de session par defaut
        $sessions = [
            "dateDeb"=>date("Y-m-01",strtotime($request->dateDeb)),
            "dateFin"=>date("Y-m-d",strtotime($request->dateFin)),
            "etat"=>$request->etat,
        ];

        // initialisation des valeurs par defauts
        session($sessions);
        
        return view("appartements/index",["columns"=>$columns,"title"=>$page_data,'search'=>$search_column]);
        
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
        $status = $request->status ?? $request->session()->get('status');

        // dd($dateDeb,$dateEnd);

        $clients = Appartements::where("created_at",">=", date("Y-m-d 00:00:00",strtotime($dateDeb)))
                         ->where("created_at","<=", date("Y-m-d 23:59:59",strtotime($dateEnd)))
                        //  ->where("Statut",$status)
                         ->get();
        
        // $clients = Appartements::all();

        $data = [];

        foreach ($clients as $t) {
            
            $row = [];
            //
            $buttons_details = "<button class=\"btn btn-warning mr-2\" title=\"Details\" data-toggle=\"modal\" data-target=\"#modal-details\" data-id=\"".$t->AppartementID."\" name=\"details\"  type=\"button\"> <i class=\"i-Pen\"></i> Details</button>";
            //
            $button_activate = "<button class=\"btn btn-primary mr-2\" name=\"activer\"  title=\"Rendre Disponible\" data-id=\"".$t->AppartementID."\" data-state=\"1\" data-msg = \"Rendre cet élément disponible ?\" type=\"button\">Disponible</button>";
            //
            $button_maintenance = "<button class=\"btn btn-secondary mr-2\"  name=\"entretien\" title=\"Mettre en maintenance\"  data-id=\"".$t->AppartementID."\" data-state=\"2\" data-msg = \"Mettre cet élément en maintenance ?\" type=\"button\">Maintenance</button>";
            
            $button_deactivate = "<button class=\"btn btn-danger mr-2\"  name=\"desactiver\" title=\"Rendre Indisponible\"  data-id=\"".$t->AppartementID."\" data-state=\"3\" data-msg = \"Rendre cet élément indisponible ?\" type=\"button\">Occupé</button>";
            //liste des boutons
            $buttons = $buttons_details;
            
            $etat = "<span class=\"badge badge-pill badge-default\">Maintenance</span>";

            if($t->Etat == "Disponible"){
                $buttons.= $button_deactivate;
                $etat = "<span class=\"badge badge-pill badge-success\">Disponible</span>";
            }

            if($t->Etat == "Maintenance"){
                $buttons.= $button_activate;
                $etat = "<span class=\"badge badge-pill badge-success\">Maintenance</span>";
            }

            if($t->Etat == "Occupe"){
                $buttons.= $button_maintenance;
                $etat = "<span class=\"badge badge-pill badge-danger\">Occupé</span>";
            }

            

            $row[] = $t->Code;
            $row[] = $t->Type;
            $row[] = $t->Surface;
            $row[] = $t->Etage;
            $row[] = $t->CapaciteMax;
            $row[] = $t->DernierNettoyage;
            $row[] = $t->DateDerniereRenovation;
            $row[] = $t->Observations;
            $row[] = $etat;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppartementsRequest $request)
    {
        
       // The request is already validated and authorized.
        // You can access the validated data using $request->validated()
        $validated = $request->validated();

        $appartement = Appartements::create($validated);

        // return new ClientResource($clients);

        // 3. Optionally, return the created resource using an API Resource class
        // (See Step 3 below for the resource example)
        // return new ProductResource($product);

        // Or return a simple JSON response
        return response()->json([
            "status" => (boolean) $appartement,
            'data' => $appartement,
            'message' => $appartement 
                        ? 'Appartement créé avec succes'
                        : 'Appartement créé avec succes',
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

        $appartement = Appartements::where("AppartementID",$request->id)->first();

        $msg = "Echec recuperation de la ligne";

        if ( (boolean) $appartement) {
            $msg = "Ligne retrouvée avec succès" ;
        }

        return response()->json([
            "status"=> (boolean) $appartement,
            "msg" => $msg,
            "data"=> $appartement
            
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function setState(Request $request)
    {
        
        // dd(!$request->state, intval($request->state) < 0, intval($request->state) > 2);
        // vaidation de la valeur entrante
        if (!$request->state OR (intval($request->state) < 1) OR (intval($request->state) > 3)) {
            return response()->json([
                "status"=>false,
                "msg" => "Revoyez vos parametres"
            ]);
        }

        $values = ["Disponible","Maintenance","Occupé"];

        // dd($request->id,$values[$request->state]);
        //
        $responseState = Appartements::where("AppartementID",$request->id)
                                ->update(["Etat"=> $values[intval($request->state)-1]]);
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
     * Show the form for editing the specified resource.
     */
    public function edit(Appartements $appartements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppartementsRequest $request, $id)
    {
        // dd($request);
        // The $request is already validated.
        $appartement = Appartements::findOrFail($id);

        $response = $appartement->update($request->validated());

        return response()->json([
            'status' => (bool) $response,
            'msg' => $response 
                ? 'Appartement mis à jour avec succès'
                : 'Echec mise à jour'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appartements $appartements)
    {
        //
    }
}
