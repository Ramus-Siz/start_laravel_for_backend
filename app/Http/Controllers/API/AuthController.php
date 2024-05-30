<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register (Request $request)
    {
        try {
            $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:30',
        ]);

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->save();

        return response()->json([
            'message' => 'User created successfully',
            'data' => $user,
            'token'=>$user->createToken('API Token')->plainTextToken,
        ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ],500);
        }

        
    }

    public function login (Request $request)
    {

        try {
            $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'email and password does not match with our record.',
            ],401);
        }
        $user=User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
        return response()->json([
            'message' => 'User logged in successfully',
            'data' => $user,
            'token'=>$user->createToken('API Token')->plainTextToken,
        ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ],500);
        }
        
    }

    public function getProfile (Request $request)
    {
        $userData=auth()->user();
        return response()->json([
            'message' => 'User profile fetched successfully',
            'data' => $userData,
        ], 200);
    }

    public function logout (Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'User logged out successfully',
        ], 200);
    }
}
