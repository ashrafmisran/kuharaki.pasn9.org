<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PerniagaanController;
use App\Http\Controllers\ProdukServisController;

// Home page - redirect to perniagaan
Route::get('/', function () {
    return redirect()->route('produk-servis.index');
});

// Perniagaan routes
Route::get('/perniagaan', [PerniagaanController::class, 'index'])->name('perniagaan.index');
Route::get('/perniagaan/{perniagaan}', [PerniagaanController::class, 'show'])->name('perniagaan.show');

// Produk & Servis routes
Route::get('/produk-servis', [ProdukServisController::class, 'index'])->name('produk-servis.index');
Route::get('/produk-servis/{produkServis}', [ProdukServisController::class, 'show'])->name('produk-servis.show');

// Fallback logout route for views referencing route('logout')
// Note: For best security, prefer POST with CSRF. This also accepts GET to avoid UX errors.
Route::match(['GET','POST'], '/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('produk-servis.index');
})->name('logout');
