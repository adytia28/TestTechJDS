<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\User\Register;
use App\Services\User\Roles;
use App\Services\User\Permissions;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permissions::store();

        // Admin
        $role= Roles::admin();
        $role = Roles::user();

        $data = [
            "name" => "Admin JDS",
            "email" => 'admin@jds.com',
            "email_verified_at" => '2022-02-12',
            "password" => 'admin123',
        ];

        $permission = ['created', 'read', 'updated', 'deleted', 'comment'];
        Register::store($data, 'admin', $permission);

        // User


        $data = [
            "name" => "Adytia Nugraha Siregar",
            "email" => 'adytiasiregar28@gmail.com',
            "email_verified_at" => '2022-02-12',
            "password" => 'user123',
        ];

        $permission = ['read', 'comment'];
        Register::store($data, 'user', $permission);
    }
}
