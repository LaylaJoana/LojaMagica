<?php

namespace Src\Controllers;

use Exception;
use Src\Core\Excel;
use Src\Core\Request;
use Src\Core\Router;
use Src\Core\SistemasArquivos;
use Src\Models\Importacao;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Src\Database\Connection;
use Src\Models\Cliente;
use Src\Models\ItemPedido;
use Src\Models\Pedido;
use Src\Models\Produto;

class ImportacaoController
{
    public function index(): void
    {
        view('/importacoes/index', [
            'importacoes' => Importacao::all()
        ]);
    }

    public function importar(): void
    {
        $sistemaArquivos = new SistemasArquivos();
        $arquivo = $sistemaArquivos->salvarArquivo('imports', $_FILES['arquivo']);
        $dados = Excel::toArray($arquivo);
        array_shift($dados);

        foreach ($dados as $dado) {
            $clienteNome = $dado[1];
            $clienteEmail = $dado[2];
            $pedidoProduto = $dado[3];
            $pedidoData = $dado[4];
            $pedidoValor = $dado[5];

            if ($clienteNome && $clienteEmail) {

                $cliente = Cliente::findBy('email', $clienteEmail);

                if ($cliente && ($pedidoProduto && $pedidoData && (int) $pedidoValor)) {

                    $existeEstePedido = Connection::executeSql('
                        SELECT * FROM clientes c
                        LEFT JOIN pedidos p ON c.id = p.cliente_id
                        LEFT JOIN itens_pedido ip ON p.id = ip.pedido_id
                        LEFT JOIN produtos pd ON pd.id = ip.produto_id
                        WHERE c.id = ' . $cliente->id . ' && pd.nome = "' . $pedidoProduto . '" AND date(p.data_pedido) = "' . $pedidoData . '";
                    ');

                    if ($existeEstePedido) {
                        continue;
                    } else {
                        $produtos = explode(';', $pedidoProduto);

                        $pedido = Pedido::create([
                            'cliente_id' => $cliente->id,
                            'status' => 'pendente',
                            'valor_total' => $pedidoValor * count($produtos)
                        ]);

                        foreach ($produtos as $produto) {
                            $produto = Produto::findBy('nome', trim($produto));

                            if ($produto) {
                                $pedido->data_pedido = $pedidoData;
                                $pedido->save();

                                $item = ItemPedido::create([
                                    'pedido_id' => $pedido->id,
                                    'produto_id' => $produto->id,
                                    'quantidade' => 1,
                                    'preco_unitario' => $pedidoValor
                                ]);

                                if ($item && $pedidoData >= date('Y-m-d')) {
                                    $produto->updateEstoque(-1);
                                }
                            }
                        }
                    }
                }
            }
        }
        
        Importacao::create([
            'arquivo' => basename($arquivo),
            'tipo' => pathinfo($arquivo)['extension']
        ]);

        header('Location: /importacoes');
    }

    public function download($id): void
    {
        $importacao = Importacao::find($id);
        if (!$importacao) {
            throw new Exception('Arquivo não encontrado.');
        }

        $sistemaArquivos = new SistemasArquivos();
        $sistemaArquivos->downloadArquivo('imports/' . $importacao->arquivo);
        exit;
    }
}
