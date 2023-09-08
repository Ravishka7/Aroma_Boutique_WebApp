<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::get('redirects','App\Http\Controllers\HomeController@index');



Route::get('/customer/wperfume', function () {
    return view('customer.wperfume');
})->name('wperfume');

Route::get('/customer/wp1', function () {
    return view('customer.wp1');
})->name('wp1');

Route::get('/customer/wp2', function () {
    return view('customer.wp2');
})->name('wp2');

Route::get('/customer/wp3', function () {
    return view('customer.wp3');
})->name('wp3');

Route::get('/customer/wp4', function () {
    return view('customer.wp4');
})->name('wp4');


