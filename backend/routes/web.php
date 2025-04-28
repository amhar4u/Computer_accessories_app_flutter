<?php

use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Login;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AdminController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',Login::class)->name('login');

Route::middleware(['auth','role:admin'])->group(function () {
    // Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/logout', [Login::class, 'logout'])->name('logout');
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
});


