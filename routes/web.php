<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PostController;

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

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store']);

Route::get('/posts/like/{post}', [PostController::class, 'like']);

Route::post('/photo', [PostController::class, 'photostore']);
Route::get('/photo/create', [PostController::class, 'photo']);


Route::post('/images', [PostController::class, 'imagestore']);
Route::get('/images/create', [PostController::class, 'image']);

Route::post('/document', [PostController::class, 'documentstore']);
Route::get('/document/create', [PostController::class, 'document']);

Route::get('/clients/create', [ClientController::class, 'create']);
Route::post('/clients/store', [ClientController::class, 'store']);
Route::get('/clients/show/{client}', [ClientController::class, 'show']);
Route::get('/clients/name/{name}', [ClientController::class, 'show2']);
Route::get('/clients/search/{text}', [ClientController::class, 'search']);
Route::get('/clients/bills/{client}', [ClientController::class, 'bills']);
Route::get('/bills/expensive/{value}', [ClientController::class, 'value']);
Route::get('/bills/between/{value1}/{value2}', [ClientController::class, 'between']);
Route::get('/clients/order', [ClientController::class, 'order']);


Route::get('/soma/{num1}/{num2}', [ClientController::class, 'soma']);
Route::get('/sub/{num1}/{num2}', [ClientController::class, 'sub']);
Route::get('/div/{num1}/{num2}', [ClientController::class, 'div']);
Route::get('/mult/{num1}/{num2}', [ClientController::class, 'mult']);

Route::get('/prime/{limite}', [PostController::class, 'prime']);
Route::get('/job/{num1}/{num2}', [PostController::class, 'job']);
Route::get('/celsius/{farenheit}', [PostController::class, 'convert']);
Route::get('/div/{num1}/{num2}', [PostController::class, 'div']);






