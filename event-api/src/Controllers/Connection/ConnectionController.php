<?php

namespace App\Controllers\Connection;

use App\Controllers\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ConnectionController extends AbstractController
{
    public function checkConnection()
    {
        header("Content-Type: application/json");
        echo json_encode(['status' => true]);
        exit;
    }
}