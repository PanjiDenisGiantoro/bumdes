<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekeningSimpanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekening', function (Blueprint $table) {
            $table->id();

            $table->string('rekening_type')->nullable();
            $table->boolean('type')->nullable();
            $table->bigInteger('anggota_id')->nullable();
            $table->bigInteger('ao_id')->nullable();
            $table->string('no_akun')->nullable();
            $table->string('pilihan_akad')->nullable();
            $table->bigInteger('produk_id')->nullable();
            $table->decimal('nilai_pengajuan', 13, 2)->nullable();
            $table->decimal('nilai_pembiayaan', 13, 2)->nullable();
            $table->decimal('nilai_simpanan', 13, 2)->nullable();
            $table->decimal('interest', 13, 2)->nullable();

            $table->decimal('biaya_admin', 13, 2)->nullable();
            $table->decimal('biaya_materai', 13, 2)->nullable();
            $table->decimal('biaya_registrasi', 13, 2)->nullable();
            $table->decimal('biaya_asuransi', 13, 2)->nullable();
            $table->decimal('biaya_transfer_luar', 13, 2)->nullable();
            $table->decimal('biaya_penutupan_rekening', 13, 2)->nullable();
            $table->float('nisbah_hasil_1')->nullable();
            $table->float('nisbah_hasil_2')->nullable();

            $table->string('tujuan_pengajuan')->nullable();
            $table->string('keterangan_tujuan')->nullable();
            $table->string('sumber_dana')->nullable();
            $table->string('keterangan_sumber')->nullable();

            // $table->string('state');
            // $table->smallInteger('status');

            $table->string('jangka_waktu')->nullable();
            $table->string('tanggal_aktif')->nullable();
            $table->string('tanggal_jatuh_tempo')->nullable();
            $table->timestamps();
            $table->dateTime('moderated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekening');
    }
}
