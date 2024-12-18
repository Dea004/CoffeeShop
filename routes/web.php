<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PasswordUpdateController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CoffeeShopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminCoffeeShopController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DaftarFavoritController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute early start
// Route::get('/', function () {
//     return view('layouts/main'); 
// });


// rute pages
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


// Halaman search
Route::get('/search', function () {
    return view('pages/search');
});

// Booking Management
Route::get('/booking', [BookingController::class, 'create'])->middleware('auth');
Route::post('/submit_booking', [BookingController::class, 'store'])->middleware('auth')->name('submit.booking');

// profile
Route::get('/booking_manage', [BookingController::class, 'index'])->name('booking.manajemen');

// shop manajemen
Route::middleware('auth')->group(function () {
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index'); // Menampilkan data toko
    Route::get('/shop/edit', [ShopController::class, 'edit'])->name('shop.edit'); // Form edit toko
    Route::post('/shop/update', [ShopController::class, 'update'])->name('shop.update'); // Proses update toko
});

// Rute untuk memperbarui status booking
Route::patch('/shop/{bookingId}/update-status', [ShopController::class, 'updateBookingStatus'])->name('shop.updateBookingStatus');

// Riwayat review
Route::get('/reviews', function () {
    return view('pages/RiwayatReview');
});
Route::post('/submit-review', [ReviewController::class, 'store'])->name('review.store');

// Daftar Favorit
Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite');

// Route untuk hasil search
Route::post('/search', [CoffeeShopController::class, 'search'])->name('search.submit');
Route::get('/coffee-shop/{id_shop}', [CoffeeShopController::class, 'show'])->name('coffeeShop.show');
Route::get('/search', [CoffeeShopController::class, 'searchWithFilter'])->name('search.filter');

//Halaman profil
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile.index');
Route::patch('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

// Halaman edit profil
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
// Update profil
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Rute untuk autentikasi
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk register
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Rute untuk meminta reset link
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::post('/reset-password', [PasswordResetLinkController::class, 'update'])->name('password.update');
Route::post('password/reset', [PasswordResetLinkController::class, 'update'])->name('password.update');
// Rute untuk menampilkan form reset password
Route::get('/reset-password/{token}', [PasswordResetLinkController::class, 'create'])->name('password.reset');

//Coffeeshop
Route::get('/coffee_shop', [CoffeeShopController::class, 'index'])->name('coffe_shops.index');
Route::get('/coffee-shop/{id_shop}', [CoffeeShopController::class, 'show'])->name('coffeeShop.detail');
Route::post('/coffee-shops', [CoffeeShopController::class, 'store'])->name('coffee-shops.store');

// Route untuk menambahkan ke daftar favorit
Route::post('/coffee-shop/{id}/favorite', [FavoriteController::class, 'store'])->name('coffee-shop.favorite');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
