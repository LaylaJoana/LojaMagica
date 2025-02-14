<?php

namespace Src\Services;

use Src\Core\Email;
use Src\Models\Cliente;
use Src\Models\ItemPedido;
use Src\Models\Pedido;
use Src\Models\Produto;

class PedidoService
{
    public function criarPedido(int $cliente_id): Pedido
    {
        return Pedido::create([
            'cliente_id' => $cliente_id,
            'status' => 'pendente',
            'valor_total' => 0
        ]);
    }

    public function processarItensPedido($pedido, array $produtos): float
    {
        $valor_total = 0;

        foreach ($produtos as $idproduto => $quantidade) {
            $produto = Produto::find($idproduto);

            $item = ItemPedido::create([
                'pedido_id' => $pedido->id,
                'produto_id' => $produto->id,
                'quantidade' => $quantidade,
                'preco_unitario' => $produto->preco
            ]);

            $valor_total += $produto->preco * $quantidade;

            if ($item) {
                Produto::update([
                    'id' => $produto->id,
                    'estoque' => (int) $produto->estoque - $quantidade
                ], ['estoque']);
            }
        }

        return $valor_total;
    }

    public function atualizarValorTotalPedido($pedido, float $valor_total): void
    {
        Pedido::update(['id' => $pedido->id, 'valor_total' => $valor_total], ['valor_total']);
    }

    public function enviarEmailConfirmacao(int $cliente_id,  $pedido, string $tipo_email): void
    {
        $cliente = Cliente::find($cliente_id);
        if($tipo_email == 'C') {
            $subject = 'Pedido Criado - Loja Mágica';
            $body = 'Olá ' . $cliente->nome . ',<br><br>Seu pedido foi criado com sucesso. O status do pedido é: ' . $pedido->status . '.<br><br>Obrigado por comprar na Loja Mágica!';
        } else if ($tipo_email == 'A') {
            $subject = 'Pedido Atualizado - Loja Mágica';
            $body = 'Olá ' . $cliente->nome . ',<br><br>Seu pedido foi atualizado com sucesso. O status do pedido é: ' . $pedido->status . '.<br><br>Obrigado por comprar na Loja Mágica!';
        }
    
        if ($cliente->receber_emails == 'S') {
            Email::send($cliente->email, $subject, $body);
        }
    }

    public function atualizarPedido(array $post): Pedido
    {
        return Pedido::update([
            'id' => $post['id'],
            'cliente_id' => $post['cliente_id'],
            'status' => $post['status'],
            'valor_total' => $post['valor_total']
        ]);
    }

    public function deletarItensPedido(int $pedido_id): void
    {
        $itens = ItemPedido::where('pedido_id', $pedido_id);
        
        foreach ($itens as $item) {
            ItemPedido::delete($item->id);
        }
    }
}
