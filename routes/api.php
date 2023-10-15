<?php

use App\Http\Controllers\DniController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('dni', [DniController::class, 'store']); // Para almacenar un DNI
Route::get('dni/getall', [DniController::class, 'index']); // Para obtener todos los DNIs almacenados
Route::put('dni/{id}', [DniController::class, 'update']); //Para actualizar DNI por Id
Route::delete('dni/{id}', [DniController::class, 'destroy']); //Para eliminar DNI por ID


