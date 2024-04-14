<?php

namespace App\Tools;

class JSONResponse
{
    public function __construct($data)
    {
        header('Content-Type: application/json');
        http_response_code(404);
        echo json_encode($data);
    }
}