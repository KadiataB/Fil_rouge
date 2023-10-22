<?php

namespace App\Http\Controllers;

use App\Http\Resources\DemandeResource;
use App\Models\DemandeAnnulation;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DemandeController extends Controller
{
    public function index()
    {
         $demandes= DemandeAnnulation::where("etat","en_attente")->get();

         return response([
             "message" => "Voici les demandes",
             "data"=>DemandeResource::collection($demandes)
         ], Response::HTTP_OK);

    }
}
