<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\TypeKamarController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LegalController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [LoginController::class, 'sendTemporaryPassword'])->name('password.send');

// Public pages
Route::get('/syarat-ketentuan', [LegalController::class, 'terms'])->name('terms');
Route::get('/kebijakan-privasi', [LegalController::class, 'privacy'])->name('privacy');
// Room routes - accessible to authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/kamar', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/type-kamar', [RoomController::class, 'roomTypes'])->name('rooms.types');
    Route::get('/kamar/{type}', [RoomController::class, 'show'])->name('room.detail');
    Route::get('/kamar/detail/{kamar}', [RoomController::class, 'detail'])->name('room.detailed');
});

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout')->middleware('auth');

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        
        Route::resource('users', UserController::class);
        Route::post('users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::get('users/export/pdf', [UserController::class, 'exportPdf'])->name('users.export.pdf');
        Route::resource('kamar', KamarController::class);
        Route::get('kamar/export/pdf', [KamarController::class, 'exportPdf'])->name('kamar.export.pdf');
        Route::resource('type-kamar', TypeKamarController::class);
        Route::get('type-kamar/export/pdf', [TypeKamarController::class, 'exportPdf'])->name('type-kamar.export.pdf');
        Route::post('type-kamar/{id}/add-image', [TypeKamarController::class, 'addImage'])->name('type-kamar.add-image');
        Route::delete('type-kamar/{id}/delete-image/{index}', [TypeKamarController::class, 'deleteImage'])->name('type-kamar.delete-image');
        Route::resource('galeri', GaleriController::class);
        Route::resource('booking', AdminBookingController::class);
        Route::post('booking/{id}/confirm', [AdminBookingController::class, 'confirm'])->name('admin.booking.confirm');
        Route::post('booking/{id}/cancel', [AdminBookingController::class, 'cancel'])->name('admin.booking.cancel');
        Route::resource('laporan', LaporanController::class);
    });
    
    Route::get('/pengguna/dashboard', function () {
        return view('pengguna.dashboard');
    })->name('pengguna.dashboard')->middleware(['role:pengguna', 'profile.completed']);
    
    // Profile routes for users
    Route::middleware('role:pengguna')->group(function () {
        Route::get('/profile/complete', [ProfileController::class, 'showCompleteForm'])->name('profile.complete.form');
        Route::post('/profile/complete', [ProfileController::class, 'completeProfile'])->name('profile.complete');
        Route::get('/profile', [ProfileController::class, 'show'])->name('pengguna.profile')->middleware('profile.completed');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('pengguna.profile.edit')->middleware('profile.completed');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('pengguna.profile.update')->middleware('profile.completed');
        
        // Booking routes for users
        Route::middleware('profile.completed')->group(function () {
            Route::post('/booking/create', [BookingController::class, 'create'])->name('booking.create');
            Route::get('/booking/success/{bookingCode}', [BookingController::class, 'success'])->name('booking.success');
            Route::get('/booking/history', [BookingController::class, 'history'])->name('booking.history');
            Route::get('/booking/detail/{bookingCode}', [BookingController::class, 'detail'])->name('booking.detail');
            Route::post('/booking/cancel/{bookingCode}', [BookingController::class, 'cancel'])->name('booking.cancel');
            Route::post('/booking/confirm/{bookingCode}', [BookingController::class, 'confirm'])->name('booking.confirm');
        });
    });
});
