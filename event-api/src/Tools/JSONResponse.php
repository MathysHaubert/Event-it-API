<?php

declare(strict_types=1);

namespace App\Tools;


class JSONResponse
{
    private mixed $data;
    public function __construct($data)
    {
        header('Content-Type: application/json');
        http_response_code(200);
        $this->data = json_encode($data);
    }

    public function send(): void
    {

        echo $this->data;
    }
}