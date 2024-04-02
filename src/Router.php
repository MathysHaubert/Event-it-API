<?php

namespace App;

class Router {
    private array $routes = [];

    public function loadRoutes($file): void
    {
        $routes = yaml_parse_file("routes.yaml");
        foreach ($routes['routes'] as $name => $data) {
            $this->addRoute($data['path'], $data['controller'], $data['method'], array_key_exists(key:'parameters',array:$data) ? $data['parameters'] : []);
        }

    }

    public function addRoute($route, $controller, $method, $params): void
    {
        $this->routes[] = [
            'path' => $route,
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
            // Currently, the route cannot be find. ex: id will be "12" and not "{id}"
            if (!empty($route['params'])) {
                // get params from the route with {}
                preg_match_all('/\{([^}]*)}/', $route["path"], $matches);
                /** @var array $options */
                foreach ($route['params'] as $key => $options) {
                    $index = array_search($options, $matches[1]);
                    //replace le number by {id}
                    if ($options["type"] === "int") {
                        preg_match('/\d+/', $url, $resultArray);
                        $data[$key] = array_values($resultArray);
                    }
                    $url = preg_replace('/\{([^}]*)}/', $matches[0][$index], $route["path"]);
                    // si le parametre est de type int on récupère un chiffre
                }
            }
            if ($route['path'] === $url) { // c heck if the class exists
                if (!class_exists($route['controller'])) {
                    echo "{$route['controller']} not found";
                    return;
                } else {
                    $controller = new $route['controller'];
                    $method = $route['method'];
                    $controller->$method($data ?? []);
                    return;
                }
            }
        }
        (new Controllers\NotFoundController\NotFoundController())->notFound();
    }
}