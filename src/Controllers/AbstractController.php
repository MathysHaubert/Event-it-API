<?php

namespace App\Controllers;

require_once __DIR__ . '/../Tools/JSONResponse.php';

use OpenApi\Annotations as OA;

// config Swagger
/**
 * @OA\Info(
 *     version="1.0",
 *     title="Event-API",
 *     description="API for event event-it web site",
 *     @OA\Contact(name="G8D")
 * )
 * @OA\Server(
 *     url="https://localhost:8000",
 *     description="development server"
 * )
 */
class AbstractController
{

}