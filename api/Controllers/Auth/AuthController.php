<?php

namespace Api\Controllers\Auth;

use Api\Controllers\APIController;
use Illuminate\Http\Request;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class AuthController extends APIController
{

    function __construct()
    {
        parent::__construct();
    }

    function login(Request $req) {

        $email    = $req->email;
        $password = $req->password;

        try {
            $first = User::where('email','=', $email)->firstOrFail();
            
            $hash_check = Hash::check($password, $first->password);
            
            if($hash_check) {
                $payload = array(
                    'iss'   => "TrusAPI",     // Issuer of the token
                    'iat'    => time(),       // Time when JWT was issued. 
                    'exp'    => time() + 60*60*24, 
                    'user'   => [
                        "id" => $first->id,
                        "email" => $first->email,
                    ],
                );                
                $token = JWT::encode($payload, conf('jwt_key'), ['HS256']);
                $data    = [
                    "token" => $token,
                    "user"  => $first
                ];
                
                $this->success['message'] = "Login Successful!.";
                $this->success['data'] = $data;
                
                return resJSON($this->success);
    
            } else {
                $this->error['message'] = "Login Failed!";
                
                return resJSON($this->error, 401);
            }
    
    
        } catch (\Throwable $th) {
            $this->error['message'] = "Login Failed!";
            return resJSON($this->error, 401);
        }
       
    }

}