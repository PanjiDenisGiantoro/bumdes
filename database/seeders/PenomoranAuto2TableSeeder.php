<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenomoranAuto2TableSeeder extends Seeder
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
                'keterangan' => 'penawaran Penjualan',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'head' => "",
                'keterangan' => 'Pemesanan Penjualan',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'head' => "",
                'keterangan' => 'Pembayaran Penjualan',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'head' => "",
                'keterangan' => 'pesanan pembelian',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'head' => "",
                'keterangan' => 'Pemesanan Pembelian',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'head' => "",
                'keterangan' => 'Pembayaran Pembelian',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];

        DB::table('penomoran_auto')->insert($posts);

    }
}
