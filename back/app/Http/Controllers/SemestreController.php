<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoresemestreRequest;
use App\Http\Requests\UpdatesemestreRequest;
use App\Http\Resources\SemestreResource;
use App\Models\Semestre;
use Symfony\Component\HttpFoundation\Response;

class SemestreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semestres=Semestre::all();
        return response([
            "message" => "voici les classes",
            "data"=>SemestreResource::collection($semestres)
        ], Response::HTTP_OK);
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
    public function store(StoresemestreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(semestre $semestre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(semestre $semestre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesemestreRequest $request, semestre $semestre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(semestre $semestre)
    {
        //
    }
}
