<?php

ob_start();

require_once 'Router.php';

// in dev mode only
error_reporting(E_ALL);
ini_set('display_errors', 1);
//
try {
    // check if app.log already exists
    // Démarrer la session PHP
    session_start();
    // Vérifier si la locale est déjà définie dans la session
    if (!isset($_SESSION['locale'])) {
        // Si non, définir la locale par défaut à 'en'
        $_SESSION['locale'] = 'en';
    }
    $router = new Router();
    $router->loadRoutes(__DIR__ . '/routes.yaml');
    $url = $_SERVER['REQUEST_URI'];
    $router->dispatch($url);


} catch (Exception $e) {
    echo ('Error: ' . $e->getMessage(). sprintf(' in file %s at line %s', $e->getFile(), $e->getLine()));
}