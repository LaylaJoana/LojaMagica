<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Pedidos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

if (hasFlash('pedido_sucesso')) {
?>
<div role="alert" class="mb-4 relative flex w-full p-3 text-sm text-white bg-green-600 rounded-md">
    <?= flash('pedido_sucesso'); ?>
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
            <h1 class="text-3xl font-bold text-gray-800">Pedidos</h1>
            <a href="/pedidos/create" class="bg-green-500 text-white px-5 py-2 rounded-lg shadow-md hover:bg-green-600 transition">Cadastrar Pedido</a>
        </div>
        
        <div class="bg-white shadow-lg rounded-lg p-6">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-3 px-4 text-left">Id</th>
                        <th class="py-3 px-4 text-left">Cliente</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Data do Pedido</th>
                        <th class="py-3 px-4 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
            <?php if (empty($pedidos)): ?>
                <tr>
                    <td colspan="5" class="py-3 px-4 border-b text-center">Nenhum pedido encontrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr class="border-b hover:bg-gray-100 transition">
                        <td class="py-3 px-4 "><?= $pedido->id ?></td>
                        <td class="py-3 px-4 "><?= $pedido->cliente()->nome ?></td>
                        <td class="py-3 px-4 "><?= $pedido->status ?></td>
                        <td class="py-3 px-4 "><?= date('d/m/Y H:i', strtotime($pedido->data_pedido)) ?></td>
                        <td class="py-3 px-4 ">
                            <button class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition" onclick="openModal()">Opções</button>
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
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg w-full mb-2 hover:bg-green-600 transition">Visualizar</button>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg w-full mb-2 hover:bg-green-600 transition">Editar</button>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg w-full mb-2 hover:bg-green-600 transition">Deletar</button>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg w-full hover:bg-green-600 transition" onclick="closeModal()">Fechar</button>
        </div>
    </div>
    
    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
</body>
</html>
