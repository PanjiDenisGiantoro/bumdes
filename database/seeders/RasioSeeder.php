<?php

namespace Database\Seeders;

use App\Models\pengajuan\Margin;
use App\Models\pengajuan\SettingRasio;
use Illuminate\Database\Seeder;

class RasioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingRasio::create([
            'rasio' => '14'
        ]);
        Margin::create([
            'margin' => '10'
        ]);
    }
}
