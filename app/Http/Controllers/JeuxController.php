<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JeuxController extends Controller
{   
    function index() {
        return view('jeux');
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

        $id = DB::table('jeux')->insertGetId( //envoie dans la BDD // ATENTIOn! verifier les liens en haut de page (ctrl+space à la fin de l'élément)
            $validateData
        );

        $validateData["id"] = $id;

        return json_encode($validateData);
    }

    function all()
    {
        $jeux = DB::table('jeux')->get();
        return $jeux;
    }

    function del()
    { 
        $del = DB::table('jeux')->where($id)->delete();
        return $del;
        // $jeux = DB::table('jeux')->get();
        // return $jeux;
    }
}