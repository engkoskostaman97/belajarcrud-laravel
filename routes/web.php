<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

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

Route::get(
    '/', function () {
        return view('welcome');
    }
);

Route::get('/getData', [BarangController::class, 'getData']);
Route::post('/pushData', [BarangController::class, 'store']);
Route::post('/setData', [BarangController::class, 'update']);
Route::get('/delete/{id}', [BarangController::class, 'hapus']);