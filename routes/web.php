<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AyatHarianController;
use App\Http\Controllers\AyatHarianSuperAdminController;
use App\Http\Controllers\ResetPasswordByAdminController;
use App\Http\Controllers\SejarahSuperAdminController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\WartaJemaatSuperAdminController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventSuperAdminController;
use App\Http\Controllers\KeuanganSuperAdminController;
use App\Http\Controllers\OrganisasiGerejaController;
use App\Http\Controllers\OrganisasiGerejaSuperAdminController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\MengelolaAkunGerejaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WartaJemaatController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\SukaDukaCitaController;
use App\Http\Controllers\SukaDukaCitaSuperAdminController;
use App\Http\Controllers\VisiMisiSuperAdminController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/informasigereja', [WelcomeController::class, 'informasiGereja'])->name('informasiGereja');
// Route::get('/informasigereja/{id}', [WelcomeController::class, 'showGereja'])->name('informasiGereja.show');
// Route::get('/tentangsigra', [WelcomeController::class, 'tantangsigra']);
// Route::get('/faqsigra', [WelcomeController::class, 'faqsigra']);
Route::get('/wartaJemaat/{id}/download-pdf', [WelcomeController::class, 'downloadPdf'])->name('download.pdf');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('profile', function () {
        return view('profile');
    })->name('profile');
    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/', function () {
        return view('dashboard');
    })->name('sign-up');
    Route::post('/change-password', [RegisterController::class, 'changePassword'])->name('change-password');

    Route::middleware(['middleware' => 'auth', 'checkRole:ADMINGEREJA'])->group(function () {
        // Mengelola Ayat Harian - Admin Gereja Role
        Route::get('/ayatharian', [AyatHarianController::class, 'getViewAyatHarian'])->name('ayatharian');
        Route::get('/ayatharian/create', [AyatHarianController::class, 'createAyatHarian']);
        Route::post('/ayatharian/create', [AyatHarianController::class, 'saveCreateAyatHarian']);
        Route::put('/ayatharian/update/{id}', [AyatHarianController::class, 'saveUpdateAyatHarian'])->name('saveUpdate-ayatharian');
        Route::get('/ayatharian/detele/{id}', [AyatHarianController::class, 'deleteAyatHarian']);

        // Mengelola Warta Jemaat - Admin Gereja Role
        Route::get('/wartajemaat', [WartaJemaatController::class, 'getViewWartaJemaat'])->name('wartajemaat');
        Route::get('/wartajemaat/create', [WartaJemaatController::class, 'createWartaJemaat']);
        Route::post('/wartajemaat/create', [WartaJemaatController::class, 'saveCreateWartaJemaat']);
        Route::get('/wartajemaat/update/{id}', [WartaJemaatController::class, 'updateWartaJemaat'])->name('update-wartajemaat');
        Route::put('/wartajemaat/update/{id}', [WartaJemaatController::class, 'saveUpdateWartaJemaat'])->name('saveUpdate-wartajemaat');
        Route::get('/wartajemaat/destroy/{id}', [WartaJemaatController::class, 'destroy']);
        Route::get('/wartajemaat/download-pdf/{id}', [WartaJemaatController::class, 'downloadPdf'])->name('wartajemaat.download-pdf');
        Route::delete('/detailwarta/delete/{id}', [WartaJemaatController::class, 'deleteDetail'])->name('detailwarta.delete');

        // Mengelola Event - Admin Gereja Role
        Route::get('/event', [EventController::class, 'getViewEvent'])->name('event');
        Route::get('/event/create', [EventController::class, 'createEvent']);
        Route::post('/event/create', [EventController::class, 'saveCreateEvent']);
        Route::put('/event/update/{id}', [EventController::class, 'saveUpdateEvent'])->name('saveUpdate-event');
        Route::get('/event/detele/{id}', [EventController::class, 'deleteEvent']);

        // Mengelola Organisasi Gereja - Admin Gereja Role
        Route::get('/organisasigerejaadd', [OrganisasiGerejaController::class, 'getViewOrganisasiGereja'])->name('organisasigereja');
        Route::get('/organisasigereja', [OrganisasiGerejaController::class, 'getViewListBPH'])->name('listbph');
        Route::post('/organisasigereja/create', [OrganisasiGerejaController::class, 'saveCreateOrganisasiGereja']);
        Route::get('/organisasigereja/edit/{id}', [OrganisasiGerejaController::class, 'getEditOrganisasiGereja'])->name('organisasigereja.edit');
        Route::put('/organisasigereja/update/{id}', [OrganisasiGerejaController::class, 'saveUpdateOrganisasiGereja'])->name('organisasigereja.update');
        Route::delete('/organisasigereja/delete/{id}', [OrganisasiGerejaController::class, 'deleteOrganisasiGereja'])->name('organisasigereja.delete');


        // Manage keuangan gereja
        Route::get('/keuangan', [keuanganController::class, 'index'])->name('keuangan.index');
        Route::get('/keuangan/create', [keuanganController::class, 'create']);
        Route::post('/keuangan/create', [keuanganController::class, 'store']);
        Route::get('/keuangan/edit/{id}', [keuanganController::class, 'updateKeuangan'])->name('update-keuangan');
        Route::put('/keuangan/update/{id}', [keuanganController::class, 'saveUpdateKeuangan'])->name('saveUpdate-keuangan');
        Route::get('/keuangan/destroy/{id}', [keuanganController::class, 'destroy']);
        Route::get('/keuangan/download-pdf/{id}', [keuanganController::class, 'downloadPdf'])->name('keuangan.download-pdf');

        // Manage pengeluaran gereja
        Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran');
        Route::get('/pengeluaran/create', [PengeluaranController::class, 'create']);
        Route::post('/pengeluaran/create', [PengeluaranController::class, 'store']);
        Route::get('/pengeluaran/edit/{id}', [PengeluaranController::class, 'updatePengeluaran'])->name('update-pengeluaran');
        Route::put('/pengeluaran/update/{id}', [PengeluaranController::class, 'saveUpdatePengeluaran'])->name('saveUpdate-pengeluaran');
        Route::get('/pengeluaran/destroy/{id}', [PengeluaranController::class, 'destroy']);
        Route::get('/pengeluaran/download-pdf/{id}', [PengeluaranController::class, 'downloadPdf'])->name('pengeluaran.download-pdf');
        Route::get('/laporankeuangan', [LaporanKeuanganController::class, 'index'])->name('laporankeuangan.index');
        Route::get('/laporan-keuangan/download', [LaporanKeuanganController::class, 'downloadLaporanPdf'])->name('laporankeuangan.download');
        // Route::get('/laporankeuangan/download', [LaporanKeuanganController::class, 'downloadPDF'])->name('laporan.keuangan.download');

        // Mengelola Suka Duka Cita - Admin Gereja Role
        Route::get('/sukadukacita', [SukaDukaCitaController::class, 'getViewSukaDukaCita'])->name('sukadukacita');
        Route::get('/sukadukacita/create', [SukaDukaCitaController::class, 'createSukaDukaCita']);
        Route::post('/sukadukacita/create', [SukaDukaCitaController::class, 'saveCreateSukaDukaCita']);
        Route::put('/sukadukacita/update/{id}', [SukaDukaCitaController::class, 'saveUpdateSukaDukaCita'])->name('saveUpdate-sukadukacita');
        Route::get('/sukadukacita/detele/{id}', [SukaDukaCitaController::class, 'deleteSukaDukaCita']);

        // Mengelola Sejarah - Admin Gereja Role
        Route::get('/sejarah', [SejarahController::class, 'getViewSejarah'])->name('sejarah');
        Route::post('/sejarah/create', [SejarahController::class, 'saveCreateSejarah']);
        Route::put('/sejarah/update/{id}', [SejarahController::class, 'saveUpdateSejarah'])->name('saveUpdate-sejarah');

        // Mengelola Visi Misi  - Admin Gereja Role
        Route::get('/visi-misi', [VisiMisiController::class, 'getViewMisi'])->name('misi');
        Route::get('/visi-misi/createmisi', [VisiMisiController::class, 'createMisi']);
        Route::get('/visi-misi/createvisi', [VisiMisiController::class, 'createVisi']);
        Route::post('/visi-misi/createmisi', [VisiMisiController::class, 'saveCreateMisi']);
        Route::post('/visi-misi/createvisi', [VisiMisiController::class, 'saveCreateVisi']);
        Route::put('/visi-misi/updatemisi/{id}', [VisiMisiController::class, 'saveUpdateMisi'])->name('saveUpdate-misi');
        Route::put('/visi-misi/updatevisi/{id}', [VisiMisiController::class, 'saveUpdateVisi'])->name('saveUpdate-visi');
        Route::get('/visi-misi/detelemisi/{id}', [VisiMisiController::class, 'deleteMisi']);
        Route::get('/visi-misi/detelevisi/{id}', [VisiMisiController::class, 'deleteVisi']);


        // Mengelola Anggota Gereja
        // Route::get('/list_anggota', [OrganisasiGerejaController::class, 'getViewOrganisasiGereja'])->name('organisasigereja');
        Route::get('/list_anggota', [AnggotaController::class, 'anggota']);
        Route::get('/add_anggota', [AnggotaController::class, 'viewaddanggota']);
        Route::post('/create_anggota', [AnggotaController::class, 'store'])->name('anggota.store');
        // routes/web.php
        Route::put('/anggota/update/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
        // Tambahkan route untuk delete anggota
        Route::delete('/anggota/delete/{id}', [AnggotaController::class, 'delete'])->name('anggota.delete');
        Route::post('/anggota/import', [AnggotaController::class, 'import'])->name('anggota.import');



    });

    Route::middleware(['middleware' => 'auth', 'checkRole:SUPERADMIN'])->group(function () {
        // Mengelola Akun Gereja - Super Admin Role
        Route::get('/akungereja', [MengelolaAkunGerejaController::class, 'getViewAkunGereja']);
        Route::get('/akungereja/create', [MengelolaAkunGerejaController::class, 'createAkunGereja']);
        Route::post('/register', [RegisterController::class, 'store']);
        Route::get('/akungereja/detele/{id}', [MengelolaAkunGerejaController::class, 'deleteAkunGereja']);
        Route::put('/akungereja/status/{id}', [MengelolaAkunGerejaController::class, 'updateStatus']);

        // Mengelola Ayat Harian - Super Admin Role
        Route::get('/ayatharian/superadmin', [AyatHarianSuperAdminController::class, 'getViewAyatHarianSuperAdmin'])->name('ayathariansuperadmin');
        Route::get('/ayatharian/superadmin/detele/{id}', [AyatHarianSuperAdminController::class, 'deleteAyatHarianSuperAdmin']);

        Route::get('/wartajemaat/superadmin', [WartaJemaatSuperAdminController::class, 'getUserList'])->name('wartajemaatsuperadmin');
        Route::get('/wartajemaat/superadmin/detele/{id}', [WartaJemaatSuperAdminController::class, 'deleteWartaJemaatSuperAdmin']);
        Route::get('/wartajemaat/superadmin/detail/{userId}', [WartaJemaatSuperAdminController::class, 'getWartaJemaatByUser'])->name('wartajemaat.detail');

        // Mengelola Organisasi Gereja - Super Admin Role
        Route::get('/organisasigereja/superadmin', [OrganisasiGerejaSuperAdminController::class, 'getViewOrganisasiGerejaSuperAdmin'])->name('organisasigerejasuperadmin');
        Route::get('/organisasigereja/superadmin/detele/{id}', [OrganisasiGerejaSuperAdminController::class, 'deleteOrganisasiGerejaSuperAdmin']);

        //Mengelola Event Gereja - Super Admin Role
        Route::get('/event/superadmin', [EventSuperAdminController::class, 'getViewEventSuperAdmin'])->name('eventsuperadmin');
        Route::get('/event/superadmin/detele/{id}', [EventSuperAdminController::class, 'deleteEventSuperAdmin']);

        //Mengelola Keuangan Gereja - Super Admin Role
        Route::get('/keuangan/superadmin', [KeuanganSuperAdminController::class, 'getviewGereja'])->name('eventsuperadmin');
        Route::get('/keuangan/superadmin/{id}', [KeuanganSuperAdminController::class, 'index'])->name('keuangan.superadmin.main');

        //Mengelola Berita Suka Duka Cita - Super Admin Role
        Route::get('/sukadukacita/superadmin', [SukaDukaCitaSuperAdminController::class, 'getViewSukaDukaCitaSuperAdmin'])->name('sukadukacitasuperadmin');
        Route::get('/sukadukacita/superadmin/detele/{id}', [SukaDukaCitaSuperAdminController::class, 'deleteSukaDukaCitaSuperAdmin']);

        //Reset Password by Super Admin - Super Admin Role
        Route::post('/reset-password/{id}', [ResetPasswordByAdminController::class, 'resetPassword'])->name('reset.password');

        // Mengelola Sejarah Gereja - Super Admin Role
        Route::get('/sejarah/superadmin', [SejarahSuperAdminController::class, 'getViewSejarahSuperAdmin'])->name('sejarahsuperadmin');
        Route::get('/sejarah/superadmin/delete/{id}', [SejarahSuperAdminController::class, 'deleteSejarahSuperAdmin']);

        // Mengelola Visi Misi Gereja - Super Admin Role
        Route::get('/visi-misi/superadmin', [VisiMisiSuperAdminController::class, 'getViewVisiMisiSuperAdmin'])->name('visimisisuperadmin');
        Route::get('/visi-misi/superadmin/delete/{id}', [VisiMisiSuperAdminController::class, 'deleteVisiMisiSuperAdmin']);
    });
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login')->middleware('guest');
Route::get('/{domain}', action: [WelcomeController::class, 'showGerejaDetail'])->name('main');
Route::get('/{domain}/event', action: [WelcomeController::class, 'showGerejaDetailEvent'])->name('event.detail');
Route::get('/{domain}/ayat', action: [WelcomeController::class, 'showGerejaDetailAyat'])->name('event.ayat');
Route::get(uri: '/{domain}/warta', action: [WelcomeController::class, 'showGerejaDetailWarta'])->name('event.warta');
Route::get(uri: '/{domain}/sukaduka', action: [WelcomeController::class, 'showGerejaDetailSukaduka'])->name('event.sukaduka');
