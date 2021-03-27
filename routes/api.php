<?php

use App\Http\Controllers\Cliente\ClienteController;
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

// Criar Cliente
// customers - post
Route::post('/customers', [ClienteController::class, 'store']);

// Recuperar um único cliente
// get
// customers/{id}
Route::get('/customers/{id}', [ClienteController::class, 'show']);

// Listar clientes
// get
// customers?name=&email=&cpfCnpj=&groupName=&externalReference=&offset=&limit=
Route::get('/customers', [ClienteController::class, 'index']);

// Atualizar cliente existente
// post
// customers/{id}
Route::patch('/customers/{id}', [ClienteController::class, 'update']);

// Remover cliente
// delete
// customers/{id}
Route::delete('/customers/{id}', [ClienteController::class, 'destroy']);

// Restaurar cliente removido
// post
// customers/{id}/restore
Route::post('/customers/{id}/restore', [ClienteController::class, 'restore']);

// Criar nova cobrança
// post
// payments
Route::post('/payments-boleto', function () {return 'Criar nova cobrança';});

// Criar cobrança com cartão de crédito
// post
// payments
Route::post('/payments-cartao', function () {return 'Criar cobrança com cartão de crédito';});

// Criar uma cobrança parcelada
// post
// payments
Route::post('/payments-parcelado', function () {return 'Criar uma cobrança parcelada';});

// Criar cobrança com Split
// post
// payments
// Route::post('/payments', function () {return 'Criar cobrança com Split';});

// Recuperar uma única cobrança
// get
// payments/{id}
Route::get('/payments/{id}', function () {return 'Recuperar uma única cobrança';});

// Listar cobranças
// get
// payments?customer=&billingType=&status=&subscription=&installment=&externalReference=&paymentDate=&anticipated=&paymentDate%5Bge%5D=&paymentDate%5Ble%5D=&dueDate%5Bge%5D=&dueDate%5Ble%5D=&offset=&limit=
Route::get('/payments?customer=&billingType=&status=&subscription=&installment=&externalReference=&paymentDate=&anticipated=&paymentDate%5Bge%5D=&paymentDate%5Ble%5D=&dueDate%5Bge%5D=&dueDate%5Ble%5D=&offset=&limit=', function () {return 'Listar cobranças';});

// Atualizar cobrança existente
// post
// payments/{id}
Route::patch('/payments/{id}', function () {return 'Atualizar cobrança existente';});

// Remover cobrança
// delete
// payments/{id}
Route::delete('/payments/{id}', function () {return 'Remover cobrança';});

// Restaurar cobrança removida
// post
// payments/{id}/restore
Route::post('/payments/{id}/restore', function () {return 'Restaurar cobrança removida';});

// Estornar cobrança
// post
// payments/{id}/refund
Route::post('/payments/{id}/refund', function () {return 'Estornar cobrança';});

// Confirmar recebimento em dinheiro
// post
// payments/{id}/receiveInCash
Route::post('/payments/{id}/receiveInCash', function () {return 'Confirmar recebimento em dinheiro';});

// Desfazer confirmação de recebimento em dinheiro
// post
// payments/{id}/receiveInCash
Route::post('/payments/{id}/receiveInCash', function () {return 'Desfazer confirmação de recebimento em dinheiro';});