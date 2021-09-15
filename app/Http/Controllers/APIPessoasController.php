<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ListagemDePessoasRequest;
use Illuminate\Support\Facades\Validator;
class APIPessoasController extends Controller
{

    protected $list = [];

    //* Route
    public function listagemDePessoas()
    {
        return Response($this->trataListagemDePessoas(), 200);
    }

    public function cadastraPessoa(Request $request)
    {
       return $this->actionCadastraPessoa($request);
    }

    //* Helper
    private function trataListagemDePessoas()
    {
        
        //* Função que coloca as letras maiusculas.
        strtoupper("test");

        $lista = [
            [
                "nome" => "Leonardo 0",
                "idade" => 26,
                "email" => "leo@leo.com"
            ],
            [
                "nome" => "Leonardo 1",
                "idade" => 27,
                "email" => "leo@leo.com"
            ],
            [
                "nome" => "Leonardo 2",
                "idade" => 28,
                "email" => "leo@leo.com"
            ],
            [
                "nome" => "Leonardo 3",
                "idade" => 29,
                "email" => "leo@leo.com"
            ],
        ];

        return collect($lista)->map(function($item){
            $item['nome'] = strtoupper($item['nome']);
            return $item;
        })->values();

    }

    //* Cadatra pessoa Action

    private function actionCadastraPessoa($request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:100',
            'idade' => 'required|int|max:120|min:1',
            'cep' => 'required|string|max:8',
            'email' => 'required|email'
        ]);

        if($validator->fails()){
            return Response($validator->errors(), 406);
        }

        $request->nome = strtoupper($request->nome);
        
        $pessoa = [
            'nome' => $request->nome,
            'idade' => $request->idade,
            'cep' => $request->cep,
            'email' => $request->email
        ];

        array_push($this->list, $pessoa);

        return $this->list;

    }

}
