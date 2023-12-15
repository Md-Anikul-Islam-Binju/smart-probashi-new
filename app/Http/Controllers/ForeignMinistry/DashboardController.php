<?php

namespace App\Http\Controllers\ForeignMinistry;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        if(Auth::check() && Auth::user()->status == 1){
            return view('foreignMinistry.dashboard');
        }
        else{
            return redirect()->route('login');
        }
    }
}
