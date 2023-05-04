<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function loginView(){
        return view("authentication.login");
    }
    public function loginUser(Request $request){
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            return redirect()->route("admin_dashboard");
        }
        Session::flash("message", "Invalid email address or password!");
        Session::flash('alert-class', 'alert-danger');
        return redirect()->route("login_view");
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route("login_view");
    }
}
