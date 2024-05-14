<?php

namespace App;

require_once 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

class Router
{
    private $routes = [];

    public function loadRoutes($file): void
    {
        $routes = Yaml::parseFile($file);
        foreach ($routes as $name => $data) {
            $this->addRoute($data['path'], $data['controller'], $data['method'],$data['request_methods'], array_key_exists(key: 'params', array: $data) ? $data['params'] : []);
        }

    }

    public function addRoute($route, $controller, $method,$requestMethods, $params): void
    {
        $this->routes[] = [
            'path' => $route,
            'request_methods' => $requestMethods,
            'controller' => $controller,
            'method' => $method,
            'params' => $params];
    }

    /**
     * Dispatch the request to the appropriate controller
     *
     * @param string $url
     * @return void
     */
    public function dispatch(string $url): void
    {
        foreach ($this->routes as $route) {
            if (!empty($route['params'])) {
                foreach ($route['params'] as $param) {
                    if(!is_array($param)) continue; // Handle the 403 without getting an error on the foreach
                    foreach ($param as $content) {
                        if (preg_match("/" . $content . "/", $url, $matchesParams)) {
                            $entity = $matchesParams[0];
                            preg_match_all("/{[a-zA-Z]+}/", $route['path'], $matchesPath);
                            $route['path'] = str_replace($matchesPath[0], $entity, $route['path']);
                        }
                    }
                }
            }
            if ($route['path'] === explode("?", $url)[0] && in_array($_SERVER['REQUEST_METHOD'],$route['request_methods'])) { // check if the class exists
                if (!class_exists($route['controller'])) {
                    echo "{$route['controller']} not found";
                    return;
                } else {
                    $controller = new $route['controller'];
                    $method = $route['method'];
                    $data = json_decode(file_get_contents('php://input'), true);
                    $controller->$method($data ?? []);
                    return;
                }
            }
        }
        echo "404 Not Found";
    }
}