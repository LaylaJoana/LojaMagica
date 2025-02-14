<?php

namespace Src\Controllers;

use Exception;
use Src\Core\Request;
use Src\Core\Router;
use Src\Models\Cliente;

class ClienteController
{

    public function index(): void
    {
        view('/clientes/index', [
            'clientes' => Cliente::all()
        ]);
    }

    public function create(): void
    {
        view('/clientes/create');
    }

    public function new(Request $request): void
    {
        $post = $request->getAllParams();

        if (empty($post['nome']) || empty($post['email'])) {
            flash('cliente_erro', 'Os campos nome e email são obrigatórios.');
            header('Location: /clientes/create');
            exit;
        }

        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            flash('cliente_erro', 'E-mail inválido.');
            header('Location: /clientes/create');
            exit;
        }

        try {
            $cliente = Cliente::create([
                'tipo' => trim($post['tipo']),
                'nome' => trim($post['nome']),
                'email' => trim($post['email']),
                'endereco' => trim($post['endereco']),
                'telefone' => trim($post['telefone']),
                'receber_emails' => isset($post['receber_emails']) ? 'S' : 'N'
            ]);

            if ($cliente) {
                flash('success', 'Cliente cadastrado com sucesso!');
                header('Location: /clientes');
                exit;
            }

            flash('cliente_erro', 'Erro ao cadastrar cliente.');
            header('Location: /clientes/create');
            exit;
        } catch (Exception $e) {
            error_log('Erro ao cadastrar cliente: ' . $e->getMessage());
            flash('cliente_erro', 'Erro ao cadastrar o cliente. Tente novamente.');
            header('Location: /clientes/create');
            exit;
        }
    }

    public function edit($id): void
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            flash('cliente_erro', 'Cliente não encontrado.');
            header('Location: /clientes');
            exit;
        }

        view('/clientes/edit', [
            'cliente' => $cliente
        ]);
    }

    public function deleteView($id): void
    {
        $cliente = Cliente::find($id);

        view('/clientes/delete', [
            'cliente' => $cliente
        ]);
    }

    public function delete($id): void
    {

        $cliente = Cliente::delete($id);

        if ($cliente) {
            flash('success', 'Cliente excluído com sucesso!');
            header('Location: /clientes');
            exit;
        }
    }

    public function update(Request $request): void
    {
        $post = $request->getAllParams();
        
        $cliente = Cliente::update([
            'id' => $post['id'],
            'tipo' => trim($post['tipo']),
            'nome' => trim($post['nome']),
            'email' => trim($post['email']),
            'endereco' => trim($post['endereco']),
            'telefone' => trim($post['telefone']),
            'receber_emails' => isset($post['receber_emails']) ? 'S' : 'N'
        ]);

        if ($cliente) {
            flash('success', 'Cliente atualizado com sucesso!');
            header('Location: /clientes');
            exit;
        }
    }
}
