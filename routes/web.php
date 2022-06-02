<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    FornecedorController,
    FaixaSalarialController,
    LotacaoController,
    CompraBeneficioController,
    EmpresaController,
    FeriadoController,
    FaixaEtariaController,
    EmpresaBeneficioController,
    JornadaController
};
use Inertia\Inertia;

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
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/home', function () {
    return Inertia::render('Home');
})->middleware(['auth', 'verified'])->name('home');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function ($route) {
    Route::resource('lotacao', LotacaoController::class);
    Route::resource('faixa-salarial', FaixaSalarialController::class);
    Route::resource('compras-beneficios', CompraBeneficioController::class);
    Route::resource('fornecedor', FornecedorController::class);
    Route::resource('empresa', EmpresaController::class);
    Route::resource('feriado', FeriadoController::class);
    Route::resource('faixa-etaria', FaixaEtariaController::class);
    Route::resource('empresa-beneficio', EmpresaBeneficioController::class);
    Route::resource('jornada', JornadaController::class);
});

require __DIR__ . '/auth.php';
