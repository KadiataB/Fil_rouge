<?php

namespace App\Http\Controllers;

use App\Http\Resources\DemandeResource;
use App\Http\Resources\SessionResource;
use App\Models\ClasseSession;
use App\Models\Cours;
use App\Models\CoursClasse;
use App\Models\DemandeAnnulation;
use App\Models\SessionCours;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SessionCoursController extends Controller
{

    public function index()
    {
       $sessions= SessionCours::all();
       return response([
        "message" => "voici les sessions de cours",
        "data"=>SessionResource::collection($sessions)
    ], Response::HTTP_ACCEPTED);
    }


    public static function heureMinutesInSeconds($heure)
    {
        $h=explode(':',$heure);
        $s=isset($h[2])?intval($h[2]):00;
        $secondes= intval($h[0]) * 3600 +  intval($h[1]*60) + $s;
        return $secondes;

    }

    public function create(Request $request)
    {
        DB::beginTransaction();

       $c= CoursClasse::where(["cours_id"=>$request->cours_id,"classe_id"=>$request->classe_id])->first();
    //    return $c;
      $profSessions= SessionCours::where([["cours_classe_id",$c->id],["date",$request->date]])->get();

         foreach ($profSessions as $p) {
            if(($p->hd <= $request->hd) && $request->hd <=$p->hf) {
                return response([
                    "message" => "Professeur occupé"
                ], Response::HTTP_BAD_REQUEST);
             }
         }
       $sessions= SessionCours::where('date',$request->date)->get();
       if(!$request->salle_id) {}
       else {
           foreach ($sessions as $key ) {
               $cs=  ClasseSession::where(["session_cours_id"=>$key->id,"salle_id"=>$request->salle_id])->get();

               foreach ($cs as $value) {
                    $sess=SessionCours::find($value->session_cours_id);
                     if(($sess->hd <= $request->hd) && $request->hd <=$sess->hf ) {
                        return response([
                            "message" => "Salle occupée"
                        ], Response::HTTP_BAD_REQUEST);
                     }
               }
           }
       }

       if ($request->hd >= $request->hf) {
        return response([
            "message" => "L'heure de début doit être antérieure à l'heure de fin."
        ], Response::HTTP_BAD_REQUEST);
      }

      $hd = Carbon::parse($request->hd);
      $hf = Carbon::parse($request->hf);

      if ($hd->diffInHours($hf) < 1) {
          return response([
              "message" => "L'écart entre l'heure de début et l'heure de fin doit être d'au moins 1 heure."
          ], Response::HTTP_BAD_REQUEST);

      }
      $dateActuelle = Carbon::now();
    //   return $dateActuelle;
    // $date=explode()

      if ($dateActuelle->gt($request->date)) {
           return response([
            "message" => "La date actuelle est ultérieure à la date passée."
        ], Response::HTTP_BAD_REQUEST);
    }

    $duree= $this->heureMinutesInSeconds($request->hf) - $this->heureMinutesInSeconds($request->hd);
    $cours=Cours::find($request->cours_id);
    if ($cours->hr === $cours->heures) {
        return response([
            "message" => "les heures de ce cours sont épuisées."
        ], Response::HTTP_BAD_REQUEST);
    }
    if($cours->heures === $cours->hr + $duree) {
        $cours->update(["etat"=>"termine"]);

    }
    if($cours->heures < $cours->hr + $duree) {
        return response([
            "message" => "Impossible la durée de cette session est supérieure au nombre d'heures restant."
        ], Response::HTTP_BAD_REQUEST);
    }
    $session = SessionCours::create([
        "date"=>$request->date,
        "hd"=>$request->hd,
        "hf"=>$request->hf,
        "duree"=>$duree,
        "cours_classe_id"=>$c->id,
        "mode"=>$request->mode,


        ]);
     Cours::find($request->cours_id)->increment('hr',$duree);
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



    public function demande(Request $request)
    {
        $req= DemandeAnnulation::where([["session_cours_id",$request->id],["professeur_id",$request->professeur_id]])->first();
        if ($req) {
        return response([
            "message" => "Demande d'annulation déjà faite",
        ], Response::HTTP_BAD_REQUEST);
        }
        $user=Auth::user();
        if ($user->role ==="professeur") {
             DemandeAnnulation::create([
                "motif"=>$request->motif,
                "etat"=>"en_attente",
                "session_cours_id"=>$request->session_cours_id,
                "professeur_id"=>$user->id
            ]);

            return response([
                "message" => "Demande envoyée",
            ], Response::HTTP_CREATED);


        } elseif($user->role ==="responsable") {
        $demand= DemandeAnnulation::where("session_cours_id",$request->id)->first();
     $d=   DemandeAnnulation::find($demand->id);
        $d->update(["etat"=>$request->etat]);

        if ($request->etat==="accepte") {
          $ses=  SessionCours::find($demand->id);
          $coursClasse= CoursClasse::where("id",$ses->cours_classe_id)->first();
         $cours=  Cours::find($coursClasse->cours_id);
         $cours->decrement("hr",$ses->duree);
            $ses->update(["supprime"=>1]);
            return response([
                "message" => "Votre demande a été acceptée",
            ], Response::HTTP_OK);
        }
        elseif($request->etat==="refuse") {
            DemandeAnnulation::where("id",$demand->id)->update(["etat"=>"refuse"]);
            return response([
                "message" => "Votre demande a été refusée",
            ], Response::HTTP_OK);

        }

        }


    }


}
