<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatistikaController;
use App\Http\Controllers\RSakitController;
use App\Http\Controllers\VaksinController;
use App\Http\Controllers\TanggapanController;



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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [UserController::class,'login']);
Route::post('register', [UserController::class,'register']);

Route::group(['middleware' => ['jwt.verify:admin,petugas,masyarakat']], function () {
    Route::get('login/check', [UserController::class,'loginCheck']);
    Route::post('logout', [UserController::class,'logout']);
    Route::get('statistika', [StatistikaController::class, 'getAll']); //get all
	Route::get('statistika/{id_statistika}', [StatistikaController::class, 'getById']); //get all
	Route::get('statistika/{limit}/{offset}', [StatistikaController::class, 'getAll']); //get all dengan limit

    Route::get('rsakit', [RSakitController::class, 'getAll']); //get all
	Route::get('rsakit/{id_rumahsakit}', [RSakitController::class, 'getById']); //get all
	Route::get('rsakit/{limit}/{offset}', [RSakitController::class, 'getAll']); //get all dengan limit
});

Route::group(['middleware' => ['jwt.verify:admin']], function () { //untuk hak akses admin dan petugas
    
    Route::post('statistika', [StatistikaController::class, 'insert']); //insert
    Route::post('statistika/ubah/{id_statistika}', [StatistikaController::class, 'update']); //update
    Route::delete('statistika/{id_statistika}', [StatistikaController::class, 'delete']); //delete

    Route::post('rsakit', [RSakitController::class, 'insert']); //insert
    Route::post('rsakit/ubah/{id_rumahsakit}', [RSakitController::class, 'update']); //update
    Route::delete('rsakit/{id_rumahsakit}', [RSakitController::class, 'delete']); //delete

    Route::get('vaksin', [VaksinController::class, 'getAllVaksin']); //get all
	Route::get('vaksin/{id_vaksin}', [VaksinController::class, 'getById']); //get all
	Route::get('vaksin/{limit}/{offset}', [VaksinController::class, 'getAllVaksin']); //get all by limit
	Route::post('vaksin/status/{id_vaksin}', [VaksinController::class, 'changeStatus']); //ubah status pengaduan

    Route::post('vaksin/tanggapan/{id_vaksin}', [TanggapanController::class, 'send']); //memasukan tanggapan
    Route::get('tanggapan', [TanggapanController::class, 'getAllTanggapan']); //get all

});

Route::group(['middleware' => ['jwt.verify:masyarakat']], function () { //untuk hak akses masyarakat
    Route::post('masyarakat/vaksin', [VaksinController::class, 'insert']); //insert
    Route::get('masyarakat/vaksin', [VaksinController::class, 'getAllVaksin']); //get all
	Route::get('masyarakat/vaksin/{limit}/{offset}', [VaksinController::class, 'getAllVaksin']); //get all


});