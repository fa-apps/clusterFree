<?php

namespace App\Http\Controllers;
use App\Report;
use App\Visit;
use App\MailLog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReportController extends Controller
{
    public function report(Request $request) {

        $request->validate([
            'tested_at' => 'required|date'
        ]);

        $currentUser=Auth()->user();

        if ($currentUser->role == "RSL") {
            $user = User::where('email', $request->email)->first();
            if (! $user ) {
                throw ValidationException::withMessages([
                    'email' => ['Non trouvé.'],
                ]);
            }
        } else {
            $user = $currentUser;
        }


        Report::create([
            'reported_by_id'=>$currentUser->id,
            'reported_for_id'=>$user->id,
            'tested_at'=>$request->tested_at 
        ]);

        //find contaminables
        
        $reportId = $user->id;
        $delay1 = 7;  //TODO fetch this from table settings
        $interval = "P".$delay1."D";
        $dateTested = new \DateTime($request->tested_at);
        $dateTested->sub(new \DateInterval($interval));
        $date = $dateTested->format('Y-m-d');

        
        
        $holderVisits = Visit::where([
            ['vlp_id', '=', $reportId],
            ['created_at' ,'>', date($date)]
        ])->get();

        $clusterables=[];

        
        foreach ( $holderVisits as $holderVisit) {
            
            $visitors = Visit::select('vlp_id')->where('rlp_id',$holderVisit->rlp_id)
                ->where('vlp_id','<>', $holderVisit->vlp_id )
                ->whereDate('created_at', $holderVisit->created_at)->get();

            if (count($visitors)) {
                foreach($visitors as $visitor) {
                    $clusterables[]=$visitor->vlp_id;
                }  
            }
        }

        $contaminables = User::select('users.id as id','users.name as name', 'users.email as email', 'users.created_at as date')
            ->whereIn('users.id',$clusterables)->get();


        foreach($contaminables as $contaminable) {

            MailLog::create([
                'to'=>$contaminable->email,
                'subject'=>"Message de Cluster Free",
                'body'=>"
Bonjour, 

Nous avons détecté une potentielle contamination lors d'une de vos dernieres visites dans un établissement public.
Nous vous conseillons vivement d'effectuer un test de dépistage.

Merci :)

L'équipe Cluster Free.
" 
            ]);
        
        }
        

        
        return response()->json($contaminables);
    }

}
