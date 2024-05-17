<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{FacturaController, HomeController, ParteController, ProoController};

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
#Proveedores
Route::get('/pro', [ProoController::class, 'index'])->name('pro.index');
Route::post('/pro', [ProoController::class, 'store'])->name('pro.store');
Route::put('/pro/{p}', [ProoController::class, 'update'])->name('pro.update');
Route::delete('/pro/{p}', [ProoController::class, 'destroy'])->name('pro.destroy');
#Facturas
Route::get('/fac', [FacturaController::class, 'index'])->name('fac.index');
Route::get('/fac/{f}', [FacturaController::class, 'show'])->name('fac.show');
Route::post('/fac', [FacturaController::class, 'store'])->name('fac.store');
#Parte
Route::post('/part', [ParteController::class, 'update'])->name('part.update');