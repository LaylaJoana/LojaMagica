<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use Src\Core\Request;
use Src\Core\Router;

use Src\Controllers\PedidoController;
use Src\Controllers\ClienteController;
use Src\Controllers\ProdutoController;
use Src\Controllers\PromocaoController;
use Src\Controllers\ImportacaoController;

$request = new Request();
$router = new Router();

$router->addRoute('GET', 'pedidos', [PedidoController::class, 'index']);
$router->addRoute('GET', 'pedidos/create', [PedidoController::class, 'create']);
$router->addRoute('POST', 'pedidos/store', [PedidoController::class, 'store']);
$router->addRoute('GET', 'pedidos/edit/{id}', [PedidoController::class, 'edit']);
$router->addRoute('GET', 'pedidos/deleteview/{id}', [PedidoController::class, 'deleteView']);
$router->addRoute('GET', 'pedidos/delete/{id}', [PedidoController::class, 'delete']);
$router->addRoute('POST', 'pedidos/update', [PedidoController::class, 'update']);

$router->addRoute('GET', 'clientes', [ClienteController::class, 'index']);
$router->addRoute('GET', 'clientes/create', [ClienteController::class, 'create']);
$router->addRoute('POST', 'clientes/new', [ClienteController::class, 'new']);
$router->addRoute('GET', 'clientes/edit/{id}', [ClienteController::class, 'edit']);
$router->addRoute('GET', 'clientes/deleteview/{id}', [ClienteController::class, 'deleteView']);
$router->addRoute('GET', 'clientes/delete/{id}', [ClienteController::class, 'delete']);
$router->addRoute('POST', 'clientes/update', [ClienteController::class, 'update']);

$router->addRoute('GET', 'produtos', [ProdutoController::class, 'index']);
$router->addRoute('GET', 'produtos/create', [ProdutoController::class, 'create']);
$router->addRoute('POST','produtos/new', [ProdutoController::class, 'new']);
$router->addRoute('GET', 'produtos/edit/{id}', [ProdutoController::class, 'edit']);
$router->addRoute('GET', 'produtos/deleteview/{id}', [ProdutoController::class, 'deleteView']);
$router->addRoute('GET', 'produtos/delete/{id}', [ProdutoController::class, 'delete']);
$router->addRoute('PUT', 'produtos/update', [ProdutoController::class, 'update']);

$router->addRoute('GET', 'promocoes', [PromocaoController::class, 'index']);
$router->addRoute('GET', 'promocoes/create', [PromocaoController::class, 'create']);
$router->addRoute('POST','promocoes/new', [PromocaoController::class, 'new']);
$router->addRoute('GET', 'promocoes/edit/{id}', [PromocaoController::class, 'edit']);
$router->addRoute('GET', 'promocoes/deleteview/{id}', [PromocaoController::class, 'deleteView']);
$router->addRoute('GET', 'promocoes/delete/{id}', [PromocaoController::class, 'delete']);
$router->addRoute('POST', 'promocoes/update', [PromocaoController::class, 'update']);

$router->addRoute('GET', 'importacoes', [ImportacaoController::class, 'index']);




// $router->dispatch($request);

require '../src/Views/app.php';
?>