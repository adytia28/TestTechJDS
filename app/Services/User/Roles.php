<?php

namespace App\Services\User;

use Spatie\Permission\Models\Role;
use App\Models\User;

class Roles {
    public static function admin() {
        return Role::create(['name' => 'admin']);
    }

    public static function user() {
        return Role::create(['name' => 'user']);
    }

    public static function assign($user, $role) {
        $user->assignRole($role);
    }

}
