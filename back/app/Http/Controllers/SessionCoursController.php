<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoresessionCoursRequest;
use App\Http\Requests\UpdatesessionCoursRequest;
use App\Http\Resources\SessionResource;
use App\Models\Classe;
use App\Models\ClasseSession;
use App\Models\Cours;
use App\Models\CoursClasse;
use App\Models\SessionCours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SessionCoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $sessions= SessionCours::all();
       return response([
        "message" => "voici les sessions de cours",
        "data"=>SessionResource::collection($sessions)
    ], Response::HTTP_ACCEPTED);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function secondesVersHeuresMinutes($secondes)
    // {
    //     $heures = floor($secondes / 3600);
    //     $minutes = floor(($secondes % 3600) / 60);

    //     return [
    //         'heures' => $heures,
    //         'minutes' => $minutes
    //     ];
    // }

    // public function heuresMinutesVersSecondes($heures, $minutes)
    // {
    //     $secondes = ($heures * 3600) + ($minutes * 60);

    //     return $secondes;
    // }

    public function create(Request $request)
    {
        DB::beginTransaction();

       $c= CoursClasse::where("cours_id",$request->cours_id)->get();
     $session = SessionCours::create([
            "date"=>$request->date,
            "hd"=>$request->hd,
            "hf"=>$request->hf,
            "duree"=>$request->duree,
            "cours_classe_id"=>$c[0]->id,
            "mode"=>$request->mode,
        ]);

        ClasseSession::create([
            "classe_id"=>$request->classe_id,
            "session_cours_id"=>$session->id,
            "salle_id"=>$request->salle_id,
        ]);

        DB::commit();

        return response([
            "message" => "insertion reussie",
            "data"=>$session
        ], Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresessionCoursRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(sessionCours $sessionCours)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sessionCours $sessionCours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesessionCoursRequest $request, sessionCours $sessionCours)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sessionCours $sessionCours)
    {
        //
    }
}
