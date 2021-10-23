<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'users',
            'add user',
            'edit user',
            'delete user',
            'roles',
            'add role',
            'show role',
            'edit role',
            'delete role',
            'emails',
            'add email',
            'email action',
            'notifications'
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
