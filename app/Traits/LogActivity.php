<?php
namespace App\Traits;

use App\Traits\Authorization;

trait LogActivity {
    use Authorization;

    public function log($request) {
        return json_encode([
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'users_id' => $this->me($request)->id,
        ]);
    }
}
