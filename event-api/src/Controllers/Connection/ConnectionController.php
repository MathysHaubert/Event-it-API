<?php

namespace App\Controllers\Connection;

use App\Controllers\AbstractController;
use OpenApi\Annotations as OA;
use App\Tools\JSONResponse;
use App\Tools\JWT;
use App\Entity\User;

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

    /**
     * @OA\Post(
     * path="/login",
     * @OA\RequestBody(
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="email", type="string"),
     * @OA\Property(property="password", type="string"),
     * )
     * ),
     * @OA\Response(
     * response="200",
     * description="Login to the API",
     * headers={
     *     @OA\Header(header="Access-Control-Allow-Origin", description="CORS header", @OA\Schema(type="string")),
     *     @OA\Header(header="Access-Control-Allow-Methods", description="CORS header", @OA\Schema(type="string")),
     *     @OA\Header(header="Access-Control-Allow-Headers", description="CORS header", @OA\Schema(type="string"))
     * }
     * )
     * )
     * @OA\Options(
     * path="/login",
     * @OA\Response(
     * response="200",
     * description="Preflight response",
     * headers={
     *     @OA\Header(header="Access-Control-Allow-Origin", description="CORS header", @OA\Schema(type="string")),
     *     @OA\Header(header="Access-Control-Allow-Methods", description="CORS header", @OA\Schema(type="string")),
     *     @OA\Header(header="Access-Control-Allow-Headers", description="CORS header", @OA\Schema(type="string"))
     * }
     * )
     * )
     * @throws ORMException
     */
    public function login(array $params): void
    {
    // If the request method is OPTIONS, set the headers and exit
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header("Access-Control-Allow-Origin: http://localhost:9000");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
        exit;
    }

    // The rest of your method goes here
    header("Access-Control-Allow-Origin: http://localhost:9000");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type");
    $email = $params['email'];
    $password = $params['password'];
    $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        if ($user === null) {
            $response = new JSONResponse(['error' => 'User not found']);
            $response->send();
            return;
        }
        if ($password == $user->getPassword()) {
            $response = new JSONResponse($user->jsonSerialize());
            $response->send();
        } else {
            $response = new JSONResponse(['error' => 'Password not valid']);
            $response->send();
        }
    }
}