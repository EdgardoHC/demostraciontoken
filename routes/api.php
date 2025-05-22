<?php
require_once './controllers/AuthController.php';
require_once './controllers/ProtectedController.php';
require_once './config/database.php';

$db = (new Database())->connect();

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];


if ($request === '/demostraciontoken/api/register' && $method === 'POST') {
    (new AuthController($db))->register();
} elseif ($request === '/demostraciontoken/api/login' && $method === 'POST') {
    (new AuthController($db))->login();
} elseif ($request === '/demostraciontoken/api/protected' && $method === 'GET') {
    (new ProtectedController())->index();
} else {
    http_response_code(404);
    echo json_encode(["error" => "Ruta no encontrada"]);
   // var_dump($request);
}
