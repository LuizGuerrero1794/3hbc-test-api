<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class AuthController extends Controller
{
    /**
     * Login and create token
     */
    public function login (Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);
        
        $credentials = request(['email', 'password']);

        if ( !Auth::attempt($credentials) )
            return response()->json([
                'success'   =>  false,
                'message'     =>  'Credentials error'
            ], 401);
        
        
        $user = $request->user();    

        $tokenResult = $user->createToken('Personal Access Token');
        
        $token = $tokenResult->token;

        if ( $request->remember_me )
            $tokenResult->expires_at = Carbon::now()->addWeeks(1);
        
        $tokenResult->token->save();
        
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }

    /**
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
