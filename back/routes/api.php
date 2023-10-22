<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\SessionCoursController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post("/sessions/demandes", [SessionCoursController::class, "demande"]);

});
Route::get("/users/{id}/cours", [UserController::class, "coursByProf"]);
Route::get("/users/{id}/sessions", [UserController::class, "sessionsByProf"]);

Route::get("/classes",[ClasseController::class,"index"]);
Route::get("/modules",[ModuleController::class,"index"]);
Route::get("/semestres",[SemestreController::class,"index"]);

Route::get("/professeurs",[UserController::class,"index"]);
Route::get("/salles",[SalleController::class,"index"]);
Route::get("/modules/{id}/profs",[ModuleController::class,"getProfesseursByIdModule"]);


Route::post("/cours",[CourController::class,"store"]);
Route::get("/cours", [CourController::class, "index"]);

Route::get("/users/{role}", [UserController::class, "getResponsable"]);
Route::get("/cours/{id}/classes", [CourController::class, "getClasses"]);
Route::get("/cours/{idCours}/classes/{idClasse}/coursclasses", [CourController::class, "coursClasses"]);


Route::post("/sessions",[SessionCoursController::class,"create"]);
Route::get("/sessions",[SessionCoursController::class,"index"]);



Route::post("/users", [UserController::class, "import"]);
Route::get("/users/{role}", [UserController::class, "getUsers"]);

Route::get("/demandes", [DemandeController::class, "index"]);
