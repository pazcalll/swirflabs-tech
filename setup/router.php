<?php

$request = $_SERVER['REQUEST_URI'];

$web = require_once __DIR__ . '/../router/web.php';
$api = require_once __DIR__ . '/../router/api.php';
$newApi = [];
foreach ($api as $key => $value) {
    $newApi['/api' . $key] = $value;
}
$routes = array_merge($web, $newApi);

// Route requests
if (key_exists($request, $routes)) {
    $route = $routes[$request];

    // Handle request
    [$httpMethod, $controller, $classFunction] = $route;
    if ($_SERVER["REQUEST_METHOD"] !== $httpMethod) {
        http_response_code(405);
        echo $_SERVER["REQUEST_METHOD"] . " method not allowed.";
        exit;
    }
    $controllerInstance = new $controller();
    $response = $controllerInstance->$classFunction($_POST);

} else {
    http_response_code(404);
    echo "Page not found.";
}