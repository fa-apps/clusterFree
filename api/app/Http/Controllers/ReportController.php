<?php

namespace App\Http\Controllers;
use App\Report;
use App\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(Request $request) {

        $request->validate([
            'tested_at' => 'required|date',
        ]);

        $currentUser=Auth()->user();

        $user = $request->email ? User::where('email', $request->email)->first() : $currentUser ;

        if (! $user ) {
            throw ValidationException::withMessages([
                'email' => ['Non trouvé.'],
            ]);
        }

        Report::create([
            'reported_by_id'=>$currentUser->id,
            'reported_for_id'=>$user->id,
            'tested_at'=>$request->tested_at 
        ]);

        //TODO send emails

        return "Signalé.";
    }

}
