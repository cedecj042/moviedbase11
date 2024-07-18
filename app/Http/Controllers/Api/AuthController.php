<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request){
        
        $credentials = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);
        
        $user = Auth::user();
        $token = $user->createToken('API Token')->plainTextToken;
        if (!Auth::attempt($credentials)) {
            return response()->json(["message"=>'Credentials not valid'], 400);
        }
        return response()->json(['token' => $token], 200);
    }
}
