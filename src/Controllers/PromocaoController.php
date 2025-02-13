<?php

namespace Src\Controllers;

use Exception;
use Src\Models\Promocao;
use Src\Core\Request;
use Src\Models\Cliente;
use Src\Core\Email;

class PromocaoController
{

    public function index()
    {
        view('/promocoes/index', [
            'promocoes' => Promocao::all()
        ]);
    }

    public function create(): void
    {
        view('/promocoes/create', [
            'promocoes' => Promocao::all()
        ]);
    }


    public function new(Request $request): void
    {
        $post = $request->getAllParams();

        try {
            $promocao = Promocao::create([
                'nome' => trim($post['nome']),
                'descricao' => trim($post['descricao']),
                'desconto' => $post['desconto'],
                'data_inicio' => trim($post['data_inicio']),
                'data_fim' => trim($post['data_fim'])
            ]);
            if ($promocao) {

                $clientes = Cliente::all();
                foreach ($clientes as $cliente) {
                    $subject = 'Novidades e Promoções - Loja Mágica';
                    $body = 'Olá ' . $cliente->nome . ',<br><br>' .
                        'Temos uma nova promoção para você!<br>' .
                        'Nome: ' . $promocao->nome . '<br>' .
                        'Descrição: ' . $promocao->descricao . '<br>' .
                        'Desconto: ' . $promocao->desconto . '%<br>' .
                        'Data de Início: ' . $promocao->data_inicio . '<br>' .
                        'Data de Fim: ' . $promocao->data_fim . '<br><br>' .
                        'Obrigado por comprar na Loja Mágica!';
                    $emailSent = Email::send($cliente->email, $subject, $body);

                    if ($emailSent) {
                        flash('email_sucesso', 'Email enviado com sucesso!');
                    } else {
                        flash('email_erro', 'Erro ao enviar email.');
                    }
                }

                flash('promocao_sucesso', 'Promoção cadastrada com sucesso e emails enviados!');
                header('Location: /promocoes');
                exit;
            }
        } catch (Exception $e) {
            error_log('Erro ao cadastrar uma Promoção: ' . $e->getMessage());
            flash('promocao_erro', 'Erro ao cadastrar uma Promoção.');
            header('Location: /promocoes/create');
            exit;
        }
    }
    public function edit($id): void
    {
        $promocao = Promocao::find($id);

        if (!$promocao) {
            flash('promocao_erro', 'Promoção não encontrado.');
            header('Location: /promocoes');
            exit;
        }

        view('/promocoes/edit', [
            'promocao' => $promocao
        ]);
    }

    public function deleteView($id): void
    {
        $promocao = Promocao::find($id);

        view('/promocoes/delete', [
            'promocao' => $promocao
        ]);
    }

    public function delete($id): void
    {

        $produto = Promocao::delete($id);

        if ($produto) {
            flash('promocao_sucesso', 'Promoção excluída com sucesso!');
            header('Location: /promocoes');
            exit;
        }
    }

    public function update(): void
    {
        $promocao = Promocao::update($_POST);

        if ($promocao) {

            $clientes = Cliente::all();
            foreach ($clientes as $cliente) {
                $subject = 'Novidades e Promoções - Loja Mágica';
                $body = 'Olá ' . $cliente->nome . ',<br><br>' .
                    'A promoção'. $promocao->nome. 'mudou, fique por dentro  do que mudou!<br>' .
                    'Nome: ' . $promocao->nome . '<br>' .
                    'Descrição: ' . $promocao->descricao . '<br>' .
                    'Desconto: ' . $promocao->desconto . '%<br>' .
                    'Data de Início: ' . $promocao->data_inicio . '<br>' .
                    'Data de Fim: ' . $promocao->data_fim . '<br><br>' .
                    'Obrigado por comprar na Loja Mágica!';
                $emailSent = Email::send($cliente->email, $subject, $body);

                if ($emailSent) {
                    flash('email_sucesso', 'Email enviado com sucesso!');
                } else {
                    flash('email_erro', 'Erro ao enviar email.');
                }
            }
            flash('promocao_sucesso', 'Promoção atualizada com sucesso!');
            header('Location: /promocoes');
            exit;
        }
    }
}