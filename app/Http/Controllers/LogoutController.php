<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LogoutController extends Controller
{


    public function logout(Request $request)
    {
        // Auth::logout();

        //$request->session()->invalidate();

        //$request->session()->regenerateToken();

        // return response()->json('Successfully logged out');




        // auth()->user()->tokens()->delete();
        // return response()->json([
        //     'status'=>200,
        //     'message'=>'Logged Out Successfully'
        // ]);
    }


}
