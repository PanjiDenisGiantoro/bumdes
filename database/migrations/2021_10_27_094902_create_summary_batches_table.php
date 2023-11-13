<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummaryBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_batches', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->date('tanggal_pengajuan')->nullable();
            $table->string('batch')->nullable();
            $table->string('nama')->nullable();
            $table->string('nik')->nullable();
            $table->string('no_mitra')->nullable();
            $table->string('plafon_pengajuan')->nullable();
            $table->date('tanggal_kelulusan')->nullable();
            $table->string('status_kelulusan');
            $table->string('no_rekening')->nullable();
            $table->string('plafon_diluluskan')->nullable();
            $table->date('jangka_waktu')->nullable();
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->string('angsuran_perbulan')->nullable();
            $table->date('tanggal_angsuran')->nullable();
            // $table->smallInteger('status_perkawinan')->nullable();
            // $table->string('status_bangunan');
            // $table->char('kode_pos', 5);
            // $table->string('map');
            // $table->string('status');
            // $table->string('no_handphone')->nullable();
            // $table->string('no_telpon')->nullable();
            // $table->string('nama_warung');
            // $table->string('profil_warung')->nullable();
            // $table->smallInteger('bidang_usaha')->nullable();
            // $table->string('berdiri_sejak')->nullable();
            // $table->smallInteger('status_bangunan')->nullable();
            // $table->point('koordinat_warung')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('summary_batches');
    }
}
