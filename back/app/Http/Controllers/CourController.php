<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecourRequest;
use App\Http\Resources\CoursClasseResource;
use App\Http\Resources\CoursResource;
use App\Models\Cours;
use App\Models\CoursClasse;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecourRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

}
