<?php


use App\Livewire\Login;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\Products;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AdminDashboard;
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
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/admin/products', Products::class)->name('admin.products');
    Route::get('/admin/users', Users::class)->name('admin.users');

});


