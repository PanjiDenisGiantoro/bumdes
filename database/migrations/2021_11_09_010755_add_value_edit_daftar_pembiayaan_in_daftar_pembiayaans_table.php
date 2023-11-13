<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueEditDaftarPembiayaanInDaftarPembiayaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daftar_pembiayaans', function (Blueprint $table) {
            //
            $table->string('hasil_pengajuan')->nullable()->after('status');
            $table->string('tanggal_disetujui')->nullable()->after('hasil_pengajuan');
            $table->string('plafon_disetujui')->nullable()->after('tanggal_disetujui');
            $table->string('jangka_waktu')->nullable()->after('plafon_disetujui');
            $table->string('tanggal_jatuh_tempo')->nullable()->after('jangka_waktu');
            $table->string('angsuran_perbulan')->nullable()->after('tanggal_jatuh_tempo');
            $table->string('tanggal_mulai_angsuran')->nullable()->after('angsuran_perbulan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daftar_pembiayaans', function (Blueprint $table) {
            //
        });
    }
}
