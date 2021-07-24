<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatistikaController;


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
});

Route::group(['middleware' => ['jwt.verify:admin']], function () { //untuk hak akses admin dan petugas
    Route::get('statistika', [StatistikaController::class, 'getAll']); //get all
	Route::get('statistika/{id_statistika}', [StatistikaController::class, 'getById']); //get all
	Route::get('statistika/{limit}/{offset}', [StatistikaController::class, 'getAll']); //get all dengan limit
    Route::post('statistika', [StatistikaController::class, 'insert']); //insert
    Route::post('statistika/ubah/{id_statistika}', [StatistikaController::class, 'update']); //update
    Route::delete('statistika/{id_statistika}', [StatistikaController::class, 'delete']); //delete
});

Route::group(['middleware' => ['jwt.verify:masyarakat']], function () { //untuk hak akses masyarakat
   


});