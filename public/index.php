<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use Src\Core\Request;
use Src\Core\Router;

use Src\Controllers\PedidoController;
use Src\Controllers\ClienteController;

$request = new Request();
$router = new Router();

$router->addRoute('GET', 'pedidos', [PedidoController::class, 'index']);
$router->addRoute('GET', 'pedidos/create', [PedidoController::class, 'create']);
$router->addRoute('POST', 'pedidos/store', [PedidoController::class, 'store']);
$router->addRoute('GET', 'clientes', [ClienteController::class, 'index']);
$router->addRoute('GET', 'clientes/create', [ClienteController::class, 'create']);
$router->addRoute('POST', 'clientes/new', [ClienteController::class, 'new']);
$router->addRoute('GET', 'clientes/edit/{id}', [ClienteController::class, 'edit']);
$router->addRoute('GET', 'clientes/deleteview/{id}', [ClienteController::class, 'deleteView']);
$router->addRoute('GET', 'clientes/delete/{id}', [ClienteController::class, 'delete']);
$router->addRoute('POST', 'clientes/update', [ClienteController::class, 'update']);
// $router->dispatch($request);

require '../src/Views/app.php';
?>