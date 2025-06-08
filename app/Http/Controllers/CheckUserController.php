<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CheckUserController extends Controller
{
    //
    public function page()
    {
        return view('prelogin');
    }


    public function check(Request $request)
    {

        //dd($request->email);
        $value =  User::where('email', $request->email)->select('email')->first();
        if ($value) {
            return to_route('login');
        } else {

            return back()->with('error', "We Cant't Find Your Account Please Connect To Our Team");

        }
    }
}
