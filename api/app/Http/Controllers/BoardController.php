<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\User;
use App\Visit;

class BoardController extends Controller
{
    public function vlp(Request $request) {

        $currentUser=Auth()->user();

        $visits = Visit::join('users', 'users.id', '=', 'visits.rlp_id')
        ->select('visits.id as id','users.name as rlp', 'visits.created_at as date')
        ->where('visits.vlp_id',$currentUser->id)
        ->orderBy('visits.created_at', 'desc')
        ->get();

        return response()->json($visits);

    }
}
