<?php

namespace App\Http\Controllers\BMET;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Toastr;

class DashboardController extends Controller
{
    public function dashboard(){
        if(Auth::check() && Auth::user()->status == 1){
            return view('bmet.dashboard');
        }
        else{
            return redirect()->route('login');
        }
    }

    public function profile(){
        $user = Auth::user();
        return view('bmet.profile', compact('user'));
    }

    public function changePassword(Request $request)
    {

        $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|min:8',
            'confirmPassword' => ['same:password'],
        ]);

        $userId = Auth::user()->id;
        $user = User::find($userId);

        if (Hash::check($request->oldPassword, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            Auth::logout();
            return redirect()->back()->with('success', 'Changed Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
