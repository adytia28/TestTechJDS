<?php
namespace App\Traits;

use Laravel\Passport\Token;

trait Authorization {
    public function me($request) {
        $token = $request->bearerToken();
        $token_parts = explode('.', $token);
        $token_header = $token_parts[1];
        $token_header_json = base64_decode($token_header);
        $token_header_array = json_decode($token_header_json, true);
        $token_id = $token_header_array['jti'];

        $user = Token::find($token_id)->user;
        return $user;
    }
}
