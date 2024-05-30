<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware();

Route::get("/etudiants", [\App\Http\Controllers\API\EtudiantsController::class, "getEtudiants"])->middleware('auth:sanctum');
Route::get("/etudiants/{id}", [\App\Http\Controllers\API\EtudiantsController::class, "getEtudiantById"]);
Route::post("/etudiants/add", [\App\Http\Controllers\API\EtudiantsController::class, "createEtudiant"]);
ROute::put("/etudiants/update/{id}", [\App\Http\Controllers\API\EtudiantsController::class, "updateEtudiant"]);
Route::delete("/etudiants/delete/{id}", [\App\Http\Controllers\API\EtudiantsController::class, "deleteEtudiant"]);


Route::post("/login", [\App\Http\Controllers\API\AuthController::class, "login"]);
Route::post("/register/user",[\App\Http\Controllers\API\AuthController::class, "register"]);
Route::post("/logout", [\App\Http\Controllers\API\AuthController::class, "logout"])->middleware('auth.basic');


