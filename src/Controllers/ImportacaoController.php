<?php

namespace Src\Controllers;

use Exception;
use Src\Core\Request;
use Src\Core\Router;
use Src\Models\Importacao;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportacaoController {
    
    public function index(): void
    {
        view('/importacoes/index', [
            'importacoes' => Importacao::all()
        ]);
    }

    public function importarXLS(Request $request): void
    {
        if ($_FILES['arquivo']['type'] !== 'application/vnd.ms-excel') {
            throw new Exception('Formato de arquivo não suportado. Apenas arquivos XLS são permitidos.');
        }

        $filePath = $_FILES['arquivo']['tmp_name'];
        $fileName = $_FILES['arquivo']['name'];
        $tamanho = $_FILES['arquivo']['size'];
        $type = $_FILES['arquivo']['type'];
        $dados = file_get_contents($filePath);

        $importacao = Importacao::create([
            'arquivo' => $fileName,
            'tipo' => $type,
            'tamanho' => $tamanho,
            'dados' => $dados,
            'data_importacao' => date('Y-m-d H:i:s')
        ]);

        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $clientes = [];
        $pedidos = [];

        foreach ($rows as $row) {
            $clienteId = $row[0];
            $clienteNome = $row[1];
            $clienteEmail = $row[2];
            $pedidoProduto = $row[4];
            $pedidoData = $row[5];
            $pedidoValor = $row[6];

            $clientes[] = [
                'id' => $clienteId,
                'nome' => $clienteNome,
                'email' => $clienteEmail
            ];

            $pedidos[] = [
                'produto' => $pedidoProduto,
                'data' => $pedidoData,
                'valor' => $pedidoValor
            ];
        }
    
        print_r($clientes);
        print_r($pedidos);

        header('Location: /importacoes');
    }

    public function download($id): void
    {
        $importacao = Importacao::find($id);
        if (!$importacao) {
            throw new Exception('Arquivo não encontrado.');
        }
        exit;
    }
}