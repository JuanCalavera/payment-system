<?php

use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Cobranca\CobrancaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\postDec;

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
Route::prefix('customers')->group(function () {
    // Criar Cliente
    Route::post('/', [ClienteController::class, 'store']);    
    // Recuperar um único cliente
    Route::get('/{id}', [ClienteController::class, 'show']);
    // Listar clientes
    Route::get('/', [ClienteController::class, 'index']);
    // Atualizar cliente existente
    Route::patch('/{id}', [ClienteController::class, 'update']);
    // Remover cliente
    Route::delete('/{id}', [ClienteController::class, 'destroy']);
    // Restaurar cliente removido
    Route::post('/{id}/restore', [ClienteController::class, 'restore']);
});

Route::prefix('payments')->group(function () {
    // Criar nova cobrança    
    Route::post('/boleto', [CobrancaController::class, 'store']);
    // Criar cobrança com cartão de crédito
    Route::post('cartao', [CobrancaController::class, 'storeCartao']);
    // Criar uma cobrança parcelada
    Route::post('parcelado', [CobrancaController::class, 'storeParcelada']);
    // Recuperar uma única cobrança
    Route::get('/{id}', [CobrancaController::class, 'show']);
    // Listar cobranças
    Route::get('?customer=&billingType=&status=&subscription=&installment=&externalReference=&paymentDate=&anticipated=&paymentDate%5Bge%5D=&paymentDate%5Ble%5D=&dueDate%5Bge%5D=&dueDate%5Ble%5D=&offset=&limit=', function () {return 'Listar cobranças';});
    // Atualizar cobrança existente
    Route::patch('/{id}', [CobrancaController::class, 'update']);
    // Remover cobrança
    Route::delete('/{id}', [CobrancaController::class, 'destroy']);
    // Restaurar cobrança removida
    Route::post('/{id}/restore', [CobrancaController::class, 'restore']);
    // Estornar cobrança
    Route::post('/{id}/refund', [CobrancaController::class, 'estornar']);
    // Confirmar recebimento em dinheiro
    Route::post('/{id}/receiveInCash', [CobrancaController::class, 'receiveInCash']);    
    // Desfazer confirmação de recebimento em dinheiro
    Route::post('/{id}/receiveInCash', [CobrancaController::class, 'dereceiveCash']);
});

// Criar cobrança com Split
// post
// payments
// Route::post('/payments', function () {return 'Criar cobrança com Split';});