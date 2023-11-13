<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPSTORM_META\map;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;
    public static function defaultPermissions(): array
    {
        return [
            'anggota.Lihat',
            'anggota.Tambah',
            'anggota.Ubah',
            'anggota.Cetak',

            'daftar-warung.Lihat',
            'daftar-warung.Tambah',
            'daftar-warung.Ubah',
            'daftar-warung.Cetak-profile-warung',
            'daftar-warung.Cetak-berita-acara',

            'daftar-pendanaan.Lihat',
            'daftar-pendanaan.Tambah',
            'daftar-pendanaan.Ubah',
            'daftar-pendanaan.Cetak-pdf',
            'daftar-pendanaan.Cetak-rincian',

            'rekening-pendanaan.lihat',

            'summary-batch.Lihat',
            'summary-batch.Tambah',

            'setting-pendanaan.Tambah',
            'setting-pendanaan.Ubah',

            'rekening-simpanan.lihat',
            'rekening-simpanan.Tambah',
            'rekening-simpanan.Ubah',
            'rekening-simpanan.show-detail',

            'rekening-simpanan-berjangka.lihat',
            'rekening-simpanan-berjangka.Tambah',
            'rekening-simpanan-berjangka.Ubah',
            'rekening-simpanan-berjangka.approve',

            'rekening-pembiayaan.lihat',
            'rekening-pembiayaan.Tambah',
            'rekening-pembiayaan.Ubah',
            'rekening-pembiayaan.approve',
            'rekening-pembiayaan.show-detail',

            'penjualan-penawaran.lihat',
            'penjualan-penawaran.Tambah',
            'penjualan-penawaran.print',

            'penjualan-pemesanan.lihat',
            'penjualan-pemesanan.Tambah',

            'penjualan-pembayaran.lihat',
            'penjualan-pembayaran.bayar-tagihan',
            'penjualan-pembayaran.Tambah',
            'penjualan-pembayaran.cetak-invoice',
            'penjualan-pembayaran.cetak-surat-jalan',

            'tagihan-penjualan.bayar-tagihan',

            'ringkasan-penjualan.lihat',

            'daftar-pembelian.lihat',

            'pembelian-pesanan.lihat',
            'pembelian-pesanan.Tambah',

            'pembelian-penerimaan.lihat',
            'pembelian-penerimaan.Tambah',
            'pembelian-penerimaan.cetak',

            'pembelian-pembayaran.lihat',
            'pembelian-pembayaran.bayar-tagihan',
            'pembelian-pembayaran.cetak-invoice',

            'ringkasan-pembelian.lihat',

            'kasir.lihat',
            'kasir.Tambah',

            'keuangan-transaksi.lihat',
            'keuangan-transaksi.Tambah',

            'jurnal-transaksi.lihat',
            'jurnal-transaksi.Tambah',

            'bagi-hasil.simpanan',
            'bagi-hasil.simpanan-berjangka',

            'setting-bagi-hasil.Tambah',
            'setting-bagi-hasil.delete',

            'daftar-produk.lihat',
            'daftar-produk.Tambah',
            'daftar-produk.Ubah',
            'daftar-produk.delete',

            'biaya.lihat',
            'biaya.Tambah',

            'inventory.lihat',

            'management-aset.lihat',
            'management-aset.Tambah',
            'management-aset.Ubah',
            'management-aset.delete',

            'penyusutan.lihat',

            'pelepasan-aset.lihat',
            'pelepasan-aset.Tambah',
            'pelepasan-aset.Ubah',
            'pelepasan-aset.delete',

            'setting-utama.setting-utama',
            'setting-kode.setting-kode',
            'setting-keuangan.setting-keuangan',
            'setting-kontak.setting-kontak',
            'setting-produk.setting-produk',
            'setting-rekening.setting-rekening',
            'setting-pendanaan.sumber-pendanaan',
            'setting-bank.bank',
            'setting-template.setting-template',
            'setting-penomoran-auto.setting',

            'laporan-keuangan.laporan-keuangan',
            'laporan-biaya.biaya-per-kontak',
            'laporan-pajak.pajak-penjualan',
            'laporan-inventory.laporan-inventory',
            'laporan-aset-tetap.laporan-aset-tetap',
            'laporan-penjualan.laporan-penjualan',
            'laporan-pembelian.laporan-pembelian',
            'laporan-keanggotaan.laporan-keanggotaan',



        ];
    }
    public function role()
    {
        return $this->hasOne(\Spatie\Permission\Models\Role::class,'id','permisson_id');
    }
}
