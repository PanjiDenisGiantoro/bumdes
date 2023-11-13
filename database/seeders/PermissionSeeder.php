<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = \App\Models\Permission::defaultPermissions();

        foreach ($permissions as $permission) {
            \App\Models\Permission::updateOrCreate(['name' => $permission]);
        }
    }
}
