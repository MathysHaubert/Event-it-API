<?php

namespace App\Controllers\Connection;

use App\Controllers\AbstractController;
use Doctrine\ORM\Exception\ORMException;
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
     *     path="/login",
     *     operationId="loginUser",
     *     tags={"Login"},
     *     summary="Log in a user",
     *     @OA\RequestBody(
     *         required=true,
     *         description="User credentials",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"email", "password"},
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="user@example.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     example="yourpassword"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *                 description="Authentication token"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid credentials"
     *     )
     * )
     */
    public function login(array $params): void
    {
    $email = $params['email'];
    $password = $params['password'];
    $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        if ($user === null) {
            $response = new JSONResponse(['error' => 'User not found']);
            $response->send();
            return;
        }
        if ($password == $user->getPassword()) {
            $response = new JSONResponse([
                "id" => $user->getId(),
                "email" => $user->getEmail(),
                "firstName" => $user->getFirstName(),
                "lastName" => $user->getLastName(),
                "organization" => $user->getOrganization(),
                "lastConnection" => $user->getLastConnection(),
                "createdAt" => $user->getCreatedAt(),
                "role" => $user->getRole(),
                "token" => $user->getJWT()
            ]);
            $response->send();
        } else {
            $response = new JSONResponse(['error' => 'Password not valid']);
            $response->send();
        }
    }

    /**
     * @OA/Get(
     * path="/currentUser",
     * @OA/Header(header="Authorization", description="Bearer token"),
     * @OA\Response(
     * response="200",
     * description="Get the current user",
     * @OA\JsonContent(type="object", description="User object")
     * )
     * )
     * @throws ORMException
     */
    public function currentUser(){
        $headers = getallheaders();
        $token = $headers['Authorization'];
        $jwt = new JWT();
        $id = $jwt->decode($token)['id'];
        $user = $this->entityManager->getRepository(User::class)->find($id);
        $response = new JSONResponse($user);
        $response->send();
    }
}