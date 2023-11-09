<?php

namespace App\Http\Controllers;

use App\Http\Resources\CoursClasseResource;
use App\Http\Resources\CoursResource;
use App\Models\Cours;
use App\Models\CoursClasse;
use App\Models\CoursSemestre;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Symfony\Component\HttpFoundation\Response;

class CourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours= Cours::all();

        return response([
            "message" => "voici les cours",
            "data"=>CoursResource::collection($cours)
        ], Response::HTTP_OK);

    }

    public function getClasses($id)
    {
        $classes= CoursClasse::where("cours_id",$id)->get();
        return response([
            "message" => "voici les classes",
            "data"=>CoursClasseResource::collection($classes)
        ], Response::HTTP_OK);
    }
    public function coursClasses($idCours,$idClasse)
    {
        $coursClasses= CoursClasse::where([["cours_id",$idCours],["classe_id",$idClasse]])->get();
        return response([
            "message" => "voici les classes",
            "data"=>$coursClasses
        ], Response::HTTP_OK);
    }

    public function all()
    {
        $all=CoursClasse::all();
        return response([
            "message" => "voici",
            "data"=>$all
        ], Response::HTTP_OK);
    }
    /**
     * Show the form for creating a new resource.
     */


     public static function heureInSeconds($heure)
     {
         $secondes=$heure* 3600;
         return $secondes;
     }
     public function store(Request $request)
     {
         $request->validate([
             'module_id' => ['required'],
             'semestre_id' => ['required'],
             'professeur_id' => ['required']
         ]);
         $existingCours = Cours::where('module_id', $request->module_id)
         ->where('semestre_id', $request->semestre_id)
         ->where('professeur_id', $request->professeur_id)
         ->first();

     if ($existingCours) {
         return response([
             "message" => "Ce cours existe déjà."
         ], Response::HTTP_CONFLICT);
     }
       DB::beginTransaction();

       $cours =  Cours::create([
        "module_id"=>$request->module_id,
        "semestre_id"=>$request->semestre_id,
        "professeur_id"=>$request->professeur_id,
        "heures"=>$this->heureInSeconds($request->heures),
         ]);

         // $cours->classe->attach($request->classes);
         // $cours->semestre->attach($request->semestres);

         CoursClasse::create ([

             "classe_id"=>$request->classe_id,
             "cours_id"=>$cours->id
         ]);
         CoursSemestre:: create([
             "semestre_id"=>$request->semestre_id,
             "cours_id"=>$cours->id
         ]);

         DB::commit();

         return response([
             "message" => "insertion reussie",
             "data"=>$cours
         ], Response::HTTP_ACCEPTED);
     }
    public function findByModule($module)
    {
      $module= Module::where("libelle", $module)->first();
        if ($module) {
            $cours= Cours::where("module_id", $module->id)->get();
            if (count($cours) > 0) {
                   return response([
                       "message" => "voici les cours",
                       "data"=>CoursResource::collection($cours)
                   ], Response::HTTP_OK);
               }
        }else {
            return response([
                "message" => "Ce module n'existe pas",
            ]);
        }
    }


    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */

}
