<?php

namespace App\Controllers;

require_once __DIR__ . '/../Tools/JSONResponse.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
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
abstract class AbstractController
{
    protected EntityManager $entityManager;
    public function __construct(){
        $paths = [__DIR__."../entity"];

        $isDevMode = true;
        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);

        $connectionParams = [
            'driver' => 'pdo_mysql',
            'host' => 'db', // This is the service name defined in your Docker Compose file
            'port' => 3306, // Default MySQL port
            'dbname' => 'event-API',
            'user' => 'user',
            'password' => 'pass',
        ];

        $dbalConnection = DriverManager::getConnection($connectionParams, $config);

        $this->entityManager = new EntityManager($dbalConnection, $config);
    }
}