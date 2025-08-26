<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Facades\Validator; 

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $registros = Produtos::all();

    $contador = $registros->count();

    if ($contador > 0 ){
        return response()->json(['sucess' => true,
        'message'=> 'Produtos encontradas com sucesso!',
        'data' => $registros,
        'total' => $contador], 200);

    } else {
        return respsonse()->json([
            'sucess' => false,
            'message' => 'Nemhum produto encontrada.'
        ], 404);
    }
    }

    /**
     * Store a newly created resource in storage.
     */
      public function store(Request $request)
    {
        // validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'marca' => 'required',
            'preco' => 'required',
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400); // retorna HTTP 400
        }
 
        $registros = Produtos::created($request->all());
        if ($registros) {
            return response()->json([
                'sucess' => true,
                'message' => 'Produtos cadastrados com sucesso!',
                'data' => $registros
            ], 201);
        } else {
            return response()->json([
                'sucess' => false,
                'message' => 'Erro ao cadastrar um produto'
            ], 500);
        }
    }
 
 
    

          public function show($id)
    {
        $registros = Produtos::find($id);
       
        if ($registros) {
            return responde()->json([
                'sucess' => true,
                'message' => 'Produto localizado com sucesso!',
                'data' => $registros
            ], 200);
        } else {
            return response()->json([
                'sucess' => false,
                'message' => 'Produto não localizado',
            ], 404);
        }
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produtos $produtos)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'marca' => 'required',
            'preco' => 'required'
        ]);
 
        if ($validator->fails()) {
            return response()->json ([
                'suceess' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400);
        }
 
        $registrosBanco = Produtos::find($id);
 
        if (!$registrosBanco) {
            return response()->json([
                'sucess' => false,
                'message' => 'Produto não encontrado'
            ], 404);
        }
 
        $registrosBanco->nome = $request->nome;
        $registrosBanco->marca = $request->marca;
        $registrosBanco->preco = $request->preco;
 
        if ($registrosBanco->save()) {
            return response()->json([
                'sucess' => true,
                'message' => 'Produto atualizado com sucesso!',
                'data' => $registrosBanco
            ], 200);
        } else {
            return response()->json([
                'sucess' => false,
                'message' => 'Erro ao atualizar o produto'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produtos $produtos)
    {
    $registros = Produtos::find($id);
 
        if (!$registros) {
        return response()->json([
            'sucess' => false,
            'message' => 'Produto não encontrado'
        ], 404);
        }
        if ($registros->delete()) {
            return response()->json([
                'sucess' => true,
                'message' => 'Produto deletado com sucesso'
            ], 200);
        }
        return response()->json([
            'sucess' => false,
            'message' => 'Erro ao deletar um produto'
        ], 500);
    }
    }

