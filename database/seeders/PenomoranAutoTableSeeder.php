<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenomoranAutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [

            [
                'head' => "",
                'keterangan' => 'kasir',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'head' => "",
                'keterangan' => 'produk',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],  [
                'head' => "",
                'keterangan' => 'anggota',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'head' => "",
                'keterangan' => 'simpanan',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'head' => "",
                'keterangan' => 'pembiayaan',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],  [
                'head' => "",
                'keterangan' => 'simpanan_berjangka',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],


        ];

        DB::table('penomoran_auto')->insert($posts);
    }
}
