<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VacancyController;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ApplicantExport;

// ==========================================
// 1. RUTE PUBLIK (LANDING PAGE & AUTH)
// ==========================================
Route::get('/', [AuthController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ==========================================
// 2. RUTE TESTING (OTOMATIS LOGIN DEV)
// ==========================================
Route::get('/login-admin', function () {
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
    $admin = User::firstOrCreate(
        ['email' => 'admin_super@imersa.com'],
        ['name' => 'Admin Super Testing', 'password' => bcrypt('password123')]
    );
    $admin->syncRoles([$roleAdmin]);
    Auth::login($admin);
    return redirect()->route('admin.dashboard');
});

Route::get('/login-pelamar', function () {
    $user = User::firstOrCreate(
        ['email' => 'pelamar@test.com'],
        ['name' => 'Pelamar Test', 'password' => bcrypt('password')]
    );
    $user->assignRole('applicant');
    Auth::login($user);
    return redirect()->route('lowongan.create');
});

// ==========================================
// 3. RUTE TERPROTEKSI (MEMBUTUHKAN LOGIN)
// ==========================================
Route::middleware('auth')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ------------------------------------------
    // A. RUTE PELAMAR (APPLICANT)
    // ------------------------------------------
    // Rute pendaftaran tidak diprefix 'applicant' agar URL lebih bersih (/lowongan)
    // dan nama rutenya (lowongan.*) sesuai dengan yang dipanggil di Blade.
    Route::get('/lowongan', [ApplicationController::class, 'create'])->name('lowongan.create');
    Route::post('/lowongan', [ApplicationController::class, 'store'])->name('lowongan.store');

    // Rute dashboard dan status pelamar dikelompokkan secara spesifik
    Route::middleware(['role:applicant'])->prefix('applicant')->name('applicant.')->group(function () {
        Route::get('/dashboard', [ApplicationController::class, 'dashboard'])->name('dashboard');
        Route::get('/status', [ApplicationController::class, 'status'])->name('status');
    });

    // ------------------------------------------
    // B. RUTE ADMIN (HRD/SUPERVISOR)
    // ------------------------------------------
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        
        // 1. Menu Home (Dashboard Statistik)
        Route::get('/dashboard', [ApplicationController::class, 'adminDashboard'])->name('dashboard');
        
        // 2. Menu Kelola Seleksi (Kanban)
        Route::get('/selection', [ApplicationController::class, 'adminSelection'])->name('selection');
        Route::post('/application/{application}/status', [ApplicationController::class, 'updateStatus'])->name('application.updateStatus');
        
        // 3. Menu Riwayat & Arsip
        Route::get('/history', [ApplicationController::class, 'adminHistory'])->name('history');
        Route::delete('/application/{application}', [ApplicationController::class, 'destroy'])->name('application.destroy');
        
        // 4. Menu Pengaturan Divisi Magang
        Route::get('/vacancies', [VacancyController::class, 'index'])->name('vacancies.index');
        Route::post('/vacancies', [VacancyController::class, 'store'])->name('vacancies.store');
        Route::put('/vacancies/{vacancy}', [VacancyController::class, 'update'])->name('vacancies.update');
        Route::delete('/vacancies/{vacancy}', [VacancyController::class, 'destroy'])->name('vacancies.destroy');
        
        // 5. Fitur Ekspor Data
        Route::get('/export-applicants', function() {
            return Excel::download(new ApplicantExport, 'data-pelamar-imersa.xlsx');
        })->name('export');

        // Pengaturan Lokasi
        Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
        Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');
        Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');
        
    });
});