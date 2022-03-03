<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataPenjualanController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DataPenjualanController::class, 'index'])->name('home');
Route::post('/import', [DataPenjualanController::class, 'import'])->name('import.excel');
Route::get('/show/{id}/data', [DataPenjualanController::class, 'find'])->name('data.edit');
// Route::get('/search', [DataPenjualanController::class, 'search'])->name('search.year');
