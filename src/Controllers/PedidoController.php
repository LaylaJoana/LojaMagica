<?php 

namespace Src\Controllers;

use Exception;
use Src\Core\Request;
use Src\Core\Router;
use Src\Models\Cliente;
use Src\Models\ItemPedido;
use Src\Models\Pedido;
use Src\Models\Produto;

class PedidoController {
    
    public function index(): void
    {
        view('/pedidos/index', [
            'pedidos' => Pedido::all()
        ]);
    }

    public function create(): void
    {
        view('/pedidos/create', [
            'produtos' => Produto::all(),
            'clientes' => Cliente::all()
        ]);
    }

    public function store(Request $request): void
    {
        $post = $request->getAllParams();

        try {
            $pedido = Pedido::create([
                'cliente_id' => $post['cliente_id'],
                'status' => 'pendente'
            ]);
    
            if ($pedido) {
                foreach ($post['produtos'] as $idproduto => $quantidade) {
                    $produto = Produto::find($idproduto);
        
                    $item = ItemPedido::create([
                        'pedido_id' => $pedido->id,
                        'produto_id' => $produto->id,
                        'quantidade' => $quantidade,
                        'preco_unitario' => $produto->preco
                    ]);
        
                    if ($item) {
                        $updateEstoque = Produto::update([
                            'id' => $produto->id,
                            'estoque' => (int) $produto->estoque - $quantidade
                        ], ['estoque']);
                    }
                }
            }

            flash('pedido_sucesso', 'Pedido cadastrado com sucesso!');
            header('location: /pedidos');
        } catch (Exception $e) {
            var_dump($e->getMessage()); exit;
        }
        
    }

}