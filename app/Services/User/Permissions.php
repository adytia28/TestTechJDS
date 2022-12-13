<?php

namespace App\Services\User;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Permissions {
    public static function store() {
        Permission::create(['name' => 'created']);
        Permission::create(['name' => 'read']);
        Permission::create(['name' => 'updated']);
        Permission::create(['name' => 'deleted']);
        Permission::create(['name' => 'comment']);
    }

    public static function givePermissions($user, $roles, $types = []) {
        $roles = Role::findByName('user');
        $user = $user->givePermissionTo($types);
        $roles = $roles->givePermissionTo($types);
    }
}
