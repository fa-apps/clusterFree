<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; 
use Illuminate\Http\RedirectResponse;
use App\Visit;

class RegisterController extends Controller
{

    
    public function register(Request $request) {

        $user=Auth()->user();

        if ($user->tokenCan('register_rsl') || $user->tokenCan('register_rlp')) {

            $request->validate([
                'name'=>['required','string'],
                'role'=>['required','string'],
                'email'=>['required','email','unique:users']
            ]);


            $password = 'password';//Str::random(10);

            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'role'=>$request->role,
                'password'=>Hash::make($password)
            ]);

            
        }
    }


    public function visit(Request $request) {

        $user=Auth()->user();

        if ($user->tokenCan('register_vlp')) {

            $targetUser = User::where('email', $request->email)->first();
    
            if (!$targetUser) {

                $request->validate([
                    'name'=>['required','string'],
                    'email'=>['required','string'],
                ]);
    
                $password = 'password';//Str::random(10);
                $targetUser = User::create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'role'=>"VLP",
                    'password'=>Hash::make($password) 
                ]);
            }
            
            $visit = Visit::create([
                'rlp_id'=>$user->id,
                'vlp_id'=>$targetUser->id        
            ]);

            //TODO send mail
            
            return true;

        }
    }
}
