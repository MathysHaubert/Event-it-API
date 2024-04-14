<?php

namespace App;

use Exception;

require_once __DIR__ . '/Controllers/NotFoundController/NotFoundController.php';
require_once __DIR__ . '/Router.php';

ob_start();

// in dev mode only
error_reporting(E_ALL);
ini_set('display_errors', 1);
//

try {

    $router = new Router();

    $router->loadRoutes(__DIR__ . 'routes.yaml');
    $url = $_SERVER['REQUEST_URI'];
    $router->dispatch($url);


} catch (Exception $e) {
    echo ('Error: ' . $e->getMessage(). sprintf(' in file %s at line %s', $e->getFile(), $e->getLine()));
}