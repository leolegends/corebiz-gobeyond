<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

trait VtexConnect {
    
    public function connectGet($url)
    {        
        $result = Http::accept('application/json')->get($url)->collect();

        return $result->filter(function($item){
            return $item['productId'] == "10015499";
        })->values();

        // dd($result);

        // return $result;
    }

}


