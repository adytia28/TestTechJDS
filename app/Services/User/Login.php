<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\FormatApi\Response;

class Login {
    public static function getUser($email) {
        return User::where('email', $email)->first();
    }

    public static function checkUser($user, $request) {
        if ($user)
            return self::checkPassword($user, $request->password);
        else
            return Response::errors('User does not exist');
    }

    public static function checkPassword($user, $password) {
        if (Hash::check($password, $user->password)) {
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            return Response::success([ 'user' => $user, 'token' => $token]);
        } else {
            return Response::errors('Password does not match');
        }
    }
}
