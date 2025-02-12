<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Clientes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

if (hasFlash('cliente_sucesso')) {
?>
<div role="alert" class="mb-4 relative flex w-full p-3 text-sm text-white bg-green-600 rounded-md">
    <?= flash('cliente_sucesso'); ?>
    <button class="flex items-center justify-center transition-all w-8 h-8 rounded-md text-white hover:bg-white/10 active:bg-white/10 absolute top-1.5 right-1.5" type="button" onclick="closeAlert(this)">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
</div>
<?php
}
?>
<body class="bg-gray-100">
    <div class="max-w-6xl mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Clientes</h1>
            <a href="/clientes/create" class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition">Cadastrar Cliente</a>
        </div>
        
        <div class="bg-white shadow-lg rounded-lg p-6">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-3 px-4 text-left">Id</th>
                        <th class="py-3 px-4 text-left">Nome</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Endereço</th>
                        <th class="py-3 px-4 text-left">Criado Em</th>
                        <th class="py-3 px-4 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
            <?php if (empty($clientes)): ?>
                <tr>
                    <td colspan="6" class="py-3 px-4 border-b text-center">Nenhum cliente encontrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($clientes as $cliente): ?>
                    <tr class="border-b hover:bg-gray-100 transition">
                        <td class="py-3 px-4 "><?= $cliente->id ?></td>
                        <td class="py-3 px-4 "><?= $cliente->nome ?></td>
                        <td class="py-3 px-4 "><?= $cliente->email ?></td>
                        <td class="py-3 px-4 "><?= $cliente->endereco ?></td>
                        <td class="py-3 px-4 "><?= date('d/m/Y H:i', strtotime($cliente->criado_em)) ?></td>
                        <td class="py-3 px-4 ">
                            <a href="/clientes/edit/<?= $cliente->id ?>" class="text-blue-500 hover:text-blue-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13.5V17h3.5l9.5-9.5a2.121 2.121 0 00-3-3L9 13.5z" />
                                </svg>
                            </a>
                            <a href="/clientes/deleteview/<?= $cliente->id ?>" class="text-red-500 hover:text-red-700 transition ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
            </table>
        </div>
    </div>
    
    <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4">Opções</h2>
            <a href="/clientes/edit/<?= $cliente->id; ?>" class="bg-green-500 text-white px-4 py-2 rounded-lg w-full mb-2 hover:bg-green-600 transition">Editar</a>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg w-full mb-2 hover:bg-green-600 transition">Editar</button>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg w-full mb-2 hover:bg-green-600 transition">Deletar</button>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg w-full hover:bg-green-600 transition" onclick="closeModal()">Fechar</button>
        </div>
    </div>
    
    <script>
        function openModal(clienteId) {
            // Passar o ID do cliente para o modal, se necessário
            document.getElementById('modal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
</body>
</html>
