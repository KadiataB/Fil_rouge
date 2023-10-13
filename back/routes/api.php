<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\SessionCoursController;
use App\Http\Controllers\UserController;
use App\Models\classe;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/classes",[ClasseController::class,"index"]);
Route::get("/modules",[ModuleController::class,"index"]);
Route::get("/semestres",[SemestreController::class,"index"]);

Route::get("/professeurs",[UserController::class,"index"]);
Route::get("/salles",[SalleController::class,"index"]);
Route::get("/modules/{id}/profs",[ModuleController::class,"getProfesseursByIdModule"]);
Route::post("/modules",[ModuleController::class,"store"]);

Route::get("/users/{role}", [UserController::class, "getResponsable"]);
Route::get("/cours", [CourController::class, "index"]);
Route::get("/cours/{id}/classes", [CourController::class, "getClasses"]);
Route::get("/cours/{idCours}/classes/{idClasse}/coursclasses", [CourController::class, "coursClasses"]);


Route::post("/sessions",[SessionCoursController::class,"create"]);
Route::get("/sessions",[SessionCoursController::class,"index"]);



