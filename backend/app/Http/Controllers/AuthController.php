<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends APIController
{
    public function login(LoginRequest $request){
        $email=request('email');
        $password=request('password');
        $data=request()->all();
        //dd(Auth::user());
        $user=User::where('email',$email)->first();
        if(!$user){
            return $this->response(false,null,"User Not Found");
        }
        $requestpass=Hash::make($password);
        if(!Hash::check($request->password, $user->password)){
            return $this->response(false,null,"Wrong Password");
        }
       

        // if(!Auth::check($data)){
        //     return $this->response(false,null,"Login Gagal Cuy");
        // }
        // $user=Auth::user();
        $token=$user->createToken('API Token')->accessToken;
        return $token;
    }
}
