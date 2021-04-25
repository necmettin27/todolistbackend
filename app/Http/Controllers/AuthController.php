<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    { 
    	$email = $request->email;
    	$password = $request->password;

    	if(Auth::attempt(['email'=>$email,'password'=>$password]))
        {
            $user = Auth::user();
            $success['token'] = $user->createToken("Login")->accessToken;
            return response()->json([
                'success'=>$success
            ],200);
        }
        return response()->json([
            'error'=>'Unauthorized'
        ],401);
    }

    public function logout(Request $request)
    {
        if(Auth::check())
        {
            Auth::user()->authUserToken()->delete();
            return response()->json(['message'=>'success logout'],200);
        }
        return response()->json([
            'error'=>'Unauthorized'
        ],401);
    }

    public function register(Request $request)
    {
 
        $val = array(
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        );

        $validator = Validator::make($request->all(),$val);
        if($validator->fails()){
            return $validator->errors();
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
           
            $success['token'] = $user->createToken("Login")->accessToken;
            return response()->json([
                'success'=>$success
            ],200);
        }

    }
}
