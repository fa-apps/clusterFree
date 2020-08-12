<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    
    public function register(Request $request) {

        $user=Auth()->user();

        if ($user->tokenCan('register_rsl') || $user->tokenCan('register_rlp')) {

            $request->validate([
                'name'=>['required','string'],
                'email'=>['required','email','unique:users'],
                'password'=>['required','string','min:6','confirmed']
            ]);

            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'role'=>$request->role,
                'password'=>Hash::make($request->password)
            ]);

            
        }
    }


    public function visit(Request $request) {

        $user=Auth()->user();

        if ($user->tokenCan('register_vlp')) {

            $request->validate([
                'name'=>['required','string'],
                'email'=>['required','string'],
            ]);

            $password = Str::random(10);
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'role'=>"VLP",
                'password'=>Hash::make($password) 
            ]);

            return $password;

            //TODO send mail
            
        }
    }
}
