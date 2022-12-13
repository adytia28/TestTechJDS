<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authenticate\RegisterRequest;
use App\Http\Requests\Authenticate\LoginRequest;
use App\Services\User\Register;
use App\Services\User\Login;
use App\Http\Resources\AuthResource;
use App\Services\FormatApi\Response;

class AuthenticateController extends Controller {
    public function register(RegisterRequest $request) {
        try {
            $permission = ['read', 'comment'];
            $user = Register::store($request->all(), 'user', $permission);
            $token = $user->createToken('API Token')->accessToken;
            return new AuthResource([ 'user' => $user, 'token' => $token]);
        } catch (\Exception $e) {
            return new AuthResource(Response::errors($e->getMessage()));
        }
    }

    public function login(LoginRequest $request) {
        try {
            $user = Login::getUser($request->email);
            $checkUser = Login::checkUser($user, $request);
            return new AuthResource($checkUser);
        } catch (\Exception $e) {
            return new AuthResource(Response::errors($e->getMessage()));
        }


    }
}
