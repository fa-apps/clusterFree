<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\User;
use App\Visit;
use App\Report;
use App\MailLog;

// TODO check role

class BoardController extends Controller
{
    public function vlp(Request $request) {

        
        $currentUser=Auth()->user();

        $visits = Visit::join('users', 'users.id', '=', 'visits.rlp_id')
        ->select('visits.id as id','users.name as name', 'users.email as email', 'visits.created_at as date')
        ->selectRaw('(select count(*) from reports where reports.reported_for_id = visits.vlp_id) as reports')  
        ->where('visits.vlp_id',$currentUser->id)
        ->orderBy('visits.created_at', 'desc')
        ->get();

        $reports= Report::select('reports.id as id','reports.created_at as date', 'reports.tested_at as test_date')
        ->where('reports.reported_for_id',$currentUser->id)
        ->orderBy('reports.created_at', 'desc')
        ->get();

        return response()->json(["visits"=>$visits,"reports" => $reports]);

    }
    
    public function rlp(Request $request) {

            
        $currentUser=Auth()->user();

        
        $visits = Visit::join('users', 'users.id', '=', 'visits.vlp_id')        
        ->select('visits.id as id','users.name as name', 'users.email as email', 'visits.created_at as date')
        ->selectRaw('(select count(*) from reports where reports.reported_for_id = visits.vlp_id) as reports')  
        ->where('visits.rlp_id',$currentUser->id)
        ->orderBy('visits.created_at', 'desc')
        ->get(); 
        
        $visitors = Visit::join('users', 'users.id', '=', 'visits.vlp_id')        
        ->select('users.id as id','users.name as name', 'users.email as email', 'users.created_at as date')
        ->selectRaw('(select count(*) from visits where visits.vlp_id = users.id and visits.rlp_id = '.$currentUser->id.') as visits')  
        ->selectRaw('(select count(*) from reports where reports.reported_for_id = visits.vlp_id) as reports')  
        ->where('visits.rlp_id',$currentUser->id)
        ->orderBy('users.created_at', 'desc')
        ->distinct()->get();

        
        $reports= Report::select('reports.id as id','reports.created_at as date', 'reports.tested_at as test_date')
        ->where('reports.reported_for_id',$currentUser->id)
        ->orderBy('reports.created_at', 'desc')
        ->get();

        return response()->json(["visits"=>$visits,"reports" => $reports,"visitors"=>$visitors]);

    }

    public function rsl(Request $request) {

            
        $currentUser=Auth()->user();
        
        $visits = Visit::join('users', 'users.id', '=', 'visits.vlp_id')->join('users as u', 'u.id', '=', 'visits.rlp_id')           
        ->select('visits.id as id','users.name as name', 'users.email as email', 'visits.created_at as date' ,'u.name as location')
        ->selectRaw('(select count(*) from reports where reports.reported_for_id = visits.vlp_id) as reports')  
        ->orderBy('visits.created_at', 'desc')
        ->get();

        $reports = Report::leftJoin('users', 'users.id', '=', 'reports.reported_for_id')
        ->select('users.name as name','users.email as email','reports.id as id','reports.created_at as date', 'reports.tested_at as test_date')
        ->orderBy('reports.created_at', 'desc')
        ->get();

        $mail_logs = MailLog::orderByDesc('created_at')->get();

        $locations = User::select('users.id as id','users.name as name', 'users.email as email', 'users.created_at as date')
        ->selectRaw('(select count(*) from visits where visits.rlp_id = users.id) as visits')  
        ->selectRaw('(select count(*) from reports where reports.reported_for_id in (select vlp_id from visits where rlp_id = users.id)) as reports')  
        ->selectRaw('(select count(*) from users as vlps where vlps.id in (select distinct vlp_id from visits where rlp_id = users.id)) as visitors')  
        ->where('users.role','RLP')
        ->orderBy('users.created_at','desc')
        ->get();
        
        $visitors = User::select('users.id as id','users.name as name', 'users.email as email', 'users.created_at as date')
        ->selectRaw('(select count(*) from visits where visits.vlp_id = users.id) as visits')  
        ->selectRaw('(select count(*) from reports where reports.reported_for_id = users.id) as reports')  
        ->where('users.role','VLP')
        ->orderBy('users.created_at','desc')
        ->get();

        $rsls = User::select('users.id as id','users.name as name', 'users.email as email', 'users.created_at as date')
        ->selectRaw('(select count(*) from reports where reports.reported_by_id = users.id) as reports')  
        ->where('users.role','RSL')
        ->orderBy('users.created_at','desc')
        ->get();

        
 

        return response()->json(["visits"=>$visits,"reports" => $reports,"mail_logs" => $mail_logs,"locations"=>$locations,"visitors"=>$visitors,"rsls"=>$rsls]);

    }
}
