<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\User\Roles;
use App\Services\User\Permissions;

class Register {
    public static function store($data, $role, $permission) {
        $user = User::create($data);

        Permissions::givePermissions($user, $role, $permission);
        Roles::assign($user, $role);

        return $user;
    }
}
