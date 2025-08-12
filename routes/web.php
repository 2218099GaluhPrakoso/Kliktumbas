<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminProfileController;


// ====================
// Halaman Utama
// ====================
Route::get('/', [HomeController::class, 'index'])->name('Home');

// ====================
// Auth Member
// ====================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ====================
// Profil Member
// ====================
Route::middleware('auth:member')->group(function () {
    Route::get('/profile', [MemberController::class, 'profile'])->name('member.profile');
    Route::get('/profile/edit', [MemberController::class, 'edit'])->name('member.profile.edit');
    Route::post('/profile/update', [MemberController::class, 'update'])->name('member.profile.update');
    Route::post('/member/logout', [MemberController::class, 'logout'])->name('member.logout');

    // halaman beranda member
    Route::get('/beranda', function () {
        return 'Halaman Beranda User';
    })->name('beranda');

    // rating produk & umkm
    Route::post('/produk/{id}/rate', [ProductController::class, 'rate'])->name('produk.rate');
    Route::post('/umkm/{id}/rate', [UmkmController::class, 'rate'])->name('umkm.rate');
});

// ====================
// Auth Admin
// ====================
Route::get('/login/admin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login/admin', [AdminAuthController::class, 'login']);
Route::post('/logout/admin', [AdminAuthController::class, 'logout'])->name('admin.logout');

// ====================
// Dashboard Admin (hanya untuk admin middleware)
// ====================
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/umkm', [DashboardController::class, 'storeUmkm'])->name('admin.umkm.store');
    Route::post('/product', [DashboardController::class, 'storeProduct'])->name('admin.product.store');
    Route::put('/umkm/{id}', [UmkmController::class, 'update'])->name('admin.umkm.update');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    Route::delete('/umkm/{id}', [UmkmController::class, 'destroy'])->name('admin.umkm.destroy');

    Route::get('/profile', [AdminProfileController::class, 'index'])->name('admin.profile');
     Route::get('/beranda', function () {
        return 'Halaman Beranda User';
    })->name('beranda');
    
});



// ====================
// UMKM & Produk (Publik)
// ====================
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/umkm/{id}', [UmkmController::class, 'show'])->name('umkm.show');

Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/umkm/all', [UmkmController::class, 'all'])->name('umkm.all');
Route::get('/produk/all', [ProductController::class, 'all'])->name('produk.all');

Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');


// ====================
// Rating (opsional jika tidak pakai dalam group member di atas)
// ====================
Route::post('/rating/store', [RatingController::class, 'store'])->name('rating.store');
Route::resource('products', ProductController::class);
Route::get('/kategori/makanan', [CategoryController::class, 'makanan'])->name('kategori.makanan');
Route::get('/kategori/minuman', [CategoryController::class, 'minuman'])->name('kategori.minuman');
Route::get('/kategori/snack', [CategoryController::class, 'snack'])->name('kategori.snack');
Route::get('/kategori', function () {
    return redirect()->route('kategori.makanan');
})->name('kategori');
Route::get('/umkm/{id}/profile', [UmkmController::class, 'profile'])->name('umkm.profile');
Route::get('/umkm/{id}/products', [UmkmController::class, 'products'])->name('umkm.products');
Route::get('/umkm/{id}', [UmkmController::class, 'profile'])->name('umkm.profile');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');



