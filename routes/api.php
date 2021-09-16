<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//? Rota de Teste retornando um array.
Route::get('/message','APIController@showMessage')->middleware('iphone');

//? Rota de teste action.
Route::post('/action','APIController@showAction');

//? Rotas para o controller Pessoas.

Route::get('listagem-pessoas', 'APIPessoasController@listagemDePessoas')->middleware('authenticate-api');

Route::post('cadastro-pessoa','APIPessoasController@cadastraPessoa');