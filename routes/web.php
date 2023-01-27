<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\IndexController;
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

Route::get('/', IndexController::class)->name('index');

// Auth
Route::group(['as' => 'auth.', 'prefix' => 'auth'] , function () {
    Route::get('register', [RegisterController::class, 'create'])
        ->name('create');
    Route::post('register', [RegisterController::class, 'store'])
        ->name('store');
    Route::get('login', [LoginController::class, 'login'])
        ->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])
        ->name('auth');
    Route::post('logout', [LoginController::class, 'logout'])
        ->name('logout');
    Route::get('forgot-password', [ForgotPasswordController::class, 'form'])
        ->name('forgot-form');
    Route::post('forgot-password', [ForgotPasswordController::class, 'mail'])
        ->name('forgot-mail');
    Route::get('reset-password/token/{token}/email/{email}', [ResetPasswordController::class, 'form'])
        ->name('reset-form');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])
        ->name('reset-password');
    Route::get('verify-message', [VerifyEmailController::class, 'message'])
        ->name('verify-message');
    Route::get('verify-email/token/{token}/id/{id}', [VerifyEmailController::class, 'verify'])
        ->where('token', '[\w%]+')
        ->where('id', '[0-9]+')
        ->name('verify-email');
});

/*
 * Blog: all posts, category posts, tag posts, post page
 */
Route::group(['as' => 'blog.', 'prefix' => 'blog',], function () {
    Route::get('index', [BlogController::class, 'index'])->name('index');
    Route::get('category/{category:slug}', [BlogController::class, 'category'])->name('category');
    Route::get('author/{user}', [BlogController::class, 'author'])->name('author');
    Route::get('tag/{tag:slug}', [BlogController::class, 'tag'])->name('tag');
    Route::get('post/{post:slug}', [BlogController::class, 'post'])->name('post');
});
