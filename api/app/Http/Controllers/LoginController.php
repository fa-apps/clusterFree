<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\User;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function login(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        switch ($user->role) {
            case "RSL":
                $token_abilities = ['register_rsl','register_rlp'];
            break;

            case "RLP":
                $token_abilities = ['register_vlp'];
            break;

            default:
                $token_abilities = [];
        }
    
        return $user->createToken($request->device_name, $token_abilities)->plainTextToken;

    }

    public function logout(Request $request) {
        
        $request->user()->tokens()->delete();
    }
}
