<?php

use App\Http\Controllers\CsrfCookieController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/csrf-cookie', CsrfCookieController::class)->name('csrf-cookie');

Route::post('/website', [WebsiteController::class, 'store'])->name('website.store');

Route::post('/post', [PostController::class, 'store'])->name('post.store');

Route::post('/website/{website}/subscription', [WebsiteController::class, 'subscribe'])->name('website.subscribe');
