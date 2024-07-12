<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login_view()
    {
        return view("authentication.login");
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_or_phone' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $fieldType = filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $user = User::where($fieldType, $request->email_or_phone)->first();

        if (!$user) {
            Session::flash("message", "Login failed, user not found");
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route("login_view");
        }

        if (Auth::attempt([$fieldType => $request->email_or_phone, 'password' => $request->password])) {
            // $token = $user->createToken("AUTH_TOKEN")->accessToken;
            return redirect()->route("admin_dashboard");
        } else {
            Session::flash("message", "Invalid email address or password!");
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route("login_view");
        }
    }


    public function verify(Request $request)
    {
        // Check OTP and issue token
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect()->route("login_view");
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            Session::flash("message", $validator->errors()->all());
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route("login_view");
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10)
        ]);
        return redirect()->route("core");
    }

    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();
        event(new PasswordReset($user));
    }
}
