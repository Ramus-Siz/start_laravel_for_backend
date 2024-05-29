<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Etudiants;

class EtudiantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getEtudiants()
    {
     $etudiants=Etudiants::all();
     return response()->json([
        "message" => "Liste d'etudiants",
        "data" => $etudiants,

    ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createEtudiant(Request $request)
    {

        $request->validate([
            'nom' => 'required',
            'email' => "required|email|unique:etudiants",
            'password' => 'required',
        ]);

        $etudiant=new Etudiants();
        $etudiant->nom=$request->nom;
        $etudiant->email=$request->email;
        $etudiant->password=$request->password;
        $etudiant->save();

        return response()->json([
            'message' => 'Etudiant created successfully',
            'data' => $etudiant
        ], 201);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function getEtudiantById(string $id)
    {
        $etudiant=Etudiants::find($id);
        if ($etudiant) {
             return response()->json([
            "message" => "Etudiant",
            "data" => $etudiant,], 200);
        } else {
            return response()->json([
                "message" => "Etudiant not found",
            ], 404);
        }
       
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateEtudiant(Request $request, string $id)
    {
        $etudiant=Etudiants::where('id', $id)->exists();
        if ($etudiant) {
            $etudiantFind=Etudiants::find($id);
            $etudiantFind->nom=$request->nom;
            $etudiantFind->email=$request->email;
            $etudiantFind->password=$request->password;
            $etudiantFind->save();
            return response()->json([
                'message' => 'Etudiant updated successfully',
                'data' => $etudiantFind
            ], 200);
        } else {
            return response()->json([
                'message' => 'Etudiant not found',
            ], 404);
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteEtudiant(string $id)
    {
        //
    }
}
