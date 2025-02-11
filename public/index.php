<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use Src\Core\Request;
use Src\Core\Router;

use Src\Controllers\PedidoController;

$request = new Request();
$router = new Router();

$router->addRoute('GET', 'pedidos', [PedidoController::class, 'index']);
$router->addRoute('GET', 'pedidos/create', [PedidoController::class, 'create']);
$router->addRoute('POST', 'pedidos/store', [PedidoController::class, 'store']);

// $router->dispatch($request);

require '../src/Views/app.php';
?>