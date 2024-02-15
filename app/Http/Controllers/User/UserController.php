<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use OhMyBrew\BasicShopifyAPI;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials= $request->only(['email','password']);
        if (Auth::attempt($credentials)===false){
            return response()->json([
                'data' => 'Não atutorizado'
            ],401);
        }
        $user=Auth::user();

        $token=$request->user()->createToken("token");
        return ['token' => $token->plainTextToken];

    }
}
