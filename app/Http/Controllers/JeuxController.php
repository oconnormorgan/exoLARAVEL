<?php

namespace App\Http\Controllers;

use App\Jeux;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JeuxController extends Controller
{   
    function index() {
        return view('jeux');
    }

    function displayJeu($id) {
        $data = Jeux::find($id);
        return view('jeu',['data'=>$data]);
    }

    function add(Request $request)
    {
        
        $validateData = Validator::make(  //verifie les informations vis-a-vis de la BDD
            $request->all(),
            [
                'nom' => 'required', //"required" -> ce champs est obligatoire
                'editeur' => 'required',
                'prix' => 'required',
                'description' => 'required'
            ],
            [
                'required' => 'Le champs :attribute est requis', // :attribute renvoie le champs / l'id de l'element en erreure
            ]
        )->validate();

        $id = Jeux::create( //Autre maniere d'envoyer les information [en lien avec le fichier Jeux.php (dans app/)]
            $validateData
        )->id; // ->save() -> envoie les données au serveur // ->id -> envoie les données au serveur et renvoie l'id // ici $id = id

        $validateData["id"] = $id;

        return json_encode($validateData);
    }

    function all()
    {
        
        $jeux = Jeux::all();
        return $jeux;
    }

    function del(Request $request)
    { 
        $validateData = Validator::make(  //verifie les informations vis-a-vis de la BDD
            $request->all(),
            [
                'id' => 'required'
            ],
            [
                'required' => 'Le champs :attribute est requis', // :attribute renvoie le champs / l'id de l'element en erreure
            ]
        )->validate();

        $status = Jeux::find($validateData['id'])->delete();

        $id = $request->input('id');

        $del["status"] = $status?'ok':'errorDB';
        $del["id"] = $id;

        return json_encode($del);
    }
}