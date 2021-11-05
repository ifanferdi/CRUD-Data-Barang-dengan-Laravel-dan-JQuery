<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

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
    return redirect(url('/barang'));
});


Route::get('/barang', [InventoryController::class, 'index']);
Route::get('/barang/create', [InventoryController::class, 'create']);
Route::post('/barang', [InventoryController::class, 'store']);
Route::delete('/barang/{inventory}', [InventoryController::class, 'destroy']);
Route::put('/barang/{inventory}/edit', [InventoryController::class, 'update']);

Route::get('/barang/tampilData', [InventoryController::class, 'tampilData']);
Route::post('/barang/getInventory', [InventoryController::class, 'getInventory']);
