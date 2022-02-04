<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BeneficiosController, ClienteController, 
    FaixaSalarialController, LotacaoController, ComprasRefeicaoController, 
    DescontoRefeicaoController, DescontoAlimentacaoController, DescontoTransporteController};
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
    Route::resource('beneficios', BeneficiosController::class);
    Route::resource('cliente', ClienteController::class);
    Route::resource('lotacao', LotacaoController::class);
    Route::resource('faixa-salarial', FaixaSalarialController::class);
    Route::resource('compras-refeicao', ComprasRefeicaoController::class);
    Route::resource('desconto-alimentacao', DescontoAlimentacaoController::class);
    Route::resource('desconto-refeicao', DescontoRefeicaoController::class);
    Route::resource('desconto-transporte', DescontoTransporteController::class);
});

require __DIR__ . '/auth.php';
