<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkadController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\AgunanController;
use App\Http\Controllers\WarungController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ArusKasController;
use App\Http\Controllers\KodeSkuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TetapanController;
use App\Http\Controllers\LabaRugiController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\BukuBesarController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ECommerceController;
use App\Http\Controllers\KodeBulanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\TutupBukuController;
use App\Http\Controllers\DaftarAsetController;
use App\Http\Controllers\KodeProfilController;
use App\Http\Controllers\KodeSistemController;
use App\Http\Controllers\PembiayaanController;
use App\Http\Controllers\SumberDanaController;
use App\Http\Controllers\TempImportController;
use App\Http\Controllers\TemplateWaController;
use App\Http\Controllers\TipeKontakController;
use App\Http\Controllers\UmurHutangController;
use App\Http\Controllers\AkunOfficerController;
use App\Http\Controllers\BeratSatuanController;
use App\Http\Controllers\JurnalEntryController;
use App\Http\Controllers\TemplateSmsController;
use App\Http\Controllers\UmurPiutangController;
use App\Http\Controllers\DaftarKontakController;
use App\Http\Controllers\DaftarProdukController;
use App\Http\Controllers\DaftarWarungController;
use App\Http\Controllers\GudangProdukController;
use App\Http\Controllers\KodeKelompokController;
use App\Http\Controllers\KodePenggunaController;
use App\Http\Controllers\PemetaanAkunController;
use App\Http\Controllers\SatuanProdukController;
use App\Http\Controllers\SemuaLaporanController;
use App\Http\Controllers\SummaryBatchController;
use App\Http\Controllers\AkunPerkiraanController;
use App\Http\Controllers\LaporanProdukController;
use App\Http\Controllers\PelepasanAsetController;
use App\Http\Controllers\RingkasanBankController;
use App\Http\Controllers\SettingKontakController;
use App\Http\Controllers\SettingProdukController;
use App\Http\Controllers\TagihanVendorController;
use App\Http\Controllers\TemplateEmailController;
use App\Http\Controllers\BiayaPerKontakController;
use App\Http\Controllers\JenisTransaksiController;
use App\Http\Controllers\JurnalKeuanganController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\KodePendidikanController;
use App\Http\Controllers\KodePerusahaanController;
use App\Http\Controllers\PajakPenjualanController;
use App\Http\Controllers\PenyusutanAsetController;
use App\Http\Controllers\PerubahanModalController;
use App\Http\Controllers\DaftarInventoriController;
use App\Http\Controllers\DetailAsetTetapController;
use App\Http\Controllers\DetailPembelianController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\KodeBidangUsahaController;
use App\Http\Controllers\LaporanProduksiController;
use App\Http\Controllers\NeracaAkuntansiController;
use App\Http\Controllers\NeracaFinancialController;
use App\Http\Controllers\PajakPemotonganController;
use App\Http\Controllers\RekeningSimjakaController;
use App\Http\Controllers\RingkasanKontakController;
use App\Http\Controllers\RingkasanProdukController;
use App\Http\Controllers\SettingKeuanganController;
use App\Http\Controllers\SumberPendanaanController;
use App\Http\Controllers\TipeKontakGroupController;
use App\Http\Controllers\TujuanPengajuanController;
use App\Http\Controllers\AnggaranLabaRugiController;
use App\Http\Controllers\BagiHasilSettingController;
use App\Http\Controllers\BagiHasilSimpananController;
use App\Http\Controllers\DaftarPembiayaanController;
use App\Http\Controllers\DenominasiController;
use App\Http\Controllers\DetailKlaimBiayaController;
use App\Http\Controllers\PelepasanAsetMgtController;
use App\Http\Controllers\RekeningSimpananController;
use App\Http\Controllers\SettingPenjualanController;
use App\Http\Controllers\TagihanPelangganController;
use App\Http\Controllers\ManajemenAnggaranController;
use App\Http\Controllers\RekeningPendanaanController;
use App\Http\Controllers\SimpananBerjangkaController;
use App\Http\Controllers\StatuskeanggotaanController;
use App\Http\Controllers\TransaksiKeuanganController;
use App\Http\Controllers\InventoriTransaksiController;
use App\Http\Controllers\KodeDaftarPenggunaController;
use App\Http\Controllers\KodeStatusBangunanController;
use App\Http\Controllers\KodeStatusKeluargaController;
use App\Http\Controllers\PembelianPerProdukController;
use App\Http\Controllers\PembelianPerVendorController;
use App\Http\Controllers\PenjualanPerProdukController;
use App\Http\Controllers\PerpajakanKeuanganController;
use App\Http\Controllers\RekeningPembiayaanController;
use App\Http\Controllers\RingkasanAsetTetapController;
use App\Http\Controllers\RingkasanInventoriController;
use App\Http\Controllers\RingkasanPembelianController;
use App\Http\Controllers\RingkasanPenjualanController;
use App\Http\Controllers\SumberPengembalianController;
use App\Http\Controllers\TemplateNotifikasiController;
use App\Http\Controllers\PengirimanPembelianController;
use App\Http\Controllers\PengirimanPenjualanController;
use App\Http\Controllers\PengurusanFinancialController;
use App\Http\Controllers\PersetujuanKeuanganController;
use App\Http\Controllers\RingkasanStokGudangController;
use App\Http\Controllers\KodeKasArusAktivitasController;
use App\Http\Controllers\KodeStatusPembiayaanController;
use App\Http\Controllers\LaporanAnggotaProdukController;
use App\Http\Controllers\LaporanAO;
use App\Http\Controllers\LaporanAOController;
use App\Http\Controllers\LaporanPembiayaan;
use App\Http\Controllers\LaporanSimpanan;
use App\Http\Controllers\LaporanSimpananBerjangka;
use App\Http\Controllers\PergerakanStokGudangController;
use App\Http\Controllers\OngkosKirimPerKirimanController;
use App\Http\Controllers\PendapatanPerPelangganController;
use App\Http\Controllers\ProdukRekeningSimpananController;
use App\Http\Controllers\RingkasanHutangPiutangController;
use App\Http\Controllers\SettingTerminPenjualanController;
use App\Http\Controllers\PenjualanPerSalesPersonController;
use App\Http\Controllers\PergerakanStokInventoriController;
use App\Http\Controllers\ProdukRekeningPembiayaanController;
use App\Http\Controllers\Pembelian\DaftarPembelianController;
use App\Http\Controllers\Pembelian\PembelianTerminController;
use App\Http\Controllers\SettingEkspedisiPenjualanController;
use App\Http\Controllers\Pembelian\PembelianPesananController;
use App\Http\Controllers\Pembelian\PembelianSettingController;
use App\Http\Controllers\Pembelian\PembelianEkpedisiController;
use App\Http\Controllers\Pembelian\PembelianSupplierController;
use App\Http\Controllers\Pembelian\PembelianPembayaranController;
use App\Http\Controllers\Pembelian\PembelianPenerimaanController;
use App\Http\Controllers\ProdukRekeningSimpananBerjangkaController;

//use \App\Http\Controllers\GooglemapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('contact-us', [ContactUsController::class, 'create']);
Route::post('contact-us', [ContactUsController::class, 'store']);

Route::get('warung-kami', function () {
    return view('warung-kami');
});

Route::get('daftar-warung', [DaftarWarungController::class, 'index'])->name('pages.daftar_warung.index');
Route::get('daftar-warung/search', [DaftarWarungController::class, 'index'])->name('pages.daftar_warung.search');
Route::get('daftar-warung/{daftar_warung}', [DaftarWarungController::class, 'show'])->name('pages.daftar_warung.show');
Route::get('daftar-warung/{daftar_warung}', [DaftarWarungController::class, 'show'])->name('pages.daftar_warung.show');
Route::get('daftar_warung/show2/{id}', [DaftarWarungController::class, 'show2'])->name('daftar_warung.show2');

Route::get('laporan-warung', [\App\Http\Controllers\LaporanWarungController::class, 'index'])->name('laporan-warung.index')->middleware('permission:laporan-keanggotaan.laporan-keanggotaan');
Route::get('laporan-warung/export', [\App\Http\Controllers\LaporanWarungController::class, 'export'])->name('laporan-warung.export')->middleware('permission:laporan-keanggotaan.laporan-keanggotaan');
Route::get('laporan-warung/cetak', [\App\Http\Controllers\LaporanWarungController::class, 'cetak'])->name('laporan-warung.cetak')->middleware('permission:laporan-keanggotaan.laporan-keanggotaan');

// Route::get('e-commerce', [ECommerceController::class, 'index'])->name('pages.e-commerce.index');
Route::get('e-commerce/products/{product}', [ECommerceController::class, 'showProduct'])->name('pages.e-commerce.products.show');

// Route::resource('carts', CartsController::class);
Route::get('e-commerce', [CartsController::class, 'index'])->name('carts.e-commerce.index');
Route::get('carts', [CartsController::class, 'list'])->name('carts.list');
Route::get('carts/getdataanggota', [CartsController::class, 'getDataAnggota'])->name('getDataAnggota');
Route::post('carts', [CartsController::class, 'store'])->name('carts.addToCart');
Route::post('carts/checkout', [CartsController::class, 'add'])->name('carts.checkout');
Route::delete('carts/{id}', [CartsController::class, 'delete'])->name('carts.hapus');

// Midtrans
Route::post('midtrans/callback', [MidtransController::class, 'callback'])->name('midtrans.callback');
Route::get('midtrans/success', [MidtransController::class, 'success'])->name('midtrans.success');
Route::get('midtrans/unfinnish', [MidtransController::class, 'unfinish'])->name('midtrans.unfinish');
Route::get('midtrans/error', [MidtransController::class, 'error'])->name('midtrans.error');

//daftar pembiayaan

Route::get('daftar_pembiayaan/lihat/{id}', [DaftarPembiayaanController::class, 'lihat'])->name('daftar_pembiayaan.showup');
Route::get('daftar_pembiayaan/cetak/{id}', [DaftarPembiayaanController::class, 'cetak'])->name('daftar_pembiayaan.cetak');
// Route::get('getdatapembiayaan',[DaftarPembiayaanController::class,'getdatapembiayaan'])->name('getdatapembiayaan');
Route::get('laporan-pembiayaan/index', [\App\Http\Controllers\LaporanPendanaanController::class, 'index'])->name('laporan-pembiayaan.index')->middleware('permission:laporan-keanggotaan.laporan-keanggotaan');

Route::get('at-taqwa',[\App\Http\Controllers\Pengajuan\LoginController::class,'view'])->name('login_pengajuan');
Route::post('login_pengajuan', [App\Http\Controllers\Pengajuan\LoginController::class,'actionlogin'])->name('actionlogin');
Route::get('register_pengajuan',[\App\Http\Controllers\Pengajuan\RegisterController::class,'create'])->name('register_pengajuan.create');
Route::post('register_pengajuan',[\App\Http\Controllers\Pengajuan\RegisterController::class,'store'])->name('register_pengajuan.store');
Route::middleware(['auth'])->group(function () {
    Route::get('actionlogout', [\App\Http\Controllers\Pengajuan\LoginController::class,'actionlogout'])->name('actionlogout')->middleware('auth');
    Route::get('/dashboard_pengajuan', [\App\Http\Controllers\Pengajuan\HomeController::class,'index'])->name('dashboard_pengajuan');
    Route::resource('setting_rasio', \App\Http\Controllers\Pengajuan\SettingRasioController::class);
    Route::resource('durasi', \App\Http\Controllers\Pengajuan\DurasiController::class);
    Route::resource('margin', \App\Http\Controllers\Pengajuan\MarginController::class);
    Route::get('pengajuan',[\App\Http\Controllers\Pengajuan\PengajuanController::class,'index'])->name('pengajuan.index');
    Route::get('pengajuan/create',[\App\Http\Controllers\Pengajuan\PengajuanController::class,'create'])->name('pengajuan.create');
    Route::post('pengajuan/daftar',[\App\Http\Controllers\Pengajuan\PengajuanController::class,'store'])->name('pengajuan.store');
    Route::get('pengajuan/show/{id}',[\App\Http\Controllers\Pengajuan\PengajuanController::class,'show'])->name('pengajuan.show');
    Route::delete('pengajuan/{id}',[\App\Http\Controllers\Pengajuan\PengajuanController::class,'destroy'])->name('pengajuan.destroy');
    // Route::resource('kode_hak_akses', \App\Http\Controllers\RoleController::class)->middleware('permission:setting-utama.setting-utama');
    Route::resource('kode_hak_akses', \App\Http\Controllers\RoleController::class);
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('warung', WarungController::class);

    Route::resource('pembiayaan', PembiayaanController::class);


    Route::resource('tetapan', TetapanController::class);

    Route::resource('setting_penjualan', SettingPenjualanController::class);

    Route::resource('akad', AkadController::class)->middleware('permission:setting-rekening.setting-rekening');

    Route::resource('setting_termin_penjualan', SettingTerminPenjualanController::class)->middleware('permission:setting-produk.setting-produk');

    Route::resource('ekspedisi_penjualan', SettingEkspedisiPenjualanController::class)->middleware('permission:setting-produk.setting-produk');

    Route::resource('kolektibilitas', \App\Http\Controllers\KolekbilitasController::class)->middleware('permission:setting-rekening.setting-rekening');

    Route::resource('pemesanan_penjualan', PemesananController::class)
    ->middleware('permission:penjualan-pemesanan.lihat|penjualan-pemesanan.Tambah');

    Route::resource('status_keanggotaan', StatuskeanggotaanController::class)->middleware('permission:setting-utama.setting-utama');

    Route::resource('kelompok_aset', \App\Http\Controllers\KelompokasetController::class)->middleware('permission:setting-kode.setting-kode');

    Route::resource('sumber_dana', SumberDanaController::class)->middleware('permission:setting-rekening.setting-rekening');

    Route::resource('pengiriman', \App\Http\Controllers\PengirimanController::class);
    Route::get('getdatapemesanan',[\App\Http\Controllers\PengirimanController::class,'getdatapemesanan'])->name('getdatapemesanan');

    Route::resource('penjualan', PenjualanController::class)
        ->middleware('permission:penjualan-penawaran.Tambah|penjualan-penawaran.print|penjualan-penawaran.lihat');
    Route::get('tagihan_penjualan',[PenjualanController::class,'tagihan'])->name('penjualan.tagihan');
    Route::get('getdatapenjualan',[PenjualanController::class,'getdatapenjualan'])->name('getdatapenjualan');
    Route::get('getdatapenawaran',[PenjualanController::class,'getdatapenawaran'])->name('getdatapenawaran');
    Route::as('anggota.')
        ->group(function () {
            Route::get('anggota/{id}/approve', [AnggotaController::class, 'approve'])
//                ->middleware(['permission:anggota.delete'])
                ->name('approve');

            Route::put('anggota/{id}/persetujuan-angggota', [AnggotaController::class, 'update_approve'])
                // ->name('update_approve');
                ->name('update_approve'); // FIXME: Panji please fix this  -Arrave 20/5

            Route::get('anggota/{id}/berhenti', [AnggotaController::class, 'berhenti'])
//                ->middleware(['permission:anggota.delete'])
                ->name('berhenti');

            Route::get('anggota/{id}/cetak', [AnggotaController::class, 'cetak'])
//                ->middleware(['permission:anggota.delete'])
                ->name('cetak');


            Route::put('anggota/{id}/approve-angggota', [AnggotaController::class, 'update_berhenti'])
                ->name('update_berhenti');

            Route::get('anggota', [AnggotaController::class, 'index'])
//                ->middleware(['permission:anggota.Lihat'])
                ->name('index');

            Route::get('anggota/search', [AnggotaController::class, 'index'])->name('anggota.search');
            Route::get('anggota/filter', [AnggotaController::class, 'anggotafiltersearch'])->name('anggota.filter');

            Route::get('anggota/create', [AnggotaController::class, 'create'])
                ->middleware(['permission:anggota.Tambah'])
                ->name('create');

            Route::post('anggota', [AnggotaController::class, 'store'])
                ->name('store');

            Route::get('anggota/{id}/edit', [AnggotaController::class, 'edit'])
                ->middleware(['permission:anggota.Ubah'])
                ->name('edit');

            Route::put('anggota/{id}/', [AnggotaController::class, 'update'])
                ->name('update');

            Route::get('anggota/{id}/{nama_anggota?}', [AnggotaController::class, 'show'])
                ->middleware(['permission:anggota.Cetak'])
                ->name('show');

            Route::delete('anggota/{id}', [AnggotaController::class, 'destroy'])
//                ->middleware(['permission:anggota.delete'])
                ->name('destroy');

        });

    Route::resource('daftar_warung', DaftarWarungController::class)->except('show');
    Route::delete('anggota/destroyFoto/{id}',[AnggotaController::class,'destroyFoto'])->name('anggota.destroyFoto');
    Route::delete('anggota/destroyKtp/{id}',[AnggotaController::class,'destroyKtp'])->name('anggota.destroyKtp');
    Route::get('daftar_warung/{id}/{nama_warung?}', [DaftarWarungController::class, 'show'])->name('daftar_warung.show');


    Route::resource('daftar_pembiayaan', DaftarPembiayaanController::class)
        ->middleware('permission:daftar-pendanaan.Tambah|daftar-pendanaan.Ubah|daftar-pendanaan.Lihat|daftar-pendanaan.Cetak-pdf|daftar-pendanaan.Cetak-rincian');
    Route::get('getdatapembiayaan',[DaftarPembiayaanController::class,'getdatapembiayaan'])->name('getdatapembiayaan');
    Route::get('daftar_pembiayaan/cetak/{id}',[DaftarPembiayaanController::class,'cetak'])->name('daftar_pembiayaan.cetak');

    // detail aset tetap
    Route::get('detail_aset_tetap', [DetailAsetTetapController::class, 'index'])->name('detail_aset_tetap.index');
    Route::get('detail_aset_tetap/show', [DetailAsetTetapController::class, 'show'])->name('detail_aset_tetap.show');



    // Bagi Hasil - Arrave
    Route::prefix('bagi-hasil')
        ->as('bagi-hasil.')
        ->group(function () {

            // Simpanan
            Route::as('simpanan.')
                ->group(function () {    
                    Route::get('simpanan', [BagiHasilSimpananController::class, 'index'])->name('index');
                });

            // Setting
            Route::as('setting.')
                ->group(function () {    
                    Route::get('setting', [BagiHasilSettingController::class, 'index'])->name('index');
                    Route::post('setting/store', [BagiHasilSettingController::class, 'store'])->name('store');
                    Route::delete('setting/delete/{id}', [BagiHasilSettingController::class, 'destroy'])->name('destroy');
                });
        });



    // Simpanan Berjangka
    Route::get('bagi-hasil/simpanan-berjangka', [SimpananBerjangkaController::class, 'index'])->name('simpanan_berjangka.index')->middleware('permission:bagi-hasil.simpanan-berjangka');

     // Setting bagi hasil
     Route::get('bagi-hasil/simpanan-berjangka', [SimpananBerjangkaController::class, 'index'])->name('simpanan_berjangka.index')->middleware('permission:bagi-hasil.simpanan-berjangka');


    Route::get('pemindahbukuan', [\App\Http\Controllers\PemindahbukuanController::class, 'index'])->name('pemindahbukuan.index');
    Route::post('pemindahbukuan', [\App\Http\Controllers\PemindahbukuanController::class, 'store'])->name('pemindahbukuan.store');
    Route::get('pemindahbukuan/laporan', [\App\Http\Controllers\PemindahbukuanController::class, 'laporan'])->name('pemindahbukuan.laporan');


    Route::resource('kode_perusahaan', KodePerusahaanController::class);

    Route::resource('pengurusan', \App\Http\Controllers\PengurusanController::class);

    Route::resource('kode_profil', KodeProfilController::class)->middleware('permission:setting-utama.setting-utama');

    Route::resource('setting-pendanaan', \App\Http\Controllers\SettingPendanaanController::class)
    ->middleware('permission:setting-pendanaan.Tambah|setting-pendanaan.Ubah');

    Route::resource('kode_sistem', KodeSistemController::class);

    Route::resource('kode_daftar_pengguna', KodeDaftarPenggunaController::class)->middleware('permission:setting-utama.setting-utama');

//    Route::resource('kode_hak_akses', KodeHakAksesController::class);

    Route::resource('kode_pengguna', KodePenggunaController::class)->middleware('permission:setting-utama.setting-utama');

    Route::resource('kode_bidang_usaha', KodeBidangUsahaController::class)->middleware('permission:setting-kode.setting-kode');


    Route::resource('kode_status_bangunan', KodeStatusBangunanController::class)->middleware('permission:setting-kode.setting-kode');

    Route::resource('sumber_pendanaan', SumberPendanaanController::class)->middleware('permission:setting-pendanaan.sumber-pendanaan');

    Route::resource('berat_satuan', BeratSatuanController::class)->middleware('permission:setting-produk.setting-produk');

    Route::resource('kode_status_keluarga', KodeStatusKeluargaController::class)->middleware('permission:setting-kode.setting-kode');

    Route::resource('kode_bulan', KodeBulanController::class);

    Route::resource('kode_pendidikan', KodePendidikanController::class)->middleware('permission:setting-kode.setting-kode');

    Route::resource('kode_status_pembiayaan', KodeStatusPembiayaanController::class)->middleware('permission:setting-kode.setting-kode');

    Route::as('summary_batch.')
        ->group(function (){
            Route::get('summary_batch', [SummaryBatchController::class, 'index'])
//                ->middleware(['permission:anggota.Lihat'])
                ->name('index');

            Route::get('summary_batch/create', [SummaryBatchController::class, 'create'])
                ->middleware(['permission:summary-batch.Tambah'])
                ->name('create');

            Route::post('summary_batch', [SummaryBatchController::class, 'store'])
//                ->middleware(['permission:summary-batch.Tambah'])
                ->name('store');

            Route::get('summary_batch/{id}', [SummaryBatchController::class, 'show'])
                ->middleware(['permission:summary-batch.Lihat'])
                ->name('show');
            Route::get('summary/export/{id}', [SummaryBatchController::class, 'export'])
                ->name('export');
        });

//    Route::resource('summary_batch', SummaryBatchController::class);
//    ->middleware('permission:summary-batch.Lihat|summary-batch.Tambah');

    Route::get('summary_batch/status/{id}',[SummaryBatchController::class,'status'])->name('summary_batch.status');
    Route::PUT('summary_batch/{id}/approve',[SummaryBatchController::class,'approve'])->name('summary_batch.approve');




    Route::resource('template_wa', TemplateWaController::class)->middleware('permission:setting-template.setting-template');

    Route::resource('template_notifikasi', TemplateNotifikasiController::class)->middleware('permission:setting-template.setting-template');

    Route::resource('template_email', TemplateEmailController::class)->middleware('permission:setting-template.setting-template');

    Route::resource('template_sms', TemplateSmsController::class)->middleware('permission:setting-template.setting-template');

    Route::resource('daftar_kontak', DaftarKontakController::class);

    Route::resource('ringkasan_kontak', RingkasanKontakController::class);

    Route::resource('setting_kontak', SettingKontakController::class);

    Route::resource('tipe_kontak', TipeKontakController::class)->middleware('permission:setting-kontak.setting-kontak');

    Route::resource('tipe_kontak_group', TipeKontakGroupController::class);

    Route::resource('bank', \App\Http\Controllers\BankController::class)->middleware('permission:setting-bank.bank');

    //route provinsi
    Route::get('provinces', [SettingController::class, 'provinces'])->name('provinces');
    Route::get('cities',  [SettingController::class, 'cities'])->name('cities');
    Route::get('citiesJakarta',  [SettingController::class, 'citiesJakarta'])->name('citiesJakarta');
    Route::get('districts',  [SettingController::class, 'districts'])->name('districts');
    Route::get('villages', [SettingController::class, 'villages'])->name('villages');

    //route get anggota
    Route::get('getdata',[WarungController::class,'getdata'])->name('getdata');
    Route::get('getdatawarung',[WarungController::class,'getdatawarung'])->name('getdatawarung');
    //route pdf

    Route::resource('daftar_produk', DaftarProdukController::class)
        ->middleware('permission:daftar-produk.Lihat|daftar-produk.Tambah|daftar-produk.Ubah|daftar-produk.delete');

    Route::resource('laporan_produk', LaporanProdukController::class);

    Route::resource('ringkasan_produk', RingkasanProdukController::class);

    Route::resource('setting_produk', SettingProdukController::class);

    Route::resource('sumber_pengembalian', SumberPengembalianController::class)->middleware('permission:setting-rekening.setting-rekening');

    Route::resource('agunan', AgunanController::class)->middleware('permission:setting-rekening.setting-rekening');

    Route::resource('kategori_produk', KategoriProdukController::class)->middleware('permission:setting-produk.setting-produk');

    Route::resource('satuan_produk', SatuanProdukController::class)->middleware('permission:setting-produk.setting-produk');

    Route::resource('kode_sku', KodeSkuController::class)->middleware('permission:setting-produk.setting-produk');

    Route::resource('gudang_produk', GudangProdukController::class)->middleware('permission:setting-produk.setting-produk');

    Route::resource('semua_laporan', SemuaLaporanController::class);

    Route::resource('neraca_financial', NeracaFinancialController::class)->middleware('permission:laporan-keuangan.laporan-keuangan');

    Route::resource('arus_kas', ArusKasController::class)->middleware('permission:laporan-keuangan.laporan-keuangan');

    Route::resource('laba_rugi', LabaRugiController::class)->middleware('permission:laporan-keuangan.laporan-keuangan');

    Route::resource('perubahan_modal', PerubahanModalController::class)->middleware('permission:laporan-keuangan.laporan-keuangan');

    Route::resource('pengurusan_financial', PengurusanFinancialController::class);

    Route::resource('ringkasan_bank', RingkasanBankController::class)->middleware('permission:laporan-keuangan.laporan-keuangan');

    Route::resource('buku_besar', BukuBesarController::class)->middleware('permission:laporan-keuangan.laporan-keuangan');

    Route::resource('jurnal_entry', JurnalEntryController::class)->middleware('permission:laporan-keuangan.laporan-keuangan');

    Route::get('ringkasan-hutang-piutang', RingkasanHutangPiutangController::class)->name('ringkasan_hutang_piutang.index')->middleware('permission:laporan-keuangan.laporan-keuangan');

    Route::resource('neraca_akuntansi', NeracaAkuntansiController::class)->middleware('permission:laporan-keuangan.laporan-keuangan');

    Route::resource('biaya_per_kontak', BiayaPerKontakController::class)->middleware('permission:laporan-biaya.biaya-per-kontak');

    Route::resource('biaya', \App\Http\Controllers\BiayaController::class)->middleware('permission:biaya.lihat|biaya.Tambah');

    Route::resource('detail_klaim_biaya', DetailKlaimBiayaController::class);

    Route::resource('pajak_penjualan', PajakPenjualanController::class)->middleware('permission:laporan-pajak.pajak-penjualan');

    Route::resource('pajak_pemotongan', PajakPemotonganController::class);

    Route::resource('ringkasan_inventori', RingkasanInventoriController::class)->middleware('permission:laporan-inventory.laporan-inventory');

    Route::resource('tujuan_pengajuan', TujuanPengajuanController::class)->middleware('permission:setting-rekening.setting-rekening');

    Route::resource('pergerakan_stok_inventori', PergerakanStokInventoriController::class)->middleware('permission:laporan-inventory.laporan-inventory');

    Route::resource('ringkasan_stok_gudang', RingkasanStokGudangController::class);

    Route::resource('pergerakan_stok_gudang', PergerakanStokGudangController::class);

    Route::resource('laporan_produksi', LaporanProduksiController::class);

    Route::resource('ringkasan_aset_tetap', RingkasanAsetTetapController::class)->middleware('permission:laporan-aset-tetap.laporan-aset-tetap');

    // Route::resource('detail_aset_tetap', DetailAsetTetapController::class);

    Route::resource('pelepasan_aset', PelepasanAsetController::class)->middleware('permission:laporan-aset-tetap.laporan-aset-tetap');

    Route::resource('manajemen_anggaran', ManajemenAnggaranController::class);

    Route::resource('anggaran_laba_rugi', AnggaranLabaRugiController::class);

    Route::resource('daftar_aset', DaftarAsetController::class)
    ->middleware('permission:management-aset.Lihat|management-aset.Tambah|management-aset.Ubah|management-aset.delete');

    Route::resource('penyusutan_aset', PenyusutanAsetController::class)->middleware('permission:penyusutan.lihat');

    Route::resource('pelepasan_aset_mgt', PelepasanAsetMgtController::class)->middleware('permission:laporan-aset-tetap.laporan-aset-tetap');

    Route::resource('detail_penjualan', DetailPenjualanController::class)->middleware('permission:laporan-penjualan.laporan-penjualan');;

    Route::resource('umur_piutang', UmurPiutangController::class)->middleware('permission:laporan-penjualan.laporan-penjualan');;

    Route::resource('tagihan_pelanggan', TagihanPelangganController::class)->middleware('permission:laporan-penjualan.laporan-penjualan');;

    Route::resource('pendapatan_per_pelanggan', PendapatanPerPelangganController::class)->middleware('permission:laporan-penjualan.laporan-penjualan');;

    Route::resource('penjualan_per_produk', PenjualanPerProdukController::class)->middleware('permission:laporan-penjualan.laporan-penjualan');;

    Route::resource('penjualan_per_sales_person', PenjualanPerSalesPersonController::class);

    Route::resource('pengiriman_penjualan', PengirimanPenjualanController::class);

    Route::resource('ongkos_kirim_per_kiriman', OngkosKirimPerKirimanController::class)->middleware('permission:laporan-pembelian.laporan-pembelian');

    Route::resource('detail_pembelian', DetailPembelianController::class)->middleware('permission:laporan-pembelian.laporan-pembelian');;

    Route::resource('umur_hutang', UmurHutangController::class)->middleware('permission:laporan-pembelian.laporan-pembelian');;


    Route::resource('tagihan_vendor', TagihanVendorController::class)->middleware('permission:laporan-pembelian.laporan-pembelian');;

    Route::resource('pembelian_per_produk', PembelianPerProdukController::class)->middleware('permission:laporan-pembelian.laporan-pembelian');;

    Route::resource('penomoran', \App\Http\Controllers\PenomoranController::class)->middleware('permission:setting-penomoran-auto.setting');

    Route::resource('penomoran_penjualan', \App\Http\Controllers\PenomoranPenjualanController::class);

    Route::resource('pembelian_per_vendor', PembelianPerVendorController::class)->middleware('permission:laporan-pembelian.laporan-pembelian');;

    Route::resource('pengiriman_pembelian', PengirimanPembelianController::class);

    Route::resource('setting_keuangan', SettingKeuanganController::class);

    Route::resource('akun_perkiraan', AkunPerkiraanController::class)->middleware('permission:setting-keuangan.setting-keuangan');

    Route::resource('perpajakan_keuangan', PerpajakanKeuanganController::class)->middleware('permission:setting-keuangan.setting-keuangan');

    Route::resource('pelanggan', \App\Http\Controllers\PelangganController::class);

    Route::resource('persetujuan_keuangan', PersetujuanKeuanganController::class)->middleware('permission:setting-keuangan.setting-keuangan');

    Route::resource('kode_kelompok', KodeKelompokController::class)->middleware('permission:setting-keuangan.setting-keuangan');

    // Route::resource('cabang', \App\Http\Controllers\CabangController::class)->middleware('permission:setting-utama.setting-utama');
    Route::resource('cabang', \App\Http\Controllers\CabangController::class);
    Route::get('cabang/updatestatus/{id}', [\App\Http\Controllers\CabangController::class,'updatestatus'])->name('cabang.updatestatus');

    Route::resource('jenis_transaksi', JenisTransaksiController::class)->middleware('permission:setting-keuangan.setting-keuangan');

    Route::resource('jurnal_keuangan', JurnalKeuanganController::class)->middleware('permission:jurnal-transaksi.lihat|jurnal-transaksi.Tambah');

    // Teller
        // Transaksi Keuangan
        Route::resource('transaksi_keuangan', TransaksiKeuanganController::class)->middleware('permission:keuangan-transaksi.lihat|keuangan-transaksi.Tambah');
        
        //Denominasi
        Route::get('denominasi', [DenominasiController::class, 'index'])->name('denominasi.index');
        Route::get('denominasi/tambah', [DenominasiController::class, 'create'])->name('denominasi.tambah');
        Route::post('denominasi/tambah', [DenominasiController::class, 'store'])->name('denominasi.add');

    Route::resource('kode_kas_arus_aktivitas', KodeKasArusAktivitasController::class)->middleware('permission:setting-keuangan.setting-keuangan');

    Route::resource('tutup_buku', TutupBukuController::class);

    Route::resource('pemetaan_akun', PemetaanAkunController::class)->middleware('permission:setting-keuangan.setting-keuangan');

    // Route::resource('pembelian-setting', PembelianSettingController::class);

//    Route::get('kasir/create', [KasirController::class, 'create'])->name('kasir.create');
//    Route::get('kasir/{pembeli?}', [KasirController::class, 'index'])->name('kasir.index');
    Route::resource('kasir', KasirController::class);


    Route::group(['prefix' => 'pembelian'],
        function () {

            Route::group(['prefix' => 'daftar-pembelian'], function() {
                Route::get('/', [DaftarPembelianController::class, 'index'])->name('pembelian.daftar-pembelian')->middleware('permission:daftar-pembelian.lihat');
            });

            Route::group(['prefix' => 'pesanan'], function() {
                Route::get('/', [PembelianPesananController::class, 'index'])->name('pembelian.pesanan.index');
                Route::get('/tambah', [PembelianPesananController::class, 'create'])->name('pembelian.pesanan.create');
                Route::post('/tambah', [PembelianPesananController::class, 'store'])->name('pembelian.pesanan.store');
                Route::get('/getdata', [PembelianPesananController::class, 'getDataSupplier'])->name('pembelian.pesanan.getdata');
                Route::get('/getdata-produk', [PembelianPesananController::class, 'getDataProduk'])->name('pembelian.pesanan.getdataproduk');
                Route::get('/show/{id}', [PembelianPesananController::class, 'show'])->name('pembelian.pesanan.show');
            });

            Route::group(['prefix' => 'penerimaan'], function() {
                Route::get('/', [PembelianPenerimaanController::class, 'index'])->name('pembelian.penerimaan.index');
                Route::get('/tambah', [PembelianPenerimaanController::class, 'create'])->name('pembelian.penerimaan.create')->middleware('permission:pembelian-penerimaan.Tambah');
                Route::post('/tambah', [PembelianPenerimaanController::class, 'store'])->name('pembelian.penerimaan.store');
                Route::delete('/hapus/{id}', [PembelianPenerimaanController::class, 'destroy'])->name('pembelian.penerimaan.destroy');
                Route::get('/getdatapesanan', [PembelianPenerimaanController::class, 'getdatapesanan'])->name('pembelian.penerimaan.getdatapesanan');
                Route::get('/getdatapesananbody', [PembelianPenerimaanController::class, 'getdatapesananbody'])->name('pembelian.penerimaan.getdatapesananbody');
                Route::get('/show/{id}', [PembelianPenerimaanController::class, 'show'])->name('pembelian.penerimaan.show')->middleware('permission:pembelian-penerimaan.cetak');
            });

            Route::group(['prefix' => 'pembayaran'], function() {
                Route::get('/', [PembelianPembayaranController::class, 'index'])->name('pembelian.pembayaran.index');
                Route::get('/create/{id}', [PembelianPembayaranController::class, 'create'])->name('pembelian.pembayaran.create');
                Route::get('pembelian/pembayaran/edit/{id}', [PembelianPembayaranController::class, 'edit'])->name('pembelian.pembayaran.edit')->middleware('pembelian-pembayaran.bayar-tagihan');
                Route::post('/buat', [PembelianPembayaranController::class, 'store'])->name('pembelian.pembayaran.store');
                Route::post('/buat_sebagian', [PembelianPembayaranController::class, 'store_sebagian'])->name('pembelian.pembayaran.store_sebagian');
                Route::get('/show/{id}', [PembelianPembayaranController::class, 'show'])->name('pembelian.pembayaran.show')->middleware('permission:pembelian-pembayaran.lihat');
                Route::get('/show_pdf/{id}', [PembelianPembayaranController::class, 'show_pdf'])->name('pembelian.pembayaran.show_pdf')->middleware('permission:pembelian-pembayaran.cetak-invoice');
            });

            Route::group(['prefix' => 'setting'], function () {
                Route::get('/', [PembelianSettingController::class, 'index'])->name('pembelian.setting');

                Route::get('termin', [PembelianTerminController::class, 'index'])->name('pembelian.setting.termin.index');
                Route::post('termin/tambah', [PembelianTerminController::class, 'store'])->name('pembelian.setting.termin.store');
                Route::get('termin/create', [PembelianTerminController::class, 'create'])->name('pembelian.setting.termin.create');
                Route::put('termin/update/{id}', [PembelianTerminController::class, 'update'])->name('pembelian.setting.termin.update');
                Route::get('termin/edit/{id}', [PembelianTerminController::class, 'edit'])->name('pembelian.setting.termin.edit');
                Route::delete('termin/hapus/{id}', [PembelianTerminController::class, 'destroy'])->name('pembelian.setting.termin.destroy');

                Route::get('ekpedisi', [PembelianEkpedisiController::class, 'index'])->name('pembelian.setting.ekpedisi.index');
                Route::post('ekpedisi/tambah', [PembelianEkpedisiController::class, 'store'])->name('pembelian.setting.ekpedisi.store');
                Route::get('ekpedisi/create', [PembelianEkpedisiController::class, 'create'])->name('pembelian.setting.ekpedisi.create');
                Route::put('ekpedisi/update/{id}', [PembelianEkpedisiController::class, 'update'])->name('pembelian.setting.ekpedisi.update');
                Route::get('ekpedisi/edit/{id}', [PembelianEkpedisiController::class, 'edit'])->name('pembelian.setting.ekpedisi.edit');
                Route::delete('ekpedisi/hapus/{id}', [PembelianEkpedisiController::class, 'destroy'])->name('pembelian.setting.ekpedisi.destroy');

                Route::get('supplier', [PembelianSupplierController::class, 'index'])->name('pembelian.setting.supplier.index')->middleware('permission:setting-kontak.setting-kontak');
                Route::post('supplier/tambah', [PembelianSupplierController::class, 'store'])->name('pembelian.setting.supplier.store');
                Route::get('supplier/create', [PembelianSupplierController::class, 'create'])->name('pembelian.setting.supplier.create');
                Route::put('supplier/update/{id}', [PembelianSupplierController::class, 'update'])->name('pembelian.setting.supplier.update');
                Route::get('supplier/edit/{id}', [PembelianSupplierController::class, 'edit'])->name('pembelian.setting.supplier.edit');
                Route::delete('supplier/hapus/{id}', [PembelianSupplierController::class, 'destroy'])->name('pembelian.setting.supplier.destroy');
            });
        });

    Route::group(['prefix' => 'daftar_inventori'], function() {
                Route::get('/', [DaftarInventoriController::class, 'index'])->name('daftar_inventori.index')->middleware('permission:inventory.lihat');
                Route::get('/show/{id}', [DaftarInventoriController::class, 'show'])->name('daftar_inventori.show');
                Route::post('daftar_inventori/tambah', [DaftarInventoriController::class, 'store'])->name('daftar_inventori.store');
                Route::get('/show2', [DaftarInventoriController::class, 'show2'])->name('daftar_inventori.show2');
                Route::get('/lihat', [DaftarInventoriController::class, 'lihat'])->name('daftar_inventori.lihat');
                Route::get('/transaksi', [DaftarInventoriController::class, 'create'])->name('daftar_inventori.create');
            });

    Route::resource('transaksi', InventoriTransaksiController::class);

    // Route::resource('daftar_inventori', DaftarInventoriController::class);
    // Route::get('daftar_inventori', [DaftarInventoriController::class, 'show2'])->name('pages.daftar_inventori.show2');

    // profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('laporan-keanggotaan/index', [\App\Http\Controllers\LaporanKeanggotaanController::class, 'index'])->name('laporan-keanggotaan.index')->middleware('permission:laporan-keanggotaan.laporan-keanggotaan');
    Route::get('laporan-keanggotaan/export', [\App\Http\Controllers\LaporanKeanggotaanController::class, 'export'])->name('laporan-keanggotaan.export')->middleware('permission:laporan-keanggotaan.laporan-keanggotaan');
    Route::get('laporan-keanggotaan/cetak', [\App\Http\Controllers\LaporanKeanggotaanController::class, 'cetak'])->name('laporan-keanggotaan.cetak')->middleware('permission:laporan-keanggotaan.laporan-keanggotaan');

    // Laporan Anggota Product
    Route::get('laporan-anggota-product/index', [LaporanAnggotaProdukController::class, 'index'])->name('laporan-anggota-product.index');


    Route::get('produk-simpanan/index', [ProdukRekeningSimpananController::class, 'index'])->name('produk-simpanan.index')->middleware('permission:setting-rekening.setting-rekening');
    Route::get('produk-simpanan/create', [ProdukRekeningSimpananController::class, 'create'])->name('produk-simpanan.create');
    Route::post('produk-simpanan/store', [ProdukRekeningSimpananController::class, 'store'])->name('produk-simpanan.store');
    Route::get('produk-simpanan/edit/{id}', [ProdukRekeningSimpananController::class, 'edit'])->name('produk-simpanan.edit');
    Route::put('produk-simpanan/update/{id}', [ProdukRekeningSimpananController::class, 'update'])->name('produk-simpanan.update');
    Route::get('produk-simpanan/show/{id}', [ProdukRekeningSimpananController::class, 'show'])->name('produk-simpanan.show');


    Route::get('produk-simpanan-berjangka/index', [ProdukRekeningSimpananBerjangkaController::class, 'index'])->name('produk-simpanan-berjangka.index');
    Route::get('produk-simpanan-berjangka/create', [ProdukRekeningSimpananBerjangkaController::class, 'create'])->name('produk-simpanan-berjangka.create');
    Route::post('produk-simpanan-berjangka/store', [ProdukRekeningSimpananBerjangkaController::class, 'store'])->name('produk-simpanan-berjangka.store');
    Route::get('produk-simpanan-berjangka/edit/{id}', [ProdukRekeningSimpananBerjangkaController::class, 'edit'])->name('produk-simpanan-berjangka.edit');
    Route::put('produk-simpanan-berjangka/update/{id}', [ProdukRekeningSimpananBerjangkaController::class, 'update'])->name('produk-simpanan-berjangka.update');
    Route::get('produk-simpanan-berjangka/show/{id}', [ProdukRekeningSimpananBerjangkaController::class, 'show'])->name('produk-simpanan-berjangka.show');


    Route::get('produk-pembiayaan/index', [ProdukRekeningPembiayaanController::class, 'index'])->name('produk-pembiayaan.index');
    Route::get('produk-pembiayaan/create', [ProdukRekeningPembiayaanController::class, 'create'])->name('produk-pembiayaan.create');
    Route::post('produk-pembiayaan/store', [ProdukRekeningPembiayaanController::class, 'store'])->name('produk-pembiayaan.store');
    Route::get('produk-pembiayaan/edit/{id}', [ProdukRekeningPembiayaanController::class, 'edit'])->name('produk-pembiayaan.edit');
    Route::put('produk-pembiayaan/update/{id}', [ProdukRekeningPembiayaanController::class, 'update'])->name('produk-pembiayaan.update');
    Route::get('produk-pembiayaan/show/{id}', [ProdukRekeningPembiayaanController::class, 'show'])->name('produk-pembiayaan.show');

    // Rekening Simpanan
    Route::as('rekening-simpanan.')
        ->group(function (){

    Route::get('rekening-simpanan/index', [RekeningSimpananController::class, 'index'])->name('index');
    Route::get('rekening-simpanan/create', [RekeningSimpananController::class, 'create'])->name('create')->middleware('permission:rekening-simpanan.Tambah');
    Route::post('rekening-simpanan/store', [RekeningSimpananController::class, 'store'])->name('store');
    Route::get('rekening-simpanan/edit/{id}', [RekeningSimpananController::class, 'edit'])->name('edit')->middleware('permission:rekening-simpanan.Ubah');
    Route::put('rekening-simpanan/update/{id}', [RekeningSimpananController::class, 'update'])->name('update');
    Route::get('rekening-simpanan/show/{id}', [RekeningSimpananController::class, 'show'])->name('show')->middleware('permission:rekening-simpanan.lihat');
    Route::get('rekening-simpanan/showUp/{id}', [RekeningSimpananController::class, 'showTransaksi'])->name('showTransaksi')->middleware('permission:rekening-simpanan.show-detail');
    Route::get('rekening-simpanan/getData', [RekeningSimpananController::class, 'getData'])->name('getData');
    Route::get('rekening-simpanan/getProduk', [RekeningSimpananController::class, 'getProduk'])->name('getProduk');
    Route::get('rekening-simpanan/{id}/approve', [RekeningSimpananController::class, 'edit'])->name('approve');
        });

    // Laporan Rekening SImpanan
        // Laporan Produk
        Route::get('laporan-simpanan-produk/index', [LaporanSimpanan::class, 'produkIndex'])->name('laporan-rekening-simpanan.produk');
        // Laporan Rekening
        Route::get('laporan-simpanan-rekening/index', [LaporanSimpanan::class, 'rekening'])->name('laporan-rekening-simpanan.rekening');
        // laporan bagi hasil
        Route::get('laporan-simpanan-bagi-hasil/index', [LaporanSimpanan::class, 'bagihasilSimpanan'])->name('laporan-rekening-simpanan.bagi-hasil');

    // Rekening Simpanan Berjangka
     // laporan Produk
        Route::get('laporan-simpanan-berjangka-produk/index', [LaporanSimpananBerjangka::class, 'produkIndex'])->name('laporan-rekening-simpanan-berjangka.produk');
     // laporan Rekening
        Route::get('laporan-simpanan-berjangka-rekening/index', [LaporanSimpananBerjangka::class, 'rekeningIndex'])->name('laporan-rekening-simpanan-berjangka.rekening');
        // laporan bagi hasil
        Route::get('laporan-simpanan-berjangka-bagi-hasil/index', [LaporanSimpananBerjangka::class, 'bagihasil'])->name('laporan-rekening-simpanan-berjangka.bagi-hasil');
     // laporan bagi hasil

     // Laporan Pembiayaan
        // Laporan Produk
        Route::get('laporan-pembiayaan-produk/index', [LaporanPembiayaan::class, 'produkIndex'])->name('laporan-rekening-pembiayaan.produk');
        // Laporan Rekening
        Route::get('laporan-pembiayaan-rekening/index', [LaporanPembiayaan::class, 'rekeningIndex'])->name('laporan-rekening-pembiayaan.rekening');
        // laporan bagi hasil
        Route::get('laporan-pembiayaan-bagi-hasil/index', [LaporanPembiayaan::class, 'kolektibilitasIndex'])->name('laporan-rekening-pembiayaan.kolekbilitas');
    
    // Laporan AO
        // Daftar Rekening
        Route::get('laporan-ao-daftar-rekening/index', [LaporanAOController::class, 'daftarRekening'])->name('laporan-ao-daftar-rekening');
        // Pembukaan Rekening Baru
        Route::get('laporan-ao/rekening-baru/index', [LaporanAOController::class, 'laporanrekbaruIndex'])->name('laporan-ao.rekening-baru');
        // Kolektibitas
        Route::get('laporan-ao/kolektibitas/index', [LaporanAOController::class, 'kolektibilitasIndex'])->name('laporan-ao.kolektibitas');


    // Rekening Pembiayaan
    Route::as('rekening-pembiayaan.')
        ->group(function (){

    Route::get('rekening-pembiayaan/index', [RekeningPembiayaanController::class, 'index'])->name('index');
    Route::get('rekening-pembiayaan/create', [RekeningPembiayaanController::class, 'create'])->name('create')->middleware('permission:rekening-pembiayaan.Tambah');
    Route::post('rekening-pembiayaan/store', [RekeningPembiayaanController::class, 'store'])->name('store');
    Route::get('rekening-pembiayaan/show/{id}', [RekeningPembiayaanController::class, 'show'])->name('show')->middleware('permission:rekening-pembiayaan.lihat');
    Route::get('rekening-pembiayaan/{id}', [RekeningPembiayaanController::class, 'edit'])->name('edit')->middleware('permission:rekening-pembiayaan.Ubah');
    Route::put('rekening-pembiayaan/{id}', [RekeningPembiayaanController::class, 'update'])->name('update');
    Route::get('rekening-pembiayaan/{id}/approve', [RekeningPembiayaanController::class, 'edit'])->name('approve');
    Route::get('rekening-pembiayaan/{id}/persetujuan', [RekeningPembiayaanController::class, 'edit_persetujuan'])->name('edit_persetujuan');
    Route::put('rekening-pembiayaan/{id}/persetujuan', [RekeningPembiayaanController::class, 'update_persetujuan'])->name('update_letter');
        });

    // Rekening Pendanaan
    Route::get('rekening-pendanaan',[RekeningPendanaanController::class,'index'])->name('rekening-pendanaan.index')
        ->middleware('permission:rekening-pendanaan.lihat');
    ;
    Route::get('rekening-pendanaan/{id}',[RekeningPendanaanController::class,'show'])->name('rekening-pendanaan.show')
        ->middleware('permission:rekening-pendanaan.lihat');

    Route::prefix('rekening')
        ->as('rekening.')
        ->group(function () {

            // Rekening Simjaka
            Route::as('simjaka.')
                ->group(function () {
                    Route::get('simpanan-berjangka',[RekeningSimjakaController::class, 'index'])->name('index');
                    Route::get('simpanan-berjangka/create',[RekeningSimjakaController::class, 'create'])->name('create')->middleware('permission:rekening-simpanan-berjangka.Tambah');
                    Route::post('simpanan-berjangka/store',[RekeningSimjakaController::class, 'store'])->name('store');
                    Route::get('simpanan-berjangka/{id}',[RekeningSimjakaController::class, 'show'])->name('show')->middleware('permission:rekening-simpanan-berjangka.lihat');
                    Route::get('simpanan-berjangka/{id}/edit',[RekeningSimjakaController::class, 'edit'])->name('edit')->middleware('permission:rekening-simpanan-berjangka.Ubah');
                    Route::put('simpanan-berjangka/{id}/update',[RekeningSimjakaController::class, 'update'])->name('update');
                    Route::get('simpanan-berjangka/{id}/approve',[RekeningSimjakaController::class, 'edit'])->name('approve')->middleware('permission:rekening-simpanan-berjangka.approve');
                });
        });


    // Akun Officer
    Route::as('akun-officer.')
        ->group(function () {
            Route::get('akun-officer',[AkunOfficerController::class, 'index'])->name('index');
            Route::get('akun-officer/form',[AkunOfficerController::class, 'create'])->name('create');
            Route::post('akun-officer/store',[AkunOfficerController::class, 'store'])->name('store');
            Route::get('akun-officer/{id}/edit',[AkunOfficerController::class, 'edit'])->name('edit');
            Route::put('akun-officer/{id}/update',[AkunOfficerController::class, 'update'])->name('update');
            Route::get('akun-officer/{id}',[AkunOfficerController::class, 'show'])->name('show');
        });



    Route::get('rekening-pembiayaan/getDataProduk', [RekeningPembiayaanController::class, 'getDataProduk'])->name('rekening-pembiayaan.getDataProduk');
    // Route::get('rekening-pembiayaan/getDataAkad', [RekeningPembiayaanController::class, 'getDataAkad'])->name('rekening-pembiayaan.getDataAkad');


    Route::get('ringkasan-penjualan', [RingkasanPenjualanController::class, 'index'])->name('ringkasan-penjualan.index')->middleware('permission:ringkasan-penjualan.lihat');
    Route::get('ringkasan-pembelian', [RingkasanPembelianController::class, 'home'])->name('ringkasan-pembelian.index')->middleware('permission:ringkasan-pembelian.lihat');
    // Route::get('ringkasan-pembelians', [RingkasanPembelianController::class, 'home'])->name('ringkasan-pembelian.home');


    Route::post('import', [TempImportController::class, 'import'])->name('import.index');
});


