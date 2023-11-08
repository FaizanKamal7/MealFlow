<?php

namespace App\Http\Controllers\APIControllers;

use Laravel\Passport\HasApiTokens;
use App\Models\User;
use Illuminate\Routing\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
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
            return response([
                'message' => 'Login failed, user not found.'
            ], 401);
        }

        if (Auth::attempt([$fieldType => $request->email_or_phone, 'password' => $request->password])) {
            $token = $user->createToken(Passport::personalAccessClientId())->accessToken;
            return response([
                'user' => Auth::user(),
                'token' => $token
            ]);
        } else {
            return response([
                'message' => 'Login failed, incorrect password.'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('api-token' . $user->name)->accessToken,
        ]);


    }



    public function logout()
    {

        Auth::user()->currentAccessToken()->delete();

        return $this->success('', 'you have successfully logged out and token has been deleted');
    }
}
