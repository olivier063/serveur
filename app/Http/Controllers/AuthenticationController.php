<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function createAccount(Request $request)
    {
        // return response()->json($request->all());
        try {
            $attr = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:6'
            ]);
        } catch (Exception $e) {
            return response()->json([
                "request"=>$request,
                "message"=>$e->getMessage()
            ],421);    
        }
       
        $user = User::create([
            'name' => $attr['name'],
            'password' => bcrypt($attr['password']),
            'email' => $attr['email']
        ]);
        
        return response()->json([
            'token' => $user->createToken('tokens')->plainTextToken
        ]);
        
    }
}