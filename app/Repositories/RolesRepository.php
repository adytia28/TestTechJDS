<?php

namespace App\Repositories;

use App\Interfaces\RolesRepositoryInterface;
use App\Models\User;

class RolesRepository implements RolesRepositoryInterface {
    public function checkAdminRoles($id) {
        $user = User::find($id);
        return $user->hasRole('admin');
    }

    public function checkUserRoles($id) {
        $user = User::find($id);
        return $user->hasRole('user');
    }
}
