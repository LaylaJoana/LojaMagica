<?php

namespace Src\Api\Controllers;

use Src\Models\Cliente;
use Src\Models\Importacao;
use Src\Models\ItemPedido;
use Src\Models\Pedido;
use Src\Models\Produto;

class IntegracaoController
{
    public function importar(): void
    {
        $xmlBody = file_get_contents('php://input');
        $dados = $this->xmlToArray($xmlBody);

        foreach ($dados['pedido'] as $dado) {
            $cliente = Cliente::findBy('nome', $dado['nome_loja']);

            if ($cliente) {
                $pedido = Pedido::create([
                    'cliente_id' => $cliente->id,
                    'status' => 'pendente',
                    'valor_total' => 0
                ]);

                $produto = Produto::findBy('nome', $dado['produto']);

                if ($produto) {
                    $produto->estoque = $produto->estoque - $dado['quantidade'];
                    $produto->save();

                    ItemPedido::create([
                        'pedido_id' => $pedido->id,
                        'produto_id' => $produto->id,
                        'quantidade' => $dado['quantidade'],
                        'preco_unitario' => $produto->preco
                    ]);

                    $pedido->valor_total = $produto->preco * $dado['quantidade'];
                    $pedido->save();
                }
            }
        }
    }

    private function xmlToArray(string $xmlContent): array
    {
        $xmlObject = simplexml_load_string($xmlContent, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xmlObject);
        return json_decode($json, true);
    }
}
