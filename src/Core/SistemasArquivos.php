<?php

namespace Src\Core;

class SistemasArquivos
{

    protected $storage = __DIR__ . '/../../storage/';
    protected $tiposPermitidos = [
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' // XLSX
    ];

    public function salvarArquivo($caminho, $arquivo): string
    {
        $this->validarTipoArquivo($arquivo['type']);

        $diretorio = $this->storage . $caminho;

        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        $filePath = $diretorio . '/' . basename($arquivo['name']);

        $fileInfo = pathinfo($filePath);
        $counter = 1;
        while (file_exists($filePath)) {
            $filePath = $diretorio . '/' . $fileInfo['filename'] . '_' . $counter . '.' . $fileInfo['extension'];
            $counter++;
        }

        if (!move_uploaded_file($arquivo['tmp_name'], $filePath)) {
            throw new \Exception('Falha ao mover o arquivo para o diretório de destino.');
        }

        return $filePath;
    }

    public function validarTipoArquivo($tipo): void
    {
        if (!in_array($tipo, $this->tiposPermitidos)) {
            flash('importacao_erro', 'Formato de arquivo não suportado. Apenas arquivos XLSX são permitidos.');
            header('Location: /importacoes');
        }
    }

    public function downloadArquivo($filePath): void
    {
        $filePath = $this->storage . $filePath;

        if (!file_exists($filePath)) {
            throw new \Exception('Arquivo não encontrado.');
        }

        if (!is_file($filePath)) {
            throw new \Exception('O caminho especificado não é um arquivo válido.');
        }

        $fileInfo = pathinfo($filePath);
        $fileName = $fileInfo['basename'];

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        flush();

        if (ob_get_level()) {
            ob_end_clean();
        }
        
        readfile($filePath);
        exit;
    }
}
