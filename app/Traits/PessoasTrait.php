<?php

namespace App\Traits;

use App\Models\Pessoas;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ListagemPessoasResource;
use Illuminate\Support\Facades\Log;

trait PessoasTrait
{
    public function CreatePessoasTrait(object $request) : array
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:120',
            'age' => 'required|int|max:120|min:1',
            'email' => 'required|email'
        ]);

        if($validator->fails()){
            return [
                'status' => 406,
                'data' => $validator->errors()
                ];
        }

        $request->name = strtoupper($request->name);
     
        try {
            $pessoa = Pessoas::create([
                'nome' => $request->name,
                'idade' => $request->age,
                'email' => $request->email
            ]);
        }catch(\Exception $e) {
            return [
                'status' => 500,
                'msg' => $e->getMessage(),
                'data' => []
            ];
        }

        return [
            'status' => 201,
            'data' => $pessoa
        ];
    }

    public function ListagemDePessoasTrait(object $request) : array
    {

        if(isset($request->filter_age)){
            $list = Pessoas::where(['idade' => $request->filter_age])->get();
        } else {
            $list = Pessoas::all();
        }

        Log::info("It`s work!");
        
        return [ 
            'status' => 200,
            'data' => ListagemPessoasResource::collection($list)->values(), 
        ];
    }

    public function UpdatePessoasTrait(object $request, int $id) : array
    {

        $fieldsValidator = array_merge($request->all(), ['id' => $id]);

        $validator = Validator::make($fieldsValidator, [
            'id' => 'required|int',
            'name' => 'required|string|max:120',
            'age' => 'required|int|max:120|min:1',
            'email' => 'required|email'
        ]);

        if($validator->fails()){
            return [
                'status' => 406,
                'data' => $validator->errors()
                ];
        }

        try {

            $pessoa = Pessoas::find($id);

            $pessoa->nome = $request->name;
            $pessoa->idade = $request->age;
            $pessoa->email = $request->email;
    
            $pessoa->save();

        }catch(\Exception $e) {
            return [
                'status' => 500,
                'msg' => $e->getMessage(),
                'data' => []
            ];
        }

        return [
            'status' => 201,
            'data' => $pessoa
        ];
        
    }
}