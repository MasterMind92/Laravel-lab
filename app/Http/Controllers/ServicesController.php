<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Http\Requests\StoreServicesRequest;
use App\Http\Requests\UpdateServicesRequest;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // titre de la page
        $page_data= [
            "label"=>"Services",
            "link" => route("services.index"),
            "current" => "Index"
        ];

        // colonne du tableau
        $columns = [
            "#",
            "Libelle",
            "Categorie",
            "PrixUnitaire",
            "DureeMoyenne",
            "UniteFacturation",
        ];

        // Valeurs pour la recherche
        $search_column = [
            'route'=>route('services.search'),
            'name'=>'Etat',
            'values'=>[
                [
                    'lib'=>'En attente',
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
            "dateDeb"=>date("Y-m-01"),
            "dateFin"=>date("Y-m-d"),
            "Statut"=>"0",
        ];

        // initialisation des valeurs par defauts
        session($sessions);

        
        return view("reservations/index",["columns"=>$columns,"title"=>$page_data,"clients"=>Clients::all(),"appartements"=>Appartements::all(),'search'=> $search_column]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        // titre de la page
        $page_data= [
            "label"=>"Services",
            "link" => route("services.index"),
            "current" => "Index"
        ];

        // colonne du tableau
        $columns = [
            "#",
            "Libelle",
            "Categorie",
            "PrixUnitaire",
            "DureeMoyenne",
            "UniteFacturation",
        ];

        // Valeurs pour la recherche
        $search_column = [
            'route'=>route('services.search'),
            'name'=>'Etat',
            'values'=>[
                [
                    'lib'=>'En attente',
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
        
        return view("reservations/index",["columns"=>$columns,"title"=>$page_data,"clients"=>Clients::all(),"appartements"=>Appartements::all(),'search'=> $search_column]);

        
    }

    /**
     * Generer a listing of the resource.
     */

    public function generate_id(){
        // recuperer l'identifiant du dernier appartement existant
        $reservation = Reservations::latest()->first();
        // Incrementer puis retourner la chaine de caractere
        // $paddedNumber = sprintf('%04d', $reservation->appartementID+1);
        // dd($reservation,$reservation->AppartementID+1);
        $paddedNumber = ((boolean) $reservation) ? sprintf('%05d', (int) $reservation->ReservationID+1) : sprintf('%05d', 1);


        return response()->json([
            "status"=> (boolean) $reservation,
            "msg" => "Reference reservation générée avec succès",
            "data"=> ['ID'=>"RES-".date("YmdHis")."-".$paddedNumber]
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function list(Request $request)
    {   
        // mettre en place la reponses de la fonction ajax qui permet
        // de lister clients presents en base selon le parametres date de debut
        // date de fin et Statut
        
        // recuperation des variables
        $dateDeb = $request->dateDeb ?? $request->session()->get('dateDeb');
        $dateEnd = $request->dateEnd ?? $request->session()->get('dateFin');
        $status = $request->status ?? $request->session()->get('status');

        // dd($dateDeb,$dateEnd);

        // $reservations = Reservations::where("created_at",">=", date("Y-m-d 00:00:00",strtotime($dateDeb)))
        //                  ->where("created_at","<=", date("Y-m-d 23:59:59",strtotime($dateEnd)))
        //                 //  ->where("Statut",$status)
        //                  ->get();

        $reservations = Reservations::all();
        
        // $appartement = $reservations[0]->appartement->Code;

        // dd($appartement);

        $data = [];

        foreach ($reservations as $t) {
            
            $row = [];

            $buttons_details = "<button class=\"btn btn-warning mr-2\" title=\"Details\" data-toggle=\"modal\" data-target=\"#modal-details\" data-id=\"".$t->ReservationID."\" name=\"details\"  type=\"button\"> <i class=\"i-Pen\"></i> Details</button>";
            //
            $button_activate = "<button class=\"btn btn-primary mr-2\" name=\"activer\"  title=\"Activer\" data-id=\"".$t->ReservationID."\" type=\"button\">Confirmer</button>";
            //
            $button_deactivate = "<button class=\"btn btn-danger mr-2\"  name=\"desactiver\" title=\"Desactiver\"  data-id=\"".$t->ReservationID."\" type=\"button\">Annuler</button>";
            
            $button_deactivate = "<button class=\"btn btn-success mr-2\"  name=\"terminer\" title=\"terminer\"  data-id=\"".$t->ReservationID."\" type=\"button\">Terminer</button>";
            //liste des boutons
            $buttons = $buttons_details;
            
            $etat = "<span class=\"badge badge-pill badge-danger\">Désactivé</span>";

            if($t->Statut == "1"){
                $buttons.= $button_activate.$button_deactivate;
                $etat = "<span class=\"badge badge-pill badge-warning\">En attente</span>";

            }elseif($t->Statut == "2"){

                $buttons.= $button_deactivate;
                $etat = "<span class=\"badge badge-pill badge-success\">Confirmé</span>";

            }elseif($t->Statut == "3"){
                $buttons.= $button_activate;
                $etat = "<span class=\"badge badge-pill badge-danger\">Annulée</span>";

            }elseif($t->Statut == "4"){

                $etat = "<span class=\"badge badge-pill badge-success\">Terminée</span>";
            }


            // $appartement = $t->Appartement();

            // dd($appartement);
            // $t->Client();

            $row[] = $t->ReservationID;
            $row[] = $t->Numero;
            $row[] = $t->DateArrivee;
            $row[] = $t->DateDepart;
            $row[] = $t->NbAdultes;
            $row[] = $t->NbEnfants;
            $row[] = $t->appartement->Code;
            $row[] = $t->client->Nom." ".$t->client->Prenoms;
            $row[] = $etat;
            // $row[] = $Statut;
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
    public function store(StoreReservationsRequest $request)
    {
        // The request is already validated and authorized.
        // You can access the validated data using $request->validated()
        $validated = $request->validated();

        $reservations = Reservations::create($validated);

        // return new ClientResource($clients);

        // 3. Optionally, return the created resource using an API Resource class
        // (See Step 3 below for the resource example)
        // return new ProductResource($product);

        // Or return a simple JSON response
        return response()->json([
            "status" => (boolean) $reservations,
            'data' => $reservations,
            'msg' => $reservations 
                        ? 'Reservation créée avec succès'
                        : 'Echec Reservation',
        ], 201); // 201 status code for Created
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $reservation = Reservations::where("ReservationID",$request->id)->first();

        $msg = "Echec recuperation de la ligne";

        if ( (boolean) $reservation) {
            $msg = "Ligne retrouvée avec succès" ;
        }

        return response()->json([
            "status"=> (boolean) $reservation,
            "msg" => $msg,
            "data"=> $reservation
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservations $reservations)
    {
        // permettre de recuperer les infos d'une entite 
        // et de les renvoyer a la vue

        $reservations = Reservations::where("ReservationID",$request->id)->first();

        $msg = "Echec récuperation de la ligne";

        if ( (boolean) $reservations) {
            $msg = "Ligne retrouvée avec succès" ;
        }

        return response()->json([
            "status"=> (boolean) $reservations,
            "msg" => $msg,
            "data"=> $reservations
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function setState(Request $request)
    {
        
        // dd(!$request->state, intval($request->state) < 0, intval($request->state) > 2);
        // vaidation de la valeur entrante
        if (!$request->state OR (intval($request->state) < 1) OR (intval($request->state) > 4)) {
            return response()->json([
                "status"=>false,
                "msg" => "Revoyez vos parametres"
            ]);
        }

        // $values = ["Disponible","Maintenance","Occupé"];

        //
        $responseState = Reservations::where("ReservationID",$request->id)
                                ->update(["Statut"=> intval($request->state)]);
        // message par defaut
        $msg = "Mise à jour effectuée avec succes";
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
    public function update(UpdateReservationsRequest $request, $id)
    {
        // The $request is already validated.
        $reservations = Reservations::findOrFail($id);

        $response = $reservations->update($request->validated());

        return response()->json([
            'status' => (bool) $response,
            'msg' => $response 
                ? 'Reservation mis à jour avec succès'
                : 'Echec mise à jour'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservations $reservations)
    {
        //
    }


}
