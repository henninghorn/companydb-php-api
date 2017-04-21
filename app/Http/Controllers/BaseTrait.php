<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

trait BaseTrait {

    public function respond($data, $status = Response::HTTP_OK)
    {
        return response()->json($data, $status);
    }

}