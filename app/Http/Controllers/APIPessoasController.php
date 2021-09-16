<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ListagemDePessoasRequest;
use App\Http\Resources\ListagemPessoasResource;
use App\Models\Pessoas;

class APIPessoasController extends Controller
{

    protected $list = [];

    //* Route
    public function listagemDePessoas()
    {

        $list = Pessoas::all();

        Log::info("It`s work!");
        
        return Response(  
            ListagemPessoasResource::collection($list)
            ->filter(function($list){
                return $list['idade'] >= 28;
            })->values(), 200);
    }

    public function cadastraPessoa(Request $request)
    {
       return $this->actionCadastraPessoa($request);
    }

    //* Helper
    private function trataListagemDePessoas()
    {
        //? Collection helper
        // return collect($lista)->map(function($item){
        //     $item['nome'] = strtoupper($item['nome']);
        //     return $item;
        // })->values();

        return ListagemPessoasResource::collection($this->lista);

    }

    //* Cadatra pessoa Action

    private function actionCadastraPessoa($request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:120',
            'idade' => 'required|int|max:120|min:1',
            'email' => 'required|email'
        ]);

        if($validator->fails()){
            return Response($validator->errors(), 406);
        }

        $request->nome = strtoupper($request->nome);
        try {
            $pessoa = Pessoas::create([
                'id'   => (int) $request->id,
                'nome' => $request->nome,
                'idade' => $request->idade,
                'email' => $request->email
            ]);
        }catch(\Exception $e) {
            return Response([
                'status' => 500,
                'msg' => $e->getMessage()
            ], 500);
        }

       

        return Response($pessoa, 201);

    }

}
