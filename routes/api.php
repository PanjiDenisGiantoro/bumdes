<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('kategori',[\App\Http\Controllers\api\ApiKategoriController::class,'index']);
Route::get('login',[\App\Http\Controllers\api\UserController::class,'login']);
Route::post('logout',[\App\Http\Controllers\api\UserController::class,'logout']);
Route::post('register',[\App\Http\Controllers\api\UserController::class,'register']);
Route::get('supplier',[\App\Http\Controllers\api\ApiSupplierController::class,'index']);
Route::get('produk/{id?}',[\App\Http\Controllers\api\apiProdukController::class,'index']);
Route::post('midtrans/callback', [MidtransController::class, 'callback']);

Route::get('zuser',[\App\Http\Controllers\api\mobile\MobileRegisterController::class,'login'])->name('zlogin.login');
Route::get('zuser/daftar',[\App\Http\Controllers\api\mobile\MobileRegisterController::class,'register'])->name('zlogin.register');
Route::post('zpengajuan/daftar',[\App\Http\Controllers\api\mobile\MobileRegisterController::class,'pengajuan'])->name('zpengajuan.register');
Route::get('zpengajuan/',[\App\Http\Controllers\api\mobile\MobileRegisterController::class,'viewpengajuan'])->name('zpengajuan.viewpengajuan');
Route::get('margin',[\App\Http\Controllers\api\mobile\MobileRegisterController::class,'getMargin'])->name('margin.margin');
Route::get('durasi',[\App\Http\Controllers\api\mobile\MobileRegisterController::class,'getDurasi'])->name('durasi.durasi');
Route::get('rasio',[\App\Http\Controllers\api\mobile\MobileRegisterController::class,'getRasio'])->name('rasio.rasio');

Route::get('provinces',[\App\Http\Controllers\api\mobile\MobileRegisterController::class,'provinces'])->name('cities.province');
Route::get('cities',[\App\Http\Controllers\api\mobile\MobileRegisterController::class,'cities'])->name('cities.citiesById');
Route::get('district',[\App\Http\Controllers\api\mobile\MobileRegisterController::class,'district'])->name('cities.district');
Route::get('vilages',[\App\Http\Controllers\api\mobile\MobileRegisterController::class,'villages'])->name('cities.districts');
//pengajuan viewpengajuan
Route::get('pengajuan/{id?}',[\App\Http\Controllers\api\mobile\MobileRegisterController::class,'detailPengajuan'])->name('pengajuan.pengajuan');


// Mobile e-commerce
Route::get('commerce/produk', [\App\Http\Controllers\api\MobileCommerce\V1\ProdukController::class, 'index']);
Route::get('commerce/produk/{id}', [\App\Http\Controllers\api\MobileCommerce\V1\ProdukController::class, 'show']);
Route::get('commerce/produk-category/{category}', [\App\Http\Controllers\api\MobileCommerce\V1\ProdukController::class, 'productCategory']);
Route::get('commerce/category', [\App\Http\Controllers\api\MobileCommerce\V1\CategoryController::class, 'index']);
Route::get('commerce/category-popular', [\App\Http\Controllers\api\MobileCommerce\V1\CategoryController::class, 'categoryPopular']);

Route::post('commerce/login', [\App\Http\Controllers\api\MobileCommerce\V1\UserController::class, 'login']);

// Route::group(['middleware' => 'auth:api'], function () {
    Route::get('commerce/user-rekening/{id}', [\App\Http\Controllers\api\MobileCommerce\V1\UserController::class, 'userRekening']);
// });

Route::post('commerce/cart', [\App\Http\Controllers\api\MobileCommerce\V1\CartController::class, 'index']);
Route::post('commerce/cart-add', [\App\Http\Controllers\api\MobileCommerce\V1\CartController::class, 'addCart']);
Route::post('commerce/cart-update', [\App\Http\Controllers\api\MobileCommerce\V1\CartController::class, 'updateCart']);





Route::get('example',[\App\Http\Controllers\api\ApiKategoriController::class,'apiexample']);

Route::middleware([
    'api'
])  ->prefix('api')
    ->group(function () {

        // Route::post('user/login', [App\Http\Controllers\Tenants\Api\UserController::class, 'login']);
    });
