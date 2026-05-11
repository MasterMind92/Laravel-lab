<?php

namespace App\Http\Controllers;

use App\Models\Employes;
use App\Http\Requests\StoreEmployesRequest;
use App\Http\Requests\UpdateEmployesRequest;
use Illuminate\Http\Request;

class EmployesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //
        // titre de la page
        $page_data= [
            "label"=>"Employés",
            "link" => route("employes.index"),
            "current" => "Index"
        ];

        // colonne du tableau
        $columns = [
            "#",
            "Matricule",
            "Nom",
            "Prénom",
            "Poste",
            "Email",
            "Téléphone",
            "DateEmbauche",
            "Statut",
        ];

        // Valeurs pour la recherche
        $search_column = [
            'route'=>route('employes.search'),
            'name'=>'Etat',
            'values'=>[
                [
                    'lib'=>'Inactif',
                    'value'=>'I',
                ],
                [
                    'lib'=>'Actif',
                    'value'=>'A',
                ],
            ]
        ];

        // initialiser les donnees de session par defaut
        $sessions = [
            "dateDeb"=>date("Y-m-01"),
            "dateFin"=>date("Y-m-d"),
            "Statut"=>false,
        ];

        // initialisation des valeurs par defauts
        session($sessions);

        

        return view("employes/index",["columns"=>$columns,"title"=>$page_data, 'search'=>$search_column]);
    }

    /**
     * Display the specified resource.
     */
    public function search(Request $request)
    {
        
        //
        // titre de la page
        $page_data= [
            "label"=>"Employés",
            "link" => route("employes.index"),
            "current" => "Index"
        ];

        // colonne du tableau
        $columns = [
            "#",
            "Matricule",
            "Nom",
            "Prénom",
            "Poste",
            "Email",
            "Téléphone",
            "DateEmbauche",
            "Statut",
        ];

        // initialiser les donnees de session par defaut
        $sessions = [
            "dateDeb"=>date("Y-m-01",strtotime($request->dateDeb)),
            "dateFin"=>date("Y-m-d",strtotime($request->dateFin)),
            "Statut"=>$request->Statut,
        ];

        // Valeurs pour la recherche
        $search_column = [
            'route'=>route('employes.search'),
            'name'=>'Etat',
            'values'=>[
                [
                    'lib'=>'Inactif',
                    'value'=>'I',
                ],
                [
                    'lib'=>'Actif',
                    'value'=>'A',
                ],
            ]
        ];

        // initialisation des valeurs par defauts
        session($sessions);

        
        return view("employes/index",["columns"=>$columns,"title"=>$page_data, 'search'=> $search_column]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployesRequest $request)
    {
        // The request is already validated and authorized.
        // You can access the validated data using $request->validated()
        $validated = $request->validated();

        $employes = Employes::create($validated);

        // return new ClientResource($employes);

        // 3. Optionally, return the created resource using an API Resource class
        // (See Step 3 below for the resource example)
        // return new ProductResource($product);

        // Or return a simple JSON response
        return response()->json([
            'commande' => $employes,
            'msg' => $employes 
                    ? 'Employe crée avec succès'
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

        $employes = Employes::where("EmployeID",$request->id)->first();

        $msg = "Echec récupération de la ligne";

        if ( (boolean) $employes) {
            $msg = "Ligne retrouvée avec succès" ;
        }

        return response()->json([
            "status"=> (boolean) $employes,
            "msg" => $msg,
            "data"=> $employes
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function setState(Request $request)
    {
        // dd($request);
        //
        $validatedData = $request->validate([
            'state' => ['required', 'in:1,0'],
        ]);

        $state = $request->state ? 'A': 'I';
        //
        $responseState =  Employes::where("EmployeID",$request->id)
                                ->update(["Statut"=> $state]);
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

        $employes = Employes::where("created_at",">=", date("Y-m-d 00:00:00",strtotime($dateDeb)))
                         ->where("created_at","<=", date("Y-m-d 23:59:59",strtotime($dateEnd)))
                         ->when($status, function($query, $status){
                                return $query->where("Statut",$status);
                         })->get();

        // dd($employes);
        
        // $employes = Employes::all();

        $data = [];

        foreach ($employes as $t) {
            
            $row = [];
            //
            $buttons_details = "<button class=\"btn btn-warning mr-2\" title=\"Details\" data-toggle=\"modal\" data-target=\"#modal-details\" data-id=\"".$t->EmployeID."\" name=\"details\"  type=\"button\"> <i class=\"i-Pen\"></i> Details</button>";
            //
            $button_activate = "<button class=\"btn btn-primary mr-2\" name=\"activer\"  title=\"Actif\" data-id=\"".$t->EmployeID."\" type=\"button\">Actif</button>";
            
            $button_deactivate = "<button class=\"btn btn-danger mr-2\"  name=\"desactiver\" title=\"Inactif\"  data-id=\"".$t->EmployeID."\" type=\"button\">Inactif</button>";
           
            //liste des boutons
            $buttons = $buttons_details;
            
            $etat = "<span class=\"badge badge-pill badge-danger\">Désactivé</span>";

            if($t->Statut == "I"){
                $buttons.= $button_activate;
                $etat = "<span class=\"badge badge-pill badge-danger\">Inactif</span>";
            }

            if($t->Statut == "A"){
                $buttons.= $button_deactivate;
                $etat = "<span class=\"badge badge-pill badge-success\">Actif</span>";
            }

            $row[] = $t->EmployeID;
            $row[] = $t->Matricule;
            $row[] = $t->Nom;
            $row[] = $t->Prenom;
            $row[] = $t->Poste;
            $row[] = $t->Email;
            $row[] = $t->Telephone;
            $row[] = $t->DateEmbauche;
            // $row[] = $t->Statut;
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
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployesRequest $request, String $id)
    {
        // The $request is already validated.
        $validated = $request->validated();

        // 1. Find the product (using findOrFail to handle not found cases)
        $employes = Employes::findOrFail($id);

        // 3. Update the product attributes
        $response = $employes->update($validated);

        // dd($response,$validated,$employes);

        // 4. Return a response using an API Resource

        $msg = 'Echec mise à jour Employé';
        if((boolean) $response){
            $msg = 'Employé mis à jour avec succès';

        }
        
        return response()->json([
            'status' => (boolean) $response,
            'msg' => $msg
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employes $employes)
    {
        //
    }
}
