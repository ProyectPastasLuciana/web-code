<?php

use App\Http\Controllers\categoriaController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\presentacioneController;
use App\Http\Controllers\marcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\proveedorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('panel.index');
});

Route::view('/panel','panel.index')->name('panel');
Route::get('/clientes/reporte', [clienteController::class, 'indexReporte'])->name('clientes.indexReporte');
Route::get('/reportes/clientes', [ClienteController::class, 'generarReportePDF'])->name('clientes.generarReportePDF');



Route::resources([
    'categorias' => categoriaController::class,
    'presentaciones' => presentacioneController::class,
    'marcas' => marcaController::class,
    'productos' => ProductoController::class,
    'clientes' => clienteController::class,
    'proveedores' => proveedorController::class,
]);

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/401', function () {
    return view('pages.401');
});

Route::get('/404', function () {
    return view('pages.404');
});

Route::get('/500', function () {
    return view('pages.500');
});