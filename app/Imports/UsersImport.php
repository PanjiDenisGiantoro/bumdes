<?php

namespace App\Imports;

use App\Models\Anggota;
use App\Models\DaftarWarung;
use App\Models\District;
use App\Models\Kode;
use App\Models\Province;
use App\Models\RekeningPendanaan;
use App\Models\RekeningSimpanan;
use App\Models\Village;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

use function PHPSTORM_META\map;

// class UsersImport implements ToModel
class UsersImport implements ToCollection

{


    public function collection( Collection $collection) {

        foreach ($collection as $key =>$row) {
            // dump ('Arrave');
            // dd("ROW : " . $row . " - " . $key);

            if ($key == 0) {

            } else {

                // cabang               = row[0];  ##############
                // BATCH                = row[1];
                // NO ANGGOTA           = row[2]; #
                // NOREK SIMPOK         = row[3];
                // NOREK SIMJIB         = row[4];
                // NOREK SIMP PENDANAAN = row[5];
                // NOREK PENDANAAN      = row[6];
                // NO                   = row[7];
                // NAMA                 = row[8]; #
                // WILAYAH BUMDES       = row[9];
                // NOMINAL              = row[10];
                // MARGIN               = row[11];
                // POKOK+MARGIN         = row[12];
                // TEMPO                = row[13];
                // ANGSURAN             = row[14];
                // TEMPAT               = row[15];
                // TGL LAHIR            = row[16]; #
                // NIK                  = row[17]; #           
                // "NO TELEPON\/ HP     = row[18];
                // NAMA PASANGAN        = row[19];
                // NIK SUAMI\/ISTRI     = row[20];
                // ALAMAT               = row[21];
                // DESA                 = row[22];
                // KEC                  = row[23];
                // KAB\/KOTA            = row[24];
                // PROVINSI             = row[25];
                // KODE POS             = row[26];
                // KETERANGAN USAHA     = row[27];
                // IBU KANDUNG          = row[28];


                #desa - table_village
                #kec - table_district
                #kab/kota - table_cities
                #provinsi - table_provinci
                #kode pos - kode_pos

                $batch = '';
                // Desa
                if ($row[1] != '') {

                    if ($row[1] == '1') {
                        $batch = '1';

                    } else if ($row[1] == '2') {
                        $batch = '2';

                    } else if ($row[1] == '3') {
                        $batch = '4';

                    } else if ($row[4] == '4') {
                        $batch = '5';
                    }
                }
                
                //Cabang 
                // if ($row[0] != '') {
                //     if ($row[0] == 'BANDUNG') {
                //         $cabang_unit = '1';
                //     } else if ($row[0] == 'GARUT') {
                //         $cabang_unit = '2';
                //     } else {
                //         $cabang_unit = '';
                //     }
                // }
                
                // Desa
                if ($row[22] != '') {
                    $desa = Village::where('name', 'like',  '%'.$row[22].'%')->first();
                    if ($desa != '') {
                        $desa = $desa->id;
                    } else {
                        $desa = '';
                    }
                } else {
                    $desa = '';
                }

                // Kec
                if ($row[23] != '') {
                    $kec = District::where('name', 'like', '%'. $row[23].'%')->first();
                    if ($kec != ''){
                        $kec = $kec->id;
                    } else {
                        $kec = '';
                    }
                } else {
                    $kec = '';
                }

                // // Kab/Kota
                // if ($row[24] != '') {
                //     $kabKota = 
                // }

                // Provinsi
                if ($row[25] != '') {
                    $provincy = Province::where('name', 'like', '%'.$row[25].'%')->first();

                    if ($provincy != '') {
                        $provincy = $provincy->id;
                    } else {
                        $provincy = '';
                    }
                } else {
                    $provincy = '';
                }


                $anggota_id = Anggota::create([
                    // 'cabang_unit' => $cabang_unit,
                    'cabang_unit' => '2',
                    'nama_pemohon' => $row[8] ?? '',
                    'no_mitra' => $row[2] ?? '',
                    // 'email' => ,
                    'nik' => $row[17] ?? '',
                    // 'no_kk' => ,
                    'tanggal_lahir' => $row[16] ?? '',
                    'tempat_lahir' => $row[15] ?? '',
                    // 'jenis_kelamin' => ,
                    // 'status_perkahwinan' => ,
                    // 'pendidikan' => ,
                    // 'pekerjaan' => ,
                    // 'no_rumah' => ,
                    'nama_jalan' => $row[21] ?? '',
                    // 'rtrw' => ,
                    'desa' => $desa,
                    'kecamatan' => $kec,
                    // 'kota' => ,
                    'provinsi' => $provincy,
                    'kode_pos' => $row[26] ?? '',
                    'bumdes' => $row[9] ?? '',
                    // 'coordinates' => ,
                    'no_hp' => $row[18] ?? '',
                    // 'no_telpon' => ,
                    // 'status_keluarga' => ,
                    'nama_ibu' => $row[28] ?? '',
                    'namasehubungkeluarga' => $row[19] ?? '',
                    // 'no_telp_keluarga' => $row[],
                    // 'nama_kerabat' => ,
                    'status_aktif' => '1',
                    'id_status_keanggotaan' => '11',
                ]);

                $namaexplode = explode(" ", $row[8]);
                $namaWarung = 'Warung ' . $namaexplode[0];

                $warung = DaftarWarung::create([
                    'cabang_unit' => '1',
                    'id_anggota' => $anggota_id->id,
                    // 'tanggal' => '000000000',
                    'nik' => $row[17] ?? '',
                    'no_mitra' => $row[2] ?? '',
                    'nama_warung' => $namaWarung,
                    'profil_warung' => '000000000',
                    // 'bidang_usaha' => '000000000',
                    // 'berdiri_sejak' => '000000000',
                    // 'status_bangunan' => '000000000',
                    'tempat_sama' => '1',
                    // 'nama_jalan' => '000000000',
                    // 'no_rumah' => '000000000',
                    // 'rtrw' => '000000000',
                    // 'provinsi' => '000000000',
                    // 'kota' => '000000000',
                    // 'kecamatan' => '000000000',
                    // 'desa' => '000000000',
                    // 'kodepos' => '000000000',
                    // 'wilayah' => '000000000',
                    'status_aktif' => '1',
                    // 'id_status_keanggotaan' => '000000000',
                    // 'map' => '000000000',
                    // 'coordinates' => '000000000',
                ]);


                // $countRekSimpananPokok = RekeningSimpanan::where('id', '=', '4');
                // $genPokok = '0010101' .  str_pad($countRekSimpananPokok->count() + 1, 5, 0, STR_PAD_LEFT);

                // $countRekSimpananWajib = RekeningSimpanan::where('id', '=', '5');
                // $genWajib = '0010102' .  str_pad($countRekSimpananWajib->count() + 1, 5, 0, STR_PAD_LEFT);

                // $countRekSimpananPendanaan = RekeningSimpanan::where('id', '=', '6');
                // $genPendanaan = '0010103' .  str_pad($countRekSimpananPendanaan->count() + 1, 5, 0, STR_PAD_LEFT);

                // NOREK PENDANAAN      = row[6];

                // Simpanan pokok
                RekeningSimpanan::create([
                    'cabang_unit' => '1',
                    'anggota_id' => $anggota_id->id,
                    // 'ao_id' => 'oooooooooo',
                    'no_akun' => $row[3],
                    'pilihan_akad' => '1',
                    'produk_id' => '4',
                    // 'nilai_pengajuan' => 'oooooooooo',
                    // 'nilai_pembiayaan' => 'oooooooooo',
                    // 'nilai_simpanan' => 'oooooooooo',
                    // 'nilai_setoran' => 'oooooooooo',
                    // 'interest_percentage' => 'oooooooooo',
                    // 'interest' => 'oooooooooo',
                    // 'sumber_dana' => 'oooooooooo',
                    // 'jangka_waktu' => 'oooooooooo',
                    'status' => 'aktif'
                ]);
                
                // Simpanan Wajib
                RekeningSimpanan::create([
                    'cabang_unit' => '1',
                    'anggota_id' => $anggota_id->id,
                    // 'ao_id' => 'oooooooooo',
                    'no_akun' => $row[4],
                    'pilihan_akad' => '1',
                    'produk_id' => '5',
                    // 'nilai_pengajuan' => 'oooooooooo',
                    // 'nilai_pembiayaan' => 'oooooooooo',
                    // 'nilai_simpanan' => 'oooooooooo',
                    // 'nilai_setoran' => 'oooooooooo',
                    // 'interest_percentage' => 'oooooooooo',
                    // 'interest' => 'oooooooooo',
                    // 'sumber_dana' => 'oooooooooo',
                    // 'jangka_waktu' => 'oooooooooo',
                    'status' => 'aktif'
                ]);
                
                // Simpanan Pendanaan
                RekeningSimpanan::create([
                    'cabang_unit' => '1',
                    'anggota_id' => $anggota_id->id,
                    // 'ao_id' => 'oooooooooo',
                    'no_akun' => $row[5],
                    'pilihan_akad' => '1',
                    'produk_id' => '6',
                    // 'nilai_pengajuan' => 'oooooooooo',
                    // 'nilai_pembiayaan' => 'oooooooooo',
                    // 'nilai_simpanan' => 'oooooooooo',
                    // 'nilai_setoran' => 'oooooooooo',
                    // 'interest_percentage' => 'oooooooooo',
                    // 'interest' => 'oooooooooo',
                    // 'sumber_dana' => 'oooooooooo',
                    // 'jangka_waktu' => 'oooooooooo',
                    'status' => 'aktif'
                ]);


                RekeningPendanaan::create([
                    'cabang_unit' => '1',
                    'anggota_id' => $anggota_id->id,
                    // 'ao_id' => 'oooooooooo',
                    'no_akun' => $row[6],
                    'pilihan_akad' => '1',
                    'produk_id' => $batch,
                    // 'nilai_pengajuan' => 'oooooooooo',
                    // 'nilai_pembiayaan' => 'oooooooooo',
                    // 'nilai_simpanan' => 'oooooooooo',
                    // 'nilai_setoran' => 'oooooooooo',
                    // 'interest_percentage' => 'oooooooooo',
                    // 'interest' => 'oooooooooo',
                    // 'sumber_dana' => 'oooooooooo',
                    // 'jangka_waktu' => 'oooooooooo',
                    'status' => 'aktif'
                ]);


                // RekeningSimpanan::create([
                //     'cabang_unit' => '1',
                //     'anggota_id' => $anggota_id->id,
                //     // 'ao_id' => 'oooooooooo',
                //     'no_akun' => $row[5],
                //     'pilihan_akad' => '1',
                //     'produk_id' => '6',
                //     // 'nilai_pengajuan' => 'oooooooooo',
                //     // 'nilai_pembiayaan' => 'oooooooooo',
                //     // 'nilai_simpanan' => 'oooooooooo',
                //     // 'nilai_setoran' => 'oooooooooo',
                //     // 'interest_percentage' => 'oooooooooo',
                //     // 'interest' => 'oooooooooo',
                //     // 'sumber_dana' => 'oooooooooo',
                //     // 'jangka_waktu' => 'oooooooooo',
                        // 'status' => '1',
                // ]);

            }

        }

    }

}
