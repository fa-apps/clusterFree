<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use Illuminate\Support\Facades\Auth;
use App\User;

class VisitController extends Controller
{
    
    public function index() {

        $user=Auth()->user();

        $visits = Visit::find($user);

        return $visits;

    }
}
