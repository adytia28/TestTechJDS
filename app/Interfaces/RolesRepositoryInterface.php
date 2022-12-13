<?php

namespace App\Interfaces;

interface RolesRepositoryInterface {
    public function checkAdminRoles($id);
    public function checkUserRoles($id);
}

?>
