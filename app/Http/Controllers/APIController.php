<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function showMessage(Request $request)
    {
        return Response([
            'status' => 200,
            'msg' => 'Hello World'
        ], 200);
    }
}
