<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name'       => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'bank',
                'guard_name' => 'web',
            ],
        ]);
    }
}
