<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use \Firebase\JWT\JWT;
use PDO;

//use Tymon\JWTAuth\JWT as JWTAuthJWT;

//use Validator;

class AuthenticatorController extends Controller
{

    public function login(Request $request) {

        try {
            //code...

        $login = User::where('email','=',$request->email)->where('password','=',md5($request->password));
        if($login->count() == 1){
            $dados_user = User::where('email','=',$request->email)->where('password','=',md5($request->password))->first();
            $time_start  = strtotime(now());

            $key = env('SECRET_KEY');

            $payload = array(
                "login"=> $request->email,
                "id_user"=>$dados_user->id,
                //"iss" => "http://example.org",
                //"aud" => "http://example.com",
                "iat" => $time_start,
                //"nbf" => $time_end
            );

            $jwt = JWT::encode($payload, $key);
            //$decoded = JWT::decode($jwt, $key, array('HS256'));
            //return response()->json($decoded);

            return response()->json($jwt);
        } else {
            return 0;
        }

    } catch (\Throwable $th) {
       return $th;
    }

    }

    // public function validateToken(Request $request){
    //     $key = env('SECRET_KEY');
    //     $time_now = strtotime(now());

    //     try {
    //         $decoded = JWT::decode($request->bearerToken(), $key, array('HS256'));
    //     } catch (\Throwable $th) {
    //         return redirect('error');
    //     }

    //     if( $decoded->iat+3600 < $time_now  ){
    //         return redirect('error');
    //     }

    //     $payload = array(
    //         "login"=> $decoded->login,
    //         "id_user"=>$decoded->id_user,
    //         //"iss" => "http://example.org",
    //         //"aud" => "http://example.com",
    //         "iat" => $time_now
    //         //"nbf" => $time_end
    //     );

    //     $jwt = JWT::encode($payload, $key);

    //     return response()->json(['jwt_status' => true,'token'=>$jwt]);
    // }
    /*public function drivers(){
        print_r(PDO::getAvailableDrivers());
        exit();
    }*/
}
