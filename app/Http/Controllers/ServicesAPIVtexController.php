<?php

namespace App\Http\Controllers;

use App\Services\VtexSearchService;
use Illuminate\Http\Request;

class ServicesAPIVtexController extends Controller
{

    protected $endpoint;

    public function __construct()
    {
        $this->endpoint = new VtexSearchService();  
    }
    

    public function listagemSearchVtex()
    {

        $result = $this->endpoint->connectGet("https://loja.chillibeans.com.br/api/catalog_system/pub/products/search?Rayban");

        return $result;
    }

}
