<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use Laravel\Fortify\Fortify;

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

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/store', [ContactController::class, 'store']);
Route::post('/thanks', [ContactController::class, 'thanks']);
// Route::post('/search', [ContactController::class, 'search']);
Route::match(['get', 'post'], '/search', [ContactController::class, 'search'])->name('search');
Route::delete('/delete/{id}', [ContactController::class, 'delete'])->name('delete');



Route::get('/admin', [ContactController::class, 'admin'])->name('admin')->middleware('auth');
Fortify::registerView(function () {
    return view('auth.register');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
