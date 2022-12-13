<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\TransactionsController;
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

Route::get('/', function () {
    return view('upload');
});

Route::get('/upload', function () {
    return view('upload');
})->name('upload');

Route::post('uploadcsv', [TransactionsController::class,'upload_csv'])->name("upload_csv");

Route::get('users', [TransactionsController::class,'users'])->name("users");
Route::post('usertransactions', [TransactionsController::class,'userTransactions'])->name("usertransactions");