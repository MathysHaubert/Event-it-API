<?php

namespace App\Controllers\Connection;

use App\Controllers\AbstractController;
use OpenApi\Annotations as OA;
use App\Tools\JSONResponse;
use App\Tools\JWT;

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

    /**
     * @OA\Get(
     * path="/getExampleToken",
     * @OA\Response(
     * response="200",
     * description="Generate public and private keys for JWT authentication",
     * @OA\JsonContent(type="string", description="Connection status")
     * )
     * )
     */
    public function exampleJWT(): void
    {
        /** @var JWT $jwt */
        $jwt = new JWT();
        $jwt->create();
        $jwt->addPayload([
            'iss' => 'http://localhost:8080',
            'aud' => 'http://localhost:8080',
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + 3600,
        ]);
        $jwt->encode();
        echo print_r($jwt->getJWT());
        echo print_r($jwt->getPrivateKey());
        echo print_r($jwt->getPublicKey());
    }
}