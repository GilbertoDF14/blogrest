<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\JWT;

class AuthController extends Controller
{
    public function login(Request $req){
        $this->validate($req,[
            'user'=>'required',
            'pass'=>'required']);
        $result = User::find($req->input('user'));
        if($result){
            if(Hash::check($req->input('pass'), $result->pass)){
                return response()->json([
                    'auth' => true,
                    'user' => $result,
                    'token' => JWT::create($result, env('JWT_SECRET', 'kZ2zswvPw5GWiu19ff6oMfITucxCGoko'))
                ], 200);
            }else{
                return response()->json(['status'=>'failed']),404);
            }
        }else{
            return response()->json(['status'=>'failed']),404);
        }
    }
}
