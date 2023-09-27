<?php

namespace App\Http\Controllers\APIControllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    use HttpResponses;


    public function login(Request $request)
    {
        // return response()->json("hey there");
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);
        $credentials = $request->only("email", "password");
        if (!Auth::attempt($credentials)) {
            return $this->error('','Credientail do not match',401);
        }
        $user = User::where('email',$request->email)->first();
        return $this->success([
            'user'=>$user,
            'token'=>$user->createToken('Api Token of'.$user->name)->plainTextToken,
        ]);
    }


    public function logout(){
        
        Auth::user()->currentAccessToken()->delete();

        return $this->success('','you have successfully logged out and token has been deleted');
    }
}