<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{

    public function liste_etudiant(){

        $etudiants = Etudiant::orderBy('id')->paginate(4);


        return view('etudiant.liste', compact('etudiants'));
    }
    
    public function liste_ajouter(){


        return view('etudiant.ajouter');
    }


    public function ajouter_etudiant_traitement(request $Request){
        
        $Request->validate([

            'nom'=>'required',
            'prenom'=>'required',
            'classe'=>'required'
        ]);

    $etudiant= new Etudiant();
    $etudiant->nom= $Request->nom;
    $etudiant->prenom= $Request->prenom;
    $etudiant->classe= $Request->classe;
    $etudiant->save();

    return redirect('/ajouter')->with('status', 'Etudiant a  bien été ajouter ');

    }


public function update_etudiant($id){

    $etudiants= Etudiant::find($id);
    return view('etudiant.update', compact('etudiants'));
}


public function  update_etudiant_traitement(request $Request){

    $Request->validate([

        'nom'=>'required',
        'prenom'=>'required',
        'classe'=>'required',
    ]);

    $etudiant= Etudiant::find($Request->id);
    $etudiant->nom= $Request->nom;
    $etudiant->prenom= $Request->prenom;
    $etudiant->classe= $Request->classe;
    $etudiant->update();

    return redirect('/etudiant')->with('status', 'l\'Etudiant a  bien été modifié ');

}



public function delete_etudiant($id){

$etudiant = Etudiant::find($id);

$etudiant->delete();

return redirect('/etudiant')->with('status', 'l\'Etudiant a  bien été supprimé.');
    
}




}
