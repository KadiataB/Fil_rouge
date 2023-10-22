<?php

namespace App\Http\Controllers;

use App\Http\Resources\CoursResource;
use App\Http\Resources\SessionResource;
use App\Imports\UsersImport;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\CoursClasse;
use App\Models\Inscription;
use App\Models\Module;
use App\Models\ModuleProfesseur;
use App\Models\SessionCours;
use App\Models\User;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    // public function getResponsable()
    // {
    //     $role="responsable";
    //     $user=User::where("role",$role)->get();
    //     return $user;
    // }


    public function import( Request $request)
    {
        $fichier=$request->file('file');
       // Excel::import(new UsersImport, $fichier);

        $eleves=Excel::toArray(new UsersImport,$fichier);
        // return $eleves;
        foreach ($eleves as $e) {
            foreach ($e as $eleve) {
                $el=(new UsersImport)->model($eleve);
                $el->save();
                $id=$el->id;

                Inscription::create([
                    "eleve_id"=>$id,
                    "classe_id"=>$request->classe_id,
                    "annee_scolaire_id"=>$request->annee_scolaire_id
                ]);
                $classe=  Classe::where("id",$request->classe_id)->first();
                $classe->increment('effectif');
              }
          }
          return response()->json([
             "message"=>"inscription réussie",
          ]);
      }

    public function getUsers($role)
    {
      return  User::where("role",$role)->get();
    }

    public function coursByProf($id) {
       return  CoursResource::collection(Cours::where("professeur_id", $id)->get());
    }

    public function sessionsByProf($id) {
      $cours=  Cours::where("professeur_id", $id)->get();
      foreach ($cours as $key ) {
        $cs=  CoursClasse::where("cours_id", $key->id)->get();
        foreach ($cs as $c) {
           $sessions= SessionCours::where("cours_classe_id", $c->id)->get();
           return SessionResource::collection($sessions);
        }
      }
    }
}
