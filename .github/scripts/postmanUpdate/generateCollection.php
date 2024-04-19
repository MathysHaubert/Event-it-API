<?php

require '../../../event-api/vendor/autoload.php';

$routeContent = file_get_contents('../../../event-api/routes.yaml');
$routes = Spyc::YAMLLoadString($routeContent);

$endpoints = [];

foreach ($routes as $routeName => $routeData) {
    $endpointName = $routeName;
    $method = strtoupper($routeData['methods'][0]);
    $path = $routeData['path'];

    $endpoints[] = [
        'name' => $endpointName,
        'method' => $method,
        'path' => $path,
        'header' => $routeData['header'] ?? [],
        'body' => $routeData['body'] ?? [],
    ];
}

$collection = [
    'info' => [
        '_postman_id' => '36d404e3-d455-4e6e-a0de-2b51e3374852',
        'name' => 'Event-API',
        'description' => 'Your description here',
        'schema' => 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json',
        '_exporter_id' => '33172307',
    ],
    'item' => [],
    'event' => [
        [
            'listen' => 'prerequest',
            'script' => [
                'type' => 'text/javascript',
                'exec' => [''],
            ],
        ],
    ],
    "variable" => [
		[
			"key" => "id",
			"value" => "1"
        ],
		[
			"key" => "base_url",
			"value" => "https://postman-rest-api-learner.glitch.me/"
        ],
		[
			"key" => "event-API",
			"value" => "localhost:8088"
        ]
    ],
];

foreach ($endpoints as $endpoint) {
    $item = [
        'name' => $endpoint['name'],
        'request' => [
            'method' => $endpoint['method'],
            'url' => "{{ event-API }}" . $endpoint['path'],
            'header' => $endpoint['header'] ?? null,
            'body' => $endpoint['body'] ?? null,
        ],
    ];
    $collection['item'][] = $item;
}

echo json_encode($collection, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

