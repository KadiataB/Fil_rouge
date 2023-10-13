<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatemoduleRequest;
use App\Http\Resources\ModuleProfResource;
use App\Models\Cours;
use App\Models\CoursClasse;
use App\Models\CoursSemestre;
use App\Models\module;
use App\Models\Module as ModelsModule;
use App\Models\ModuleProfesseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        public function index()
        {
            $classes=ModelsModule::all();
            return response([
                "message" => "voici les classes",
                "data"=>$classes
            ], Response::HTTP_OK);
        }

        public function getProfesseursByIdModule($id)
        {
            $modProfs= ModuleProfesseur::where("module_id",$id)->get();
            // return $modProfs;
            return response([
                "data"=>ModuleProfResource::collection($modProfs)
            ], Response::HTTP_OK);

        }

        public function store(Request $request)
        {
            $request->validate([
                'module_id' => ['required'],
                'semestre_id' => ['required'],
                'professeur_id' => ['required']
            ]);
          DB::beginTransaction();

          $cours =  Cours::create([
                "module_id"=>$request->module_id,
                "semestre_id"=>$request->semestre_id,
                "professeur_id"=>$request->professeur_id
            ]);

            // $cours->classe->attach($request->classes);
            // $cours->semestre->attach($request->semestres);
            
            CoursClasse::create ([
                "heures"=>$request->heures,
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
    /**
     * Display the specified resource.
     */
    public function show(module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemoduleRequest $request, module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(module $module)
    {
        //
    }
}
