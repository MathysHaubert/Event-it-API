<?php

declare(strict_types=1);

namespace App\Tools;


class JSONResponse
{
    private mixed $data;
    public function __construct($data)
    {
        header('Content-Type: application/json');
        http_response_code(404);
        $this->data = json_encode($data);
    }

    public function send()
    {
        echo $this->data;
    }
}