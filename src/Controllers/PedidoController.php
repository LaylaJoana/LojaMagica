<?php 

namespace Src\Controllers;

use Exception;
use Src\Core\Request;
use Src\Core\Router;
use Src\Database\Connection;
use Src\Services\PedidoService;
use Src\Models\Cliente;
use Src\Models\ItemPedido;
use Src\Models\Pedido;
use Src\Models\Produto;

class PedidoController {
    
    private $pedidoService;
    
    const EMAIL_CRIACAO = 'C';
    const EMAIL_ATUALIZACAO = 'A';

    public function __construct()
    {
        $this->pedidoService = new PedidoService();
    }

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
            Connection::beginTransaction();

            $pedido = $this->pedidoService->criarPedido($post['cliente_id']);
            $valor_total = $this->pedidoService->processarItensPedido($pedido, $post['produtos']);
            $this->pedidoService->atualizarValorTotalPedido($pedido, $valor_total);
            $this->pedidoService->enviarEmailConfirmacao($post['cliente_id'], $pedido, self::EMAIL_CRIACAO);

            Connection::commit();

            flash('pedido_sucesso', 'Pedido cadastrado com sucesso!');
            header('location: /pedidos');
        } catch (Exception $e) {
            Connection::rollBack();
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

        view('/pedidos/edit', [
            'pedido' => $pedido,
            'clientes' => Cliente::all(),
            'produtos' => Produto::all(),
            'itens' => ItemPedido::where('pedido_id', $id)
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
            Connection::beginTransaction();

            $pedido = $this->pedidoService->atualizarPedido($post);
            $this->pedidoService->deletarItensPedido($post['id']);
            $valor_total = $this->pedidoService->processarItensPedido($pedido, $post['produtos']);
            $this->pedidoService->atualizarValorTotalPedido($pedido, $valor_total);
            $this->pedidoService->enviarEmailConfirmacao($post['cliente_id'], $pedido, self::EMAIL_ATUALIZACAO);

            Connection::commit();

            flash('pedido_sucesso', 'Pedido atualizado com sucesso!');
            header('Location: /pedidos');
            exit;
        } catch (Exception $e) {
            Connection::rollBack();
            error_log('Erro ao atualizar pedido: ' . $e->getMessage());
            flash('pedido_erro', 'Erro ao atualizar o pedido. Tente novamente.');
            header('Location: /pedidos/edit/' . $post['id']);
            exit;
        }
    }

}