<?php

namespace Src\Controllers;

use Exception;
use Src\Core\Excel;
use Src\Core\Request;
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
            $this->processarLinha($dado);
        }

        Importacao::create([
            'arquivo' => basename($arquivo),
            'tipo' => pathinfo($arquivo)['extension']
        ]);

        header('Location: /importacoes');
    }

    private function processarLinha(array $dado): void
    {
        $cliente = $this->obterOuCriarCliente($dado[1], $dado[2]);
        if ($cliente) {
            $this->processarPedido($cliente, $dado[3], $dado[4], $dado[5]);
        }
    }

    private function obterOuCriarCliente(string $nome, string $email): ?Cliente
    {
        if (empty($nome) || empty($email)) {
            return null;
        }

        $cliente = Cliente::where('email', $email);
        if (!$cliente) {
            return Cliente::create([
                'nome' => $nome,
                'email' => $email,
                'telefone' => '',
                'endereco' => ''
            ]);
        }

        Cliente::update([
            'id' => $cliente[0]->id,
            'nome' => $nome
        ], ['nome']);

        return $cliente[0];
    }

    private function processarPedido( $cliente, string $produtoNome, string $data, float $valor): void
    {
        if (empty($produtoNome) || empty($data) || $valor <= 0) {
            return;
        }
      

        if ($this->pedidoExiste($cliente->id, $produtoNome, $data)) {
            return;
        }

        $produto = Produto::where('nome', $produtoNome);
        $pedido = Pedido::create([
            'cliente_id' => $cliente->id,
            'status' => 'pendente',
            'valor_total' => $valor
        ]);

        $pedido->data_pedido = $data;
        $pedido->save();

        if ($produto) {
            $this->criarItemPedido($pedido->id, $produto[0]->id, $valor);
            if ($data >= date('Y-m-d')) {
                $produto[0]->updateEstoque(-1);
            }
        } else {
            $produto = Produto::create([
                'nome' => $produtoNome,
                'estoque' => 0,
                'preco' => $valor,
            ]);
            $this->criarItemPedido($pedido->id, $produto->id, $valor);
        }
    }

    private function pedidoExiste(int $clienteId, string $produtoNome, string $data): bool
    {
        $query = '
            SELECT * FROM clientes c
            LEFT JOIN pedidos p ON c.id = p.cliente_id
            LEFT JOIN itens_pedido ip ON p.id = ip.pedido_id
            LEFT JOIN produtos pd ON pd.id = ip.produto_id
            WHERE c.id = :clienteId AND pd.nome = :produtoNome AND date(p.data_pedido) = :data
        ';
        $params = [
            'clienteId' => $clienteId,
            'produtoNome' => $produtoNome,
            'data' => $data
        ];
        return !empty(Connection::executeSql($query, $params));
    }

    private function criarItemPedido(int $pedidoId, int $produtoId, float $valor): void
    {
        ItemPedido::create([
            'pedido_id' => $pedidoId,
            'produto_id' => $produtoId,
            'quantidade' => 1,
            'preco_unitario' => $valor
        ]);
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