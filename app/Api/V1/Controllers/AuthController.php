<?php

namespace App\Api\V1\Controllers;

use Auth;
use JWTAuth;
use Validator;
use Config;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Exceptions\JWTException;
use Dingo\Api\Exception\ValidationHttpException;
use Log;
use Response;

class AuthController extends Controller
{
    use Helpers;


    public function getByToken()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return Response::json(['result'=>$user]); 
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        $validator = Validator::make($credentials, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->response->errorUnauthorized();
            }
        } catch (JWTException $e) {
            return $this->response->error('could_not_create_token', 500);
        }

        $currentUser = Auth::user();
        if($currentUser && !$currentUser['active']){
            JWTAuth::invalidate($token);
            return $this->response->error('inactive_user', 403);;
        }
        else{
            return response()->json(compact('token'));
        }

    }
}