<?php

namespace App\Controllers\Connection;

use App\Controllers\AbstractController;
use OpenApi\Annotations as OA;
use App\Tools\JSONResponse;

class ConnectionController extends AbstractController
{
    /**
     * @OA\Get(
     *      path="/connection",
     *      @OA\Response(
     *      response="200",
     *      description="Check if the connection is working.",
     *      @OA\JsonContent(type="boolean",description="Connection status"),
     *     )
     * )
     */
    public function check()
    {
        header('Content-Type: application/json; charset=utf-8');
        $response = new JSONResponse(true);
        $response->send();
    }
}