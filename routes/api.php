<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;



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

Route::get('/kelas', [KelasController::class, 'index']);
Route::post('/kelas', [KelasController::class, 'create']);
Route::put('/kelas/{id}', [KelasController::class, 'update']);
Route::get('/detail-kelas', [KelasController::class, 'detailKelas']);

Route::post('/siswa', [SiswaController::class, 'create']);
Route::get('/siswa', [SiswaController::class, 'index']);
Route::get('/detail-siswa', [SiswaController::class, 'detailSiswa']);
Route::get('/detail-nilai-siswa', [SiswaController::class, 'detailNilaiSiswa']);






Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


