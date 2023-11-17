<?php

namespace App\Http\Controllers\APIControllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Passport;

class AuthAPIController extends Controller
{

    use HttpResponses, HasApiTokens;




    public function login(Request $request)
    {
       
    
        // return response()->json("hey there");
        // $request->validate([
        //     "email" => "required|email",
        //     "password" => "required",
        // ]);
        // $credentials = $request->only("email", "password");
        // if (!Auth::attempt($credentials)) {
        //     return $this->error('', 'Credientials do not match', 401);
        // }
        // $user = User::where('email', $request->email)->first();
        // return $this->success([
        //     'user' => $user,
        //     'token' => $user->createToken('Api Token of' . $user->name)->accessToken,
        // ]);
    
        $request->validate([
            'email_or_phone' => 'required',
            'password' => 'required|min:6',
        ]);

        $fieldType = filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (!Auth::attempt([$fieldType => $request->email_or_phone, 'password' => $request->password])) {
            return $this->error('', 'Credientials do not match', 401);
        }
        $user = User::where($fieldType, $request->email_or_phone)->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('auth-token' . $user->name)->accessToken,
        ]);
    }




    public function logout()
    {

        Auth::user()->currentAccessToken()->delete();

        return $this->success('', 'you have successfully logged out and token has been deleted');
    }
    // use HttpResponses, HasApiTokens;


    // public function login_view()
    // {
    //     return view("authentication.login");
    // }

    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email_or_phone' => 'required',
    //         'password' => 'required|min:6',
    //     ]);

    //     if ($validator->fails()) {
    //         return response(['errors' => $validator->errors()->all()], 422);
    //     }

    //     $fieldType = filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

    //     $user = User::where($fieldType, $request->email_or_phone)->first();

    //     if (!$user) {
    //         return response([
    //             'message' => 'Login failed, user not found.'
    //         ], 422);
    //     }

    //     if (Auth::attempt([$fieldType => $request->email_or_phone, 'password' => $request->password])) {
    //         $token = $user->createToken("AUTH_TOKEN")->accessToken;
    //         return response([
    //             'user' => Auth::user(),
    //             'token' => $token
    //         ]);
    //     } else {
    //         return response([
    //             'message' => 'Login failed, incorrect password.'
    //         ], 401);
    //     }
    // }


    // public function verify(Request $request)
    // {
    //     // Check OTP and issue token
    // }

    // public function logout(Request $request)
    // {
    //     Session::flush();
    //     Auth::logout();
    //     // dd($request->token);
    //     // print("<pre>" . print_r(Auth::user(), true) . "</pre>");
    //     // dd($request['_token']);
    //     // $token = $request->user()->token();
    //     // $token->revoke();
    //     // dd("here");
    //     Auth::user()->currentAccessToken()->delete();
    //     // $request['_token']->revoke();
    //     $response = ['message' => 'You have been successfully logged out!'];
    //     return response($response, 200);
    //     // Auth::user()->currentAccessToken()->delete();

    //     // return $this->success('', 'you have successfully logged out and token has been deleted');
    // }

    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email_or_phone' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);
    //     if ($validator->fails()) {
    //         return response(['errors' => $validator->errors()->all()], 422);
    //     }
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'password' => Hash::make($request->password),
    //         'remember_token' => Str::random(10)
    //     ]);
    //     $user = User::create($request->toArray());
    //     $token = $user->createToken('Laravel Password Grant Client')->accessToken;
    //     return response([
    //         'message' => 'Registration successful',
    //         'user' => $user,
    //         'token' => $token
    //     ], 201);
    // }

    // protected function resetPassword($user, $password)
    // {
    //     $user->password = Hash::make($password);
    //     $user->save();
    //     event(new PasswordReset($user));
    // }
    // protected function sendResetResponse(Request $request, $response)
    // {
    //     $response = ['message' => "Password reset successful"];
    //     return response($response, 200);
    // }
    // protected function sendResetFailedResponse(Request $request, $response)
    // {
    //     $response = "Token Invalid";
    //     return response($response, 401);
    // }
}
