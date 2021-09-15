<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIPessoasController extends Controller
{
    public function listagemDePessoas()
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

        $lista = collect($lista)->map(function($item){
            $item['nome'] = strtoupper($item['nome']);
            return $item;
        })->filter(function($item){
            return $item['idade'] >= 28;
        })->values();

        return Response($lista, 200);
    }
}
