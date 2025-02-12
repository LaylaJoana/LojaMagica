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
            error_log('Erro ao cadastrar pedido: ' . $e->getMessage());
            flash('pedido_erro', 'Erro ao cadastrar o pedido. Tente novamente.');
            header('Location: /pedidos/create');
            exit;
        }
        
    }

    public function edit($id): void
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            flash('pedido_erro', 'Pedido não encontrado.');
            header('Location: /pedidos');
            exit;
        }

        $itens = ItemPedido::where('pedido_id', $id);

        view('/pedidos/edit', [
            'pedido' => $pedido,
            'clientes' => Cliente::all(),
            'produtos' => Produto::all(),
            'itens' => $itens
        ]);
    }

    public function deleteView($id): void
    {
        $pedido = Pedido::find($id);

        view('/pedidos/delete', [
            'pedido' => $pedido,
            'cliente' => Cliente::find($pedido->cliente_id)
        ]);
    }

    public function delete($id): void
    {
        $pedido = Pedido::delete($id);

        if($pedido) {
            flash('pedido_sucesso', 'Pedido excluído com sucesso!');
            header('Location: /pedidos');
            exit;
        }
    }

    public function update(Request $request): void
    {
        $post = $request->getAllParams();

        if (empty($post['id']) || empty($post['cliente_id']) || empty($post['produtos']) || !is_array($post['produtos'])) {
            flash('pedido_erro', 'Dados inválidos. Verifique os campos e tente novamente.');
            header('Location: /pedidos/edit/' . $post['id']);
            exit;
        }

        try {

            Pedido::beginTransaction();

            $pedido = Pedido::update([
                'id' => $post['id'],
                'cliente_id' => $post['cliente_id'],
                'status' => $post['status'],
                'valor_total' => $post['valor_total']
            ]);

            if ($pedido) {
                $itens = ItemPedido::where('pedido_id', $pedido->id);
                foreach ($itens as $item) {
                    ItemPedido::delete($item->id);
                }

                foreach ($post['produtos'] as $idProduto => $quantidade) {
                    $produto = Produto::find($idProduto);

                    if (!$produto || $quantidade <= 0) {
                        throw new Exception('Produto inválido ou quantidade inválida.');
                    }

                    $item = ItemPedido::create([
                        'pedido_id' => $pedido->id,
                        'produto_id' => $produto->id,
                        'quantidade' => $quantidade,
                        'preco_unitario' => $produto->preco
                    ]);

                    if ($item) {
                        Produto::update([
                            'id' => $produto->id,
                            'estoque' => (int) $produto->estoque - $quantidade
                        ], ['estoque']);
                    }
                }
            }

            Pedido::commit();

            flash('pedido_sucesso', 'Pedido atualizado com sucesso!');
            header('Location: /pedidos');
            exit;
        } catch (Exception $e) {

            Pedido::rollBack();
            
            error_log('Erro ao atualizar pedido: ' . $e->getMessage());
            flash('pedido_erro', 'Erro ao atualizar o pedido. Tente novamente.');
            header('Location: /pedidos/edit/' . $post['id']);
            exit;
        }
    }

}