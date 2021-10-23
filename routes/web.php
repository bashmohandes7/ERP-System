<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('emails', [EmailController::class, 'create'])->name('emails.create');
Route::post('emails', [EmailController::class, 'store'])->name('emails.store');
Route::get('allemails', [EmailController::class, 'index']);
Route::get('edit/{id}', [EmailController::class, 'edit'])->name('email.edit');
Route::post('edit/{id}', [EmailController::class, 'update'])->name('email.update');

Route::get('MarkAsRead_all',[EmailController::class, 'MarkAsRead_all'])->name('MarkAsRead_all');
Route::get('unreadNotifications_count', [EmailController::class ,'unreadNotifications_count'])->name('unreadNotifications_count');

Route::get('unreadNotifications', [EmailController::class,'unreadNotifications'])->name('unreadNotifications');


Route::get('/{page}', [AdminController::class, 'index']);
