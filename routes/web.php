<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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

Route::get('/customer',[CustomerController::class, 'index'])->name('customer');

Route::get('/tambahcustomer',[CustomerController::class, 'tambahcustomer'])->name('tambahcustomer');
Route::post('/insertdata',[CustomerController::class, 'insertdata'])->name('insertdata');

Route::get('/tampilkandata/{id}',[CustomerController::class, 'tampilkandata'])->name('tampilkandata');
Route::post('/updatedata/{id}',[CustomerController::class, 'updatedata'])->name('updatedata');

Route::get('/delete/{id}',[CustomerController::class, 'delete'])->name('delete');

//export pdf & excel
Route::get('/exportpdf',[CustomerController::class, 'exportpdf'])->name('exportpdf');
Route::get('/exportexcel',[CustomerController::class, 'exportexcel'])->name('exportexcel');

Route::post('/importexcel',[CustomerController::class, 'importexcel'])->name('importexcel');
