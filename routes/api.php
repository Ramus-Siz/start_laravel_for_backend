<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/etudiants", [\App\Http\Controllers\API\EtudiantsController::class, "getEtudiants"]);
Route::get("/etudiants/{id}", [\App\Http\Controllers\API\EtudiantsController::class, "getEtudiantById"]);
Route::post("/etudiants/add", [\App\Http\Controllers\API\EtudiantsController::class, "createEtudiant"]);
ROute::put("/etudiants/{id}", [\App\Http\Controllers\API\EtudiantsController::class, "updateEtudiant"]);
Route::delete("/etudiants/{id}", [\App\Http\Controllers\API\EtudiantsController::class, "deleteEtudiant"]);