<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

// route admin
Route::group([
    'middleware' => ['auth'],
    'prefix' => 'admin',
    'as' => 'admin.'
], function() {

    // route admin dashboard
    Route::get('/', [MemberController::class, 'index'])->name('admin.index');

    // route admin add member
    Route::get('/tambah-member', [MemberController::class, 'add'])->name('admin.add-member');

    Route::post('/create', [MemberController::class, 'create'])->name('admin.create');

    // route admin detail member
    Route::get('/member/{id}', [MemberController::class, 'showDetail'])->name('admin.showDetail');

    // route admin edit member
    Route::get('/member/{id}/edit', [MemberController::class, 'update'])->name('admin.edit-member');

    Route::put('/member/{id}', [MemberController::class, 'edit'])->name('admin.update-member');

    // route admin delete member
    Route::delete('/member/{id}', [MemberController::class, 'delete'])->name('admin.delete-member');

    // route admin paket member
    Route::get('/paket-member', [PaketController::class, 'index'])->name('admin.paketMember');

    // route admin tambah paket member
    Route::get('/tambah-paket-member', [PaketController::class, 'add'])->name('admin.add-paketMember');

    Route::post('/create-paket-member', [PaketController::class, 'create'])->name('admin.create-paketMember');

    // route admin edit paket member
    Route::get('/paket-member/{id}/edit', [PaketController::class, 'update'])->name('admin.edit-paketMember');

    Route::put('/paket-member/{id}', [PaketController::class, 'edit'])->name('admin.update-paketMember')->name('admin.update-paketMember');

    // route admin delete paket member
    Route::delete('/paket-member/{id}', [PaketController::class, 'delete'])->name('admin.delete-paketMember');

    // route transaksi
    Route::get('/transaksi', [TransactionController::class, 'index'])->name('admin.transaksi');

    // route absen harian
    Route::get('/absen-harian', [AbsenController::class, 'index'])->name('admin.absen');

    // route pengaturan akun
    Route::get('/setting', function() {
        return view('admin.profile');
    });
});


// route auth
// route register admin
Route::group([
    'prefix' => 'register',
    'as' => 'register.'
],function () {
    Route::get('/', [AdminController::class, 'register'])->name('admin.register');
    Route::post('/submit', [AdminController::class, 'registerSubmit'])->name('admin.register.submit'); 
});

// route login admin
Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/login/create', [AdminController::class, 'loginSubmit'])->name('admin.login.submit'); 

// route logout
Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

// route admin forgot password
Route::get('/new-password', function() {
    return view('admin.new-password');
});

// route admin new password
Route::get('/forgot-password', function() {
    return view('admin.forgot-password');
});