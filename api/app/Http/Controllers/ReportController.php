<?php

namespace App\Http\Controllers;
use App\Report;
use App\Visit;
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

        $visitors = Visit::select('users.id as id','users.name as name', 'users.email as email')
            ->join('users', 'users.id', '=', 'visits.vlp_id')  
            ->whereRaw("visits.vlp_id in (select vlp_id from visits v where v.rlp_id = "+$currentUser->id+")")
            ->orderBy('users.created_at', 'desc')
            ->distinct()
            ->get();

        //find clusturables

        
        
        $reportId = $user->id;
        $date='2020-08-13';

        $visited = Visit::select('rlp_id')->where('vlp_id',$reportId)->distinct()->get();

        $contaminables = User::select('users.id as id','users.name as name', 'users.email as email', 'users.created_at as date')
        ->whereIn('users.id',function ($query) use ($visited, $date){
            $query->select('vlp_id')
                ->from('visits')
                ->whereIn('visits.rlp_id',($visited)) 
                ->whereDate('created_at', '=', date($date));
        })->get();


        //TODO send emails

        return response()->json($contaminables);
    }

}
