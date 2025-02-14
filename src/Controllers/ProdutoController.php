<?php

namespace Src\Controllers;

use Exception;
use Src\Models\Produto;
use Src\Core\Request;

class ProdutoController
{
    public function index()
    {
        view('/produtos/index', [
            'produtos' => Produto::all()
        ]);
    }

    public function create(): void
    {
        view('/produtos/create', [
            'produtos' => Produto::all()
        ]);
    }


    public function new(Request $request): void
    {
        $post = $request->getAllParams();

        if (empty($post['nome']) || empty($post['preco']) || empty($post['estoque'])) {
            flash('produto_erro', 'Os campos nome, preço e estoque são obrigatórios.');
            header('Location: /produtos/create');
            exit;
        }

        try {
            $produto = Produto::create([
                'nome' => trim($post['nome']),
                'preco' => trim($post['preco']),
                'estoque' => trim($post['estoque'])
            ]);

            if ($produto) {
                flash('success', 'Produto cadastrado com sucesso!');
                header('Location: /produtos');
                exit;
            }
        } catch (Exception $e) {
            error_log('Erro ao cadastrar um produto: ' . $e->getMessage());
            flash('produto_erro', 'Erro ao cadastrar um produto Tente novamente.');
            header('Location: /produtos/create');
            exit;
        }
    }
    public function edit($id): void
    {
        $produto = Produto::find($id);

        if (!$produto) {
            flash('produto_erro', 'Produto não encontrado.');
            header('Location: /produtos');
            exit;
        }

        view('/produtos/edit', [
            'produto' => $produto
        ]);
    }

    public function deleteView($id): void
    {
        $produto = Produto::find($id);

        view('/produtos/delete', [
            'produto' => $produto
        ]);
    }

    public function delete($id): void
    {

        $produto = Produto::delete($id);

        if ($produto) {
            flash('success', 'Produto excluído com sucesso!');
            header('Location: /produtos');
            exit;
        }
    }

    public function update(Request $request): void
    {
        $post = $request->getAllParams();

        $produto = Produto::update([
            'id' => trim($post['id']),
            'nome' => trim($post['nome']),
            'preco' => trim($post['preco']),
            'estoque' => trim($post['estoque'])
        ]);

        if ($produto) {
            flash('success', 'Produto atualizado com sucesso!');
            header('Location: /produtos');
            exit;
        }
    }
}
