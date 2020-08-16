<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\User;
use App\Visit;
use App\Report;

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
        ->selectRaw('(select count(*) from visits where visits.vlp_id = users.id) as visits')  
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
        
        $visits = Visit::join('users', 'users.id', '=', 'visits.vlp_id')        
        ->select('visits.id as id','users.name as name', 'users.email as email', 'visits.created_at as date' )
        ->selectRaw('(select count(*) from reports where reports.reported_for_id = visits.vlp_id) as reports')  
        ->orderBy('visits.created_at', 'desc')
        ->get();

        $reports = Report::join('users', 'users.id', '=', 'reports.reported_for_id')
        ->select('users.name as name','users.email as email','reports.id as id','reports.created_at as date', 'reports.tested_at as test_date')
        ->orderBy('reports.created_at', 'desc')
        ->get();

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

        $reportId = 7;
        $date='2020-08-13';

        $visited = Visit::select('rlp_id')->where('vlp_id',$reportId)->distinct()->get();

        $contaminables = User::select('users.id as id','users.name as name', 'users.email as email', 'users.created_at as date')
        ->whereIn('users.id',function ($query) use ($visited, $date){
            $query->select('vlp_id')
                ->from('visits')
                ->whereIn('visits.rlp_id',($visited)) 
                ->whereDate('created_at', '=', date($date));
        })->get();
 

        return response()->json(["Contaminables"=>$contaminables,"visits"=>$visits,"reports" => $reports,"locations"=>$locations,"visitors"=>$visitors,"rsls"=>$rsls]);

    }
}
