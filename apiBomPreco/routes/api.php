<?php
use App\Http\Controllers\ProdutosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//rotas para visualizar os registros criados nas tabelas
Route::get('/', function(){return response()->json(['Sucesso'=>true]);});
Route::get('/produto', [ProdutosController::class,'index']);
Route::get('/produtos/{codigo}', [ProdutosController::class,'show']);

//rota para inserir os registros na tabela
Route::post('/produtos', [ProdutosController::class,'store']);

//rota para alterar os registros da tabela
Route::put('/produtos/{codigo}', [ProdutosController::class,'update']);

//rota para excluir o registro por id/codigo
Route::delete('/produtos/{id}', [ProdutosController::class,'destroy']);


