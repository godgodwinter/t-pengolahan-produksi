<?php

use App\Http\Controllers\adminapicontroller;
use App\Http\Controllers\admincetakcontroller;
use App\Http\Controllers\admindashboardcontroller;
use App\Http\Controllers\admingedungcontroller;
use App\Http\Controllers\admingrafikcontroller;
use App\Http\Controllers\adminkategoricontroller;
use App\Http\Controllers\adminkriteriacontroller;
use App\Http\Controllers\adminkriteriadetailcontroller;
use App\Http\Controllers\adminmaintenancecontroller;
use App\Http\Controllers\adminmesincontroller;
use App\Http\Controllers\adminmonitoringcontroller;
use App\Http\Controllers\adminnotifcontroller;
use App\Http\Controllers\adminpelaporankerusakancontroller;
use App\Http\Controllers\adminpelatihcontroller;
use App\Http\Controllers\adminpemaincontroller;
use App\Http\Controllers\adminpemainseleksicontroller;
use App\Http\Controllers\adminpenilaiancontroller;
use App\Http\Controllers\adminpenilaiandetailcontroller;
use App\Http\Controllers\adminposisipemaincontroller;
use App\Http\Controllers\adminposisiseleksicontroller;
use App\Http\Controllers\adminprosesperhitungancontroller;
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


    //gedung
    Route::get('/admin/gedung', [admingedungcontroller::class, 'index'])->name('gedung');
    Route::get('/admin/gedung/{id}', [admingedungcontroller::class, 'edit'])->name('gedung.edit');
    Route::put('/admin/gedung/{id}', [admingedungcontroller::class, 'update'])->name('gedung.update');
    Route::delete('/admin/gedung/{id}', [admingedungcontroller::class, 'destroy'])->name('gedung.destroy');
    Route::get('/admin/datagedung/cari', [admingedungcontroller::class, 'cari'])->name('gedung.cari');
    Route::get('/admin/datagedung/create', [admingedungcontroller::class, 'create'])->name('gedung.create');
    Route::post('/admin/datagedung', [admingedungcontroller::class, 'store'])->name('gedung.store');


    //kategori
    Route::get('/admin/kategori', [adminkategoricontroller::class, 'index'])->name('kategori');
    Route::get('/admin/kategori/{id}', [adminkategoricontroller::class, 'edit'])->name('kategori.edit');
    Route::put('/admin/kategori/{id}', [adminkategoricontroller::class, 'update'])->name('kategori.update');
    Route::delete('/admin/kategori/{id}', [adminkategoricontroller::class, 'destroy'])->name('kategori.destroy');
    Route::get('/admin/datakategori/cari', [adminkategoricontroller::class, 'cari'])->name('kategori.cari');
    Route::get('/admin/datakategori/create', [adminkategoricontroller::class, 'create'])->name('kategori.create');
    Route::post('/admin/datakategori', [adminkategoricontroller::class, 'store'])->name('kategori.store');


    //mesin
    Route::get('/admin/mesin', [adminmesincontroller::class, 'index'])->name('mesin');
    Route::get('/admin/mesin/{id}', [adminmesincontroller::class, 'edit'])->name('mesin.edit');
    Route::put('/admin/mesin/{id}', [adminmesincontroller::class, 'update'])->name('mesin.update');
    Route::delete('/admin/mesin/{id}', [adminmesincontroller::class, 'destroy'])->name('mesin.destroy');
    Route::get('/admin/datamesin/cari', [adminmesincontroller::class, 'cari'])->name('mesin.cari');
    Route::get('/admin/datamesin/create', [adminmesincontroller::class, 'create'])->name('mesin.create');
    Route::post('/admin/datamesin', [adminmesincontroller::class, 'store'])->name('mesin.store');


    //monitoring
    Route::get('/admin/monitoring', [adminmonitoringcontroller::class, 'index'])->name('monitoring');
    Route::get('/admin/monitoring/{id}', [adminmonitoringcontroller::class, 'edit'])->name('monitoring.edit');
    Route::put('/admin/monitoring/{id}', [adminmonitoringcontroller::class, 'update'])->name('monitoring.update');
    Route::delete('/admin/monitoring/{id}', [adminmonitoringcontroller::class, 'destroy'])->name('monitoring.destroy');
    Route::get('/admin/datamonitoring/cari', [adminmonitoringcontroller::class, 'cari'])->name('monitoring.cari');
    Route::get('/admin/datamonitoring/create', [adminmonitoringcontroller::class, 'create'])->name('monitoring.create');
    Route::post('/admin/datamonitoring', [adminmonitoringcontroller::class, 'store'])->name('monitoring.store');
    Route::get('/admin/monitoring/{id}/detail', [adminmonitoringcontroller::class, 'detail'])->name('monitoring.detail');
    Route::get('/admin/monitoring/{id}/detail/create', [adminmonitoringcontroller::class, 'detailcreate'])->name('monitoring.detail.create');
    Route::post('/admin/monitoring/{id}/detail/store', [adminmonitoringcontroller::class, 'detailstore'])->name('monitoring.detail.store');
    Route::delete('/admin/monitoring/{id}/detail/destroy/{monitoringdetail}', [adminmonitoringcontroller::class, 'detaildestroy'])->name('monitoring.detail.destroy');


    //pelaporankerusakan
    Route::get('/admin/pelaporankerusakan', [adminpelaporankerusakancontroller::class, 'index'])->name('pelaporankerusakan');
    Route::get('/admin/pelaporankerusakan/{id}', [adminpelaporankerusakancontroller::class, 'edit'])->name('pelaporankerusakan.edit');
    Route::put('/admin/pelaporankerusakan/{id}', [adminpelaporankerusakancontroller::class, 'update'])->name('pelaporankerusakan.update');
    Route::delete('/admin/pelaporankerusakan/{id}', [adminpelaporankerusakancontroller::class, 'destroy'])->name('pelaporankerusakan.destroy');
    Route::get('/admin/datapelaporankerusakan/cari', [adminpelaporankerusakancontroller::class, 'cari'])->name('pelaporankerusakan.cari');
    Route::get('/admin/datapelaporankerusakan/create', [adminpelaporankerusakancontroller::class, 'create'])->name('pelaporankerusakan.create');
    Route::post('/admin/datapelaporankerusakan', [adminpelaporankerusakancontroller::class, 'store'])->name('pelaporankerusakan.store');
    Route::get('/admin/pelaporankerusakan/{id}/detail', [adminpelaporankerusakancontroller::class, 'detail'])->name('pelaporankerusakan.detail');
    Route::get('/admin/pelaporankerusakan/{id}/detail/create', [adminpelaporankerusakancontroller::class, 'detailcreate'])->name('pelaporankerusakan.detail.create');
    Route::post('/admin/pelaporankerusakan/{id}/detail/store', [adminpelaporankerusakancontroller::class, 'detailstore'])->name('pelaporankerusakan.detail.store');
    Route::delete('/admin/pelaporankerusakan/{id}/detail/destroy/{pelaporankerusakandetail}', [adminpelaporankerusakancontroller::class, 'detaildestroy'])->name('pelaporankerusakan.detail.destroy');


    //maintenance
    Route::get('/admin/maintenance', [adminmaintenancecontroller::class, 'index'])->name('maintenance');
    Route::get('/admin/maintenance/{id}', [adminmaintenancecontroller::class, 'edit'])->name('maintenance.edit');
    Route::put('/admin/maintenance/{id}', [adminmaintenancecontroller::class, 'update'])->name('maintenance.update');
    Route::delete('/admin/maintenance/{id}', [adminmaintenancecontroller::class, 'destroy'])->name('maintenance.destroy');
    Route::get('/admin/datamaintenance/cari', [adminmaintenancecontroller::class, 'cari'])->name('maintenance.cari');
    Route::get('/admin/datamaintenance/create', [adminmaintenancecontroller::class, 'create'])->name('maintenance.create');
    Route::post('/admin/datamaintenance', [adminmaintenancecontroller::class, 'store'])->name('maintenance.store');
    Route::get('/admin/maintenance/{id}/detail', [adminmaintenancecontroller::class, 'detail'])->name('maintenance.detail');
    Route::get('/admin/maintenance/{id}/detail/create', [adminmaintenancecontroller::class, 'detailcreate'])->name('maintenance.detail.create');
    Route::post('/admin/maintenance/{id}/detail/store', [adminmaintenancecontroller::class, 'detailstore'])->name('maintenance.detail.store');
    Route::delete('/admin/maintenance/{id}/detail/destroy/{maintenancedetail}', [adminmaintenancecontroller::class, 'detaildestroy'])->name('maintenance.detail.destroy');

    //API
    Route::get('/admin/api/kriteriadetail/{tahunpenilaian}', [admintahunpenilaiandetailcontroller::class, 'apikriteriadetail'])->name('api.kriteriadetail');
    Route::get('/admin/api/periksaminimum/{tahunpenilaian}', [admintahunpenilaiandetailcontroller::class, 'apiperiksaminimum'])->name('api.periksaminimum');
    Route::get('/admin/api/pemainseleksi/inputnilai/{tahunpenilaian}', [adminapicontroller::class, 'pemainseleksi_inputnilai'])->name('api.pemainseleksi.inputnilai');

    Route::get('/admin/api/nilaipersiswa/{prosespenilaian}/{pemainseleksi}/{kriteriadetail}', [adminapicontroller::class, 'nilaipersiswa'])->name('api.nilaipersiswa');



    //seeder
    Route::post('/admin/seeder/hard', [adminseedercontroller::class, 'hard'])->name('seeder.hard');

    Route::post('/admin/proses/cleartemp', [adminprosescontroller::class, 'cleartemp'])->name('cleartemp');



    // menu operator


    Route::get('/operator/mesin', [operatormesincontroller::class, 'index'])->name('operator.mesin');
    Route::get('/operator/datamesin/cari', [operatormesincontroller::class, 'cari'])->name('operator.mesin.cari');

    //monitoring
    Route::get('/operator/monitoring', [operatormonitoringcontroller::class, 'index'])->name('operator.monitoring');
    Route::get('/operator/monitoring/{id}', [operatormonitoringcontroller::class, 'edit'])->name('operator.monitoring.edit');
    Route::put('/operator/monitoring/{id}', [operatormonitoringcontroller::class, 'update'])->name('operator.monitoring.update');
    Route::delete('/operator/monitoring/{id}', [operatormonitoringcontroller::class, 'destroy'])->name('operator.monitoring.destroy');
    Route::get('/operator/datamonitoring/cari', [operatormonitoringcontroller::class, 'cari'])->name('operator.monitoring.cari');
    Route::get('/operator/datamonitoring/create', [operatormonitoringcontroller::class, 'create'])->name('operator.monitoring.create');
    Route::post('/operator/datamonitoring', [operatormonitoringcontroller::class, 'store'])->name('operator.monitoring.store');
    Route::get('/operator/monitoring/{id}/detail', [operatormonitoringcontroller::class, 'detail'])->name('operator.monitoring.detail');
    Route::get('/operator/monitoring/{id}/detail/create', [operatormonitoringcontroller::class, 'detailcreate'])->name('operator.monitoring.detail.create');
    Route::post('/operator/monitoring/{id}/detail/store', [operatormonitoringcontroller::class, 'detailstore'])->name('operator.monitoring.detail.store');
    Route::delete('/operator/monitoring/{id}/detail/destroy/{monitoringdetail}', [operatormonitoringcontroller::class, 'detaildestroy'])->name('operator.monitoring.detail.destroy');



    Route::get('/operator/pelaporankerusakan', [operatorpelaporankerusakancontroller::class, 'index'])->name('operator.pelaporankerusakan');
    Route::get('/operator/pelaporankerusakan/{id}', [operatorpelaporankerusakancontroller::class, 'edit'])->name('operator.pelaporankerusakan.edit');
    Route::put('/operator/pelaporankerusakan/{id}', [operatorpelaporankerusakancontroller::class, 'update'])->name('operator.pelaporankerusakan.update');
    Route::delete('/operator/pelaporankerusakan/{id}', [operatorpelaporankerusakancontroller::class, 'destroy'])->name('operator.pelaporankerusakan.destroy');
    Route::get('/operator/datapelaporankerusakan/cari', [operatorpelaporankerusakancontroller::class, 'cari'])->name('operator.pelaporankerusakan.cari');
    Route::get('/operator/datapelaporankerusakan/create', [operatorpelaporankerusakancontroller::class, 'create'])->name('operator.pelaporankerusakan.create');
    Route::post('/operator/datapelaporankerusakan', [operatorpelaporankerusakancontroller::class, 'store'])->name('operator.pelaporankerusakan.store');
    Route::get('/operator/pelaporankerusakan/{id}/detail', [operatorpelaporankerusakancontroller::class, 'detail'])->name('operator.pelaporankerusakan.detail');
    Route::get('/operator/pelaporankerusakan/{id}/detail/create', [operatorpelaporankerusakancontroller::class, 'detailcreate'])->name('operator.pelaporankerusakan.detail.create');
    Route::post('/operator/pelaporankerusakan/{id}/detail/store', [operatorpelaporankerusakancontroller::class, 'detailstore'])->name('operator.pelaporankerusakan.detail.store');
    Route::delete('/operator/pelaporankerusakan/{id}/detail/destroy/{pelaporankerusakandetail}', [operatorpelaporankerusakancontroller::class, 'detaildestroy'])->name('operator.pelaporankerusakan.detail.destroy');


    Route::get('/operator/maintenance', [operatormaintenancecontroller::class, 'index'])->name('operator.maintenance');
    Route::get('/operator/maintenance/{id}', [operatormaintenancecontroller::class, 'edit'])->name('operator.maintenance.edit');
    Route::put('/operator/maintenance/{id}', [operatormaintenancecontroller::class, 'update'])->name('operator.maintenance.update');
    Route::delete('/operator/maintenance/{id}', [operatormaintenancecontroller::class, 'destroy'])->name('operator.maintenance.destroy');
    Route::get('/operator/datamaintenance/cari', [operatormaintenancecontroller::class, 'cari'])->name('operator.maintenance.cari');
    Route::get('/operator/datamaintenance/create', [operatormaintenancecontroller::class, 'create'])->name('operator.maintenance.create');
    Route::post('/operator/datamaintenance', [operatormaintenancecontroller::class, 'store'])->name('operator.maintenance.store');
    Route::get('/operator/maintenance/{id}/detail', [operatormaintenancecontroller::class, 'detail'])->name('operator.maintenance.detail');
    Route::get('/operator/maintenance/{id}/detail/create', [operatormaintenancecontroller::class, 'detailcreate'])->name('operator.maintenance.detail.create');
    Route::post('/operator/maintenance/{id}/detail/store', [operatormaintenancecontroller::class, 'detailstore'])->name('operator.maintenance.detail.store');
    Route::delete('/operator/maintenance/{id}/detail/destroy/{maintenancedetail}', [operatormaintenancecontroller::class, 'operator.detaildestroy'])->name('maintenance.detail.destroy');

});


