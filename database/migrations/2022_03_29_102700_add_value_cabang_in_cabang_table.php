<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueCabangInCabangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('agunans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('akads', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('akun_officers', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('anggotas', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('asets', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('banks', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('berat_satuans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('cabangs', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('contact_us', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('daftar_inventoris', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('daftar_kontaks', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('daftar_pembiayaans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('daftar_produks', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('daftar_warungs', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('ekspedisi', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('ekspedisi_penjualans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('failed_jobs', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('gudang_produks', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('history_penjualan', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('historypembelians', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('jenis_transaksis', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kasir', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kasir_body', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kategori_produks', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kelompok_asets', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kode_bidang_usahas', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kode_hak_akses', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kode_kas_arus_aktivitas', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kode_kelompoks', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kode_pendidikans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kode_penggunas', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kode_perusahaans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kode_profils', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kode_skus', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kode_status_bangunans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kode_status_keluargas', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kode_status_pembiayaans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('kolektibilitas', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('ledger_entries', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('ledgers', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
       
        Schema::table('migrations', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('model_has_permissions', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('permission_id');
        });
        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('role_id');
        });
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('pelepasan_aset_mgts', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('pembelian_pembayaran', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('pembelian_pembayaran_body', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('pembelian_penerimaan', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('pembelian_penerimaan_body', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('pembiayaans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('pemesanan_penjualan_bodies', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('pemesanan_penjualans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('pemetaan_akuns', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('pengiriman_bodies', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('pengirimans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('penjualan_bodies', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('penjualans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('penomoran_auto', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('perpajakan_keuangans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('persetujuan_keuangans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('pesanan_pembelian', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('pesanan_pembelian_body', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('produk_rekening_pembiayaans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('produk_rekening_simpanan_berjangkas', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('produk_rekening_simpanans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('rekening', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('role_has_permissions', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('role_id');
        });
        Schema::table('satuan_produks', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('sessions', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('setting_batchs', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('sisa_bayars', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('status_keanggotaan', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('sumber_danas', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('sumber_pendanaans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('sumber_pengembalians', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('summary_batches', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('supplier', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('template_emails', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('template_notifikasis', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('template_sms', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('template_was', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('termin', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('termin_penjualans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('tipe_kontak_groups', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('tipe_kontaks', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('tujuan_pengajuans', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
        Schema::table('warungs', function (Blueprint $table) {
            $table->string('cabang_unit')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cabang', function (Blueprint $table) {
            //
        });
    }
}
