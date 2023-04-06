<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
         $loginDetails = $request->only('email','password');
        
         
        if(Auth::attempt($loginDetails)){
            $user = User::where('email', $loginDetails['email']) -> first();
            // si jamais la Bd ne fonctionne plus, on gere l'erreure suivante.
            if($user === null){
                return response()->json(['token' => null], 404);
            }
            return response()->json([
                'token' => $user->createToken('tokens')->plainTextToken
            ]);
        } else {
            return response()->json(['token' => null], 404);
        }


    }

}
   // public function logout(Request $request)
    // {
    //     $request->user()->currentAccessToken()->delete();
    //     return ['message' => 'Successfully logout.'];
    // }