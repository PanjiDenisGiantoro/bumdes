<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id'       => 1,
                'name'     => 'Administrator',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
            ],
            [
                'id'       => 2,
                'name'     => 'Bank',
                'email'    => 'bank@gmail.com',
                'password' => Hash::make('bank123'),
            ],
        ]);

        $user = User::find(1);
        $user->assignRole('admin');

        $user = User::find(2);
        $user->assignRole('bank');
    }
}
