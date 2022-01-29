<?php

use App\Http\Controllers\adminapicontroller;
use App\Http\Controllers\adminbahancontroller;
use App\Http\Controllers\adminbahanproduksicontroller;
use App\Http\Controllers\admincetakcontroller;
use App\Http\Controllers\admindashboardcontroller;
use App\Http\Controllers\admingedungcontroller;
use App\Http\Controllers\admingrafikcontroller;
use App\Http\Controllers\adminhasilpanencontroller;
use App\Http\Controllers\adminkategoricontroller;
use App\Http\Controllers\adminkriteriacontroller;
use App\Http\Controllers\adminkriteriadetailcontroller;
use App\Http\Controllers\adminmaintenancecontroller;
use App\Http\Controllers\adminmesincontroller;
use App\Http\Controllers\adminmonitoringcontroller;
use App\Http\Controllers\adminnotifcontroller;
use App\Http\Controllers\adminpegawaicontroller;
use App\Http\Controllers\adminpelaporankerusakancontroller;
use App\Http\Controllers\adminpelatihcontroller;
use App\Http\Controllers\adminpemaincontroller;
use App\Http\Controllers\adminpemainseleksicontroller;
use App\Http\Controllers\adminpengolahanbahancontroller;
use App\Http\Controllers\adminpenilaiancontroller;
use App\Http\Controllers\adminpenilaiandetailcontroller;
use App\Http\Controllers\adminpetanicontroller;
use App\Http\Controllers\adminposisipemaincontroller;
use App\Http\Controllers\adminposisiseleksicontroller;
use App\Http\Controllers\adminprodukcontroller;
use App\Http\Controllers\adminprodukrugilabacontroller;
use App\Http\Controllers\adminprosesperhitungancontroller;
use App\Http\Controllers\adminrekaprugilabacontroller;
use App\Http\Controllers\adminseedercontroller;
use App\Http\Controllers\adminseederthcontroller;
use App\Http\Controllers\adminsettingscontroller;
use App\Http\Controllers\admintahunpenilaiancontroller;
use App\Http\Controllers\admintahunpenilaiandetailcontroller;
use App\Http\Controllers\adminuserscontroller;
use App\Http\Controllers\landingcontroller;
use App\Http\Controllers\operatormaintenancecontroller;
use App\Http\Controllers\operatormesincontroller;
use App\Http\Controllers\operatormonitoringcontroller;
use App\Http\Controllers\operatorpelaporankerusakancontroller;
use App\Http\Controllers\pelatihtahunpenilaiancontroller;
use App\Http\Controllers\pemaintahunpenilaiancontroller;
use App\Http\Controllers\profilecontroller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Facades\Yugo\SMSGateway\Interfaces\SMS;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


Route::get('/', [landingcontroller::class, 'index']);


//halaman admin fixed
Route::group(['middleware' => ['auth:web', 'verified']], function() {

    //DASHBOARD-MENU
    Route::get('/dashboard', [admindashboardcontroller::class, 'index'])->name('dashboard');
    //settings
    Route::get('/admin/settings', [adminsettingscontroller::class, 'index'])->name('settings');
    Route::put('/admin/settings/{id}', [adminsettingscontroller::class, 'update'])->name('settings.update');


    Route::get('/admin/profile', [adminsettingscontroller::class, 'profile'])->name('profile');
    Route::put('/admin/profile/admin/update', [adminsettingscontroller::class, 'profileupdate'])->name('profileupdate');

    Route::get('/pelatih/profile/', [profilecontroller::class, 'pelatih'])->name('pelatih.profile');
    Route::put('/pelatih/profile/update', [profilecontroller::class, 'pelatihupdate'])->name('pelatih.profileupdate');

    Route::get('/pemain/profile/', [profilecontroller::class, 'pemain'])->name('pemain.profile');
    Route::put('/pemain/profile/update', [profilecontroller::class, 'pemainupdate'])->name('pemain.profileupdate');

    //MASTERING
    //USER
    Route::get('/admin/users', [adminuserscontroller::class, 'index'])->name('users');
    Route::get('/admin/users/{id}', [adminuserscontroller::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{id}', [adminuserscontroller::class, 'update'])->name('users.update');
    Route::delete('/admin/users/{id}', [adminuserscontroller::class, 'destroy'])->name('users.destroy');
    Route::get('/admin/datausers/cari', [adminuserscontroller::class, 'cari'])->name('users.cari');
    Route::get('/admin/datausers/create', [adminuserscontroller::class, 'create'])->name('users.create');
    Route::post('/admin/datausers', [adminuserscontroller::class, 'store'])->name('users.store');
    Route::delete('/admin/datausers/multidel', [adminuserscontroller::class, 'multidel'])->name('users.multidel');


    //kategori
    Route::get('/admin/kategori', [adminkategoricontroller::class, 'index'])->name('kategori');
    Route::get('/admin/kategori/{id}', [adminkategoricontroller::class, 'edit'])->name('kategori.edit');
    Route::put('/admin/kategori/{id}', [adminkategoricontroller::class, 'update'])->name('kategori.update');
    Route::delete('/admin/kategori/{id}', [adminkategoricontroller::class, 'destroy'])->name('kategori.destroy');
    Route::get('/admin/datakategori/cari', [adminkategoricontroller::class, 'cari'])->name('kategori.cari');
    Route::get('/admin/datakategori/create', [adminkategoricontroller::class, 'create'])->name('kategori.create');
    Route::post('/admin/datakategori', [adminkategoricontroller::class, 'store'])->name('kategori.store');


    //bahan
    Route::get('/admin/bahan', [adminbahancontroller::class, 'index'])->name('bahan');
    Route::get('/admin/bahan/{id}', [adminbahancontroller::class, 'edit'])->name('bahan.edit');
    Route::put('/admin/bahan/{id}', [adminbahancontroller::class, 'update'])->name('bahan.update');
    Route::delete('/admin/bahan/{id}', [adminbahancontroller::class, 'destroy'])->name('bahan.destroy');
    Route::get('/admin/databahan/cari', [adminbahancontroller::class, 'cari'])->name('bahan.cari');
    Route::get('/admin/databahan/create', [adminbahancontroller::class, 'create'])->name('bahan.create');
    Route::post('/admin/databahan', [adminbahancontroller::class, 'store'])->name('bahan.store');


    //pegawai
    Route::get('/admin/pegawai', [adminpegawaicontroller::class, 'index'])->name('pegawai');
    Route::get('/admin/pegawai/{id}', [adminpegawaicontroller::class, 'edit'])->name('pegawai.edit');
    Route::put('/admin/pegawai/{id}', [adminpegawaicontroller::class, 'update'])->name('pegawai.update');
    Route::delete('/admin/pegawai/{id}', [adminpegawaicontroller::class, 'destroy'])->name('pegawai.destroy');
    Route::get('/admin/datapegawai/cari', [adminpegawaicontroller::class, 'cari'])->name('pegawai.cari');
    Route::get('/admin/datapegawai/create', [adminpegawaicontroller::class, 'create'])->name('pegawai.create');
    Route::post('/admin/datapegawai', [adminpegawaicontroller::class, 'store'])->name('pegawai.store');



    //petani
    Route::get('/admin/petani', [adminpetanicontroller::class, 'index'])->name('petani');
    Route::get('/admin/petani/{id}', [adminpetanicontroller::class, 'edit'])->name('petani.edit');
    Route::put('/admin/petani/{id}', [adminpetanicontroller::class, 'update'])->name('petani.update');
    Route::delete('/admin/petani/{id}', [adminpetanicontroller::class, 'destroy'])->name('petani.destroy');
    Route::get('/admin/datapetani/cari', [adminpetanicontroller::class, 'cari'])->name('petani.cari');
    Route::get('/admin/datapetani/create', [adminpetanicontroller::class, 'create'])->name('petani.create');
    Route::post('/admin/datapetani', [adminpetanicontroller::class, 'store'])->name('petani.store');



    //produk
    Route::get('/admin/produk', [adminprodukcontroller::class, 'index'])->name('produk');
    Route::get('/admin/produk/{id}', [adminprodukcontroller::class, 'edit'])->name('produk.edit');
    Route::put('/admin/produk/{id}', [adminprodukcontroller::class, 'update'])->name('produk.update');
    Route::delete('/admin/produk/{id}', [adminprodukcontroller::class, 'destroy'])->name('produk.destroy');
    Route::get('/admin/dataproduk/cari', [adminprodukcontroller::class, 'cari'])->name('produk.cari');
    Route::get('/admin/dataproduk/create', [adminprodukcontroller::class, 'create'])->name('produk.create');
    Route::post('/admin/dataproduk', [adminprodukcontroller::class, 'store'])->name('produk.store');



    //pengolahanbahan
    Route::get('/admin/pengolahanbahan', [adminpengolahanbahancontroller::class, 'index'])->name('pengolahanbahan');
    Route::get('/admin/pengolahanbahan/{id}', [adminpengolahanbahancontroller::class, 'edit'])->name('pengolahanbahan.edit');
    Route::put('/admin/pengolahanbahan/{id}', [adminpengolahanbahancontroller::class, 'update'])->name('pengolahanbahan.update');
    Route::delete('/admin/pengolahanbahan/{id}', [adminpengolahanbahancontroller::class, 'destroy'])->name('pengolahanbahan.destroy');
    Route::get('/admin/datapengolahanbahan/cari', [adminpengolahanbahancontroller::class, 'cari'])->name('pengolahanbahan.cari');
    Route::get('/admin/datapengolahanbahan/create', [adminpengolahanbahancontroller::class, 'create'])->name('pengolahanbahan.create');
    Route::post('/admin/datapengolahanbahan', [adminpengolahanbahancontroller::class, 'store'])->name('pengolahanbahan.store');



    //hasilpanen
    Route::get('/admin/hasilpanen', [adminhasilpanencontroller::class, 'index'])->name('hasilpanen');
    Route::get('/admin/hasilpanen/{id}', [adminhasilpanencontroller::class, 'edit'])->name('hasilpanen.edit');
    Route::put('/admin/hasilpanen/{id}', [adminhasilpanencontroller::class, 'update'])->name('hasilpanen.update');
    Route::delete('/admin/hasilpanen/{id}', [adminhasilpanencontroller::class, 'destroy'])->name('hasilpanen.destroy');
    Route::get('/admin/datahasilpanen/cari', [adminhasilpanencontroller::class, 'cari'])->name('hasilpanen.cari');
    Route::get('/admin/datahasilpanen/create', [adminhasilpanencontroller::class, 'create'])->name('hasilpanen.create');
    Route::post('/admin/datahasilpanen', [adminhasilpanencontroller::class, 'store'])->name('hasilpanen.store');




    //produkrugilaba
    Route::get('/admin/produkrugilaba', [adminprodukrugilabacontroller::class, 'index'])->name('produkrugilaba');
    Route::get('/admin/produkrugilaba/{id}', [adminprodukrugilabacontroller::class, 'edit'])->name('produkrugilaba.edit');
    Route::put('/admin/produkrugilaba/{id}', [adminprodukrugilabacontroller::class, 'update'])->name('produkrugilaba.update');
    Route::delete('/admin/produkrugilaba/{id}', [adminprodukrugilabacontroller::class, 'destroy'])->name('produkrugilaba.destroy');
    Route::get('/admin/dataprodukrugilaba/cari', [adminprodukrugilabacontroller::class, 'cari'])->name('produkrugilaba.cari');
    Route::get('/admin/dataprodukrugilaba/create', [adminprodukrugilabacontroller::class, 'create'])->name('produkrugilaba.create');
    Route::post('/admin/dataprodukrugilaba', [adminprodukrugilabacontroller::class, 'store'])->name('produkrugilaba.store');

    //API
    Route::get('/admin/api/kriteriadetail/{tahunpenilaian}', [admintahunpenilaiandetailcontroller::class, 'apikriteriadetail'])->name('api.kriteriadetail');
    Route::get('/admin/api/periksaminimum/{tahunpenilaian}', [admintahunpenilaiandetailcontroller::class, 'apiperiksaminimum'])->name('api.periksaminimum');
    Route::get('/admin/api/pemainseleksi/inputnilai/{tahunpenilaian}', [adminapicontroller::class, 'pemainseleksi_inputnilai'])->name('api.pemainseleksi.inputnilai');

    Route::get('/admin/api/nilaipersiswa/{prosespenilaian}/{pemainseleksi}/{kriteriadetail}', [adminapicontroller::class, 'nilaipersiswa'])->name('api.nilaipersiswa');



    //seeder
    Route::post('/admin/seeder/hard', [adminseedercontroller::class, 'hard'])->name('seeder.hard');

    Route::post('/admin/proses/cleartemp', [adminprosescontroller::class, 'cleartemp'])->name('cleartemp');



});


