<?php
//kZ2zswvPw5GWiu19ff6oMfITucxCGoko
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\JWT;

class AuthController extends Controller
{
    public function login($user,$pass){
        // $this->validate($req, [
        //     'user'=>'required', 
        //     'pass'=>'required']);

        $result = User::find($user);

        if($result){
            if (Hash::check($pass, $result->pass)){
                return response()->json([
                    'auth' => true,
                    'user' => $result,
                    'token' => JWT::create($result, env('JWT_SECRET', 'kZ2zswvPw5GWiu19ff6oMfITucxCGoko'))
                ], 200);
            }else{
                return response()->json(['status'=>'failed'], 404);
            }
        }else{
            return response()->json(['status'=>'failed'], 404);
        }

    
    }
}
