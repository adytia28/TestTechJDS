<?php

namespace App\Services\FormatApi;

class Response {
    public static function success($data) {
        return [
            "success"   => true,
            "messages"  => "Process success",
            "data"      => $data,
        ];
    }

    public static function delete($message) {
        return [
            "success"   => true,
            "messages"  => $message,
            "data"      => [],
        ];
    }

    public static function errors($message) {
        return [
            "success"   => false,
            "messages"  => $message,
            "data"      => [],
        ];
    }
}
