<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function showMessage(Request $request)
    {
        $response = [
            'name' => "Leonardo",
            'lastname' => "Ribeiro",
            "age" => 26,
            "programming_language" => "PHP" 
        ];

        return Response($response, 418);
    }   
}
