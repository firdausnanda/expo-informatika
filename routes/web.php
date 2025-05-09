<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LikeController;

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

Route::get('/', [LandingController::class, 'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  // Kategori
  Route::resource('kategori', KategoriController::class)->except(['show', 'create', 'edit']);

  // Mahasiswa
  Route::resource('mahasiswa', MahasiswaController::class)->except(['show', 'create', 'edit']);
  Route::post('mahasiswa/import', [MahasiswaController::class, 'import'])->name('mahasiswa.import');

  // Project
  Route::resource('project', ProjectController::class)->except(['show', 'update']);
  Route::post('project/update', [ProjectController::class, 'update'])->name('project.update');
  Route::post('project/gambar/store', [ProjectController::class, 'storeGambar'])->name('project.storeGambar');
  Route::post('project/gambar/destroy', [ProjectController::class, 'destroyGambar'])->name('project.destroyGambar');

  // User Management
  Route::resource('user', UserController::class)->except(['show', 'create', 'edit']);

  // Activity Log
  Route::get('activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');
});

Route::group(['middleware' => ['auth', 'role:user'], 'prefix' => 'user', 'as' => 'user.'], function () {

  // Like Project
  Route::post('like', [LikeController::class, 'like'])->name('like');
  Route::post('unlike', [LikeController::class, 'unlike'])->name('unlike');
});

// Google Controller
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
