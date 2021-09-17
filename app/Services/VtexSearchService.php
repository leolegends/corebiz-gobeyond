<?php

namespace App\Services;


class VtexSearchService {

    use VtexConnect;

    public function searchServiceVtex()
    {
    
        return $this->connectGet("https://loja.chillibeans.com.br/api/catalog_system/pub/products/search?Rayban");

    }

}