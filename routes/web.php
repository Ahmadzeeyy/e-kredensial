<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KredensialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\KredensialController::class, 'index'])->name('form');

    Route::get('/dashboard', [App\Http\Controllers\KredensialController::class, 'dashboard'])->name('dashboard');
    Route::post('/dashboard/competency', [App\Http\Controllers\KredensialController::class, 'storeCompetency'])->name('dashboard.competency');
    Route::post('/generate', [App\Http\Controllers\KredensialController::class, 'generate'])->name('generate');
    Route::get('/kredensial/{id}/sertifikat', [App\Http\Controllers\AdminController::class, 'generateSertifikat'])->name('kredensial.sertifikat');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
});

Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes (Protected)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/kredensial', [App\Http\Controllers\AdminController::class, 'listKredensial'])->name('admin.kredensial.index');
    Route::get('/kredensial/approved', [App\Http\Controllers\AdminController::class, 'listApproved'])->name('admin.kredensial.approved');
    Route::post('/kredensial/cancel/{id}', [App\Http\Controllers\AdminController::class, 'cancelApproved'])->name('admin.kredensial.cancel');
    Route::get('/kredensial/export-rekap', [App\Http\Controllers\AdminController::class, 'exportRekapitulasi'])->name('admin.export-rekap');
    Route::get('/ases/{id}', [App\Http\Controllers\AdminController::class, 'showAses'])->name('admin.ases');
    Route::post('/ases/{id}', [App\Http\Controllers\AdminController::class, 'storeAses'])->name('admin.ases.store');
    Route::get('/form5/{id}', [App\Http\Controllers\AdminController::class, 'showForm5'])->name('admin.form5');
    Route::post('/form5/{id}', [App\Http\Controllers\AdminController::class, 'storeForm5'])->name('admin.form5.store');
    Route::get('/form6/{id}', [App\Http\Controllers\AdminController::class, 'showForm6'])->name('admin.form6');
    Route::post('/form6/{id}', [App\Http\Controllers\AdminController::class, 'storeForm6'])->name('admin.form6.store');
    Route::get('/kredensial/{id}/form7', [App\Http\Controllers\AdminController::class, 'showForm7'])->name('admin.form7');
    Route::post('/kredensial/{id}/form7', [App\Http\Controllers\AdminController::class, 'storeForm7'])->name('admin.form7.store');
    Route::get('/kredensial/{id}/form9', [App\Http\Controllers\AdminController::class, 'showForm9'])->name('admin.form9');
    Route::post('/kredensial/{id}/form9', [App\Http\Controllers\AdminController::class, 'storeForm9'])->name('admin.form9.store');
    Route::get('/kredensial/{id}/form3a', [App\Http\Controllers\AdminController::class, 'showForm3A'])->name('admin.form3a');
    Route::post('/kredensial/{id}/form3a', [App\Http\Controllers\AdminController::class, 'storeForm3A'])->name('admin.form3a.store');
    Route::get('/kredensial/{id}/form3b', [App\Http\Controllers\AdminController::class, 'showForm3B'])->name('admin.form3b');
    Route::post('/kredensial/{id}/form3b', [App\Http\Controllers\AdminController::class, 'storeForm3B'])->name('admin.form3b.store');
    Route::get('/kredensial/{id}/form3d', [App\Http\Controllers\AdminController::class, 'showForm3D'])->name('admin.form3d');
    Route::post('/kredensial/{id}/form3d', [App\Http\Controllers\AdminController::class, 'storeForm3D'])->name('admin.form3d.store');
    Route::get('/download/{id}', [App\Http\Controllers\AdminController::class, 'download'])->name('admin.download');
    Route::get('/view-file/{id}/{type}', [App\Http\Controllers\AdminController::class, 'viewFile'])->name('admin.view-file');
    Route::post('/update-status/{id}', [App\Http\Controllers\AdminController::class, 'updateStatus'])->name('admin.update-status');

    // User Management
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');

    // Template Sertifikat
    Route::get('/settings/certificate', [App\Http\Controllers\AdminController::class, 'certificateSettings'])->name('admin.settings.certificate');
    Route::post('/settings/certificate', [App\Http\Controllers\AdminController::class, 'updateCertificateSettings'])->name('admin.settings.certificate.update');
    Route::post('/settings/certificate/reset', [App\Http\Controllers\AdminController::class, 'resetCertificateTemplate'])->name('admin.settings.certificate.reset');
    
    // Action Tambahan
    Route::delete('/kredensial/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.kredensial.destroy');
    Route::post('/kredensial/{id}/revise', [App\Http\Controllers\AdminController::class, 'revise'])->name('admin.kredensial.revise');
});

// Asesor Routes
Route::middleware(['auth'])->prefix('asesor')->group(function () {
    Route::get('/', [App\Http\Controllers\AsesorController::class, 'index'])->name('asesor.dashboard');
});
