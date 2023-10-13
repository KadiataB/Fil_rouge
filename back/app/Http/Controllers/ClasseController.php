<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreclasseRequest;
use App\Http\Requests\UpdateclasseRequest;
use App\Http\Resources\CLasseResource;
use App\Models\classe;
use App\Models\Classe as ModelsClasse;
use Symfony\Component\HttpFoundation\Response;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes=ModelsClasse::all();
        return response([
            "message" => "voici les classes",
            "data"=>CLasseResource::collection($classes)
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
    public function store(StoreclasseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(classe $classe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(classe $classe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateclasseRequest $request, classe $classe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(classe $classe)
    {
        //
    }
}
