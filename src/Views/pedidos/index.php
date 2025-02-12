<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Pedidos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .status-verde {
            background-color: #d4edda;
            color: #155724;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }
    </style>
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
            <a href="/pedidos/create" class="button bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition">Cadastrar Pedido</a>
        </div>
        
        <div class="bg-white shadow-lg rounded-lg p-6">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-3 px-4 text-left">Id</th>
                        <th class="py-3 px-4 text-left">Cliente</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Valor</th>
                        <th class="py-3 px-4 text-left">Data </th> 
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
                        <td class="py-3 px-4 ">
                            <span class="status-verde"><?= $pedido->status ?></span>
                        </td>
                        <td class="py-3 px-4 "><?= $pedido->valor_total ?></td>
                        <td class="py-3 px-4 "><?= date('d/m/Y H:i', strtotime($pedido->data_pedido)) ?></td>
                        <td class="py-3 px-4 ">
                            <a href="/pedidos/edit/<?= $pedido->id ?>" class="text-blue-500 hover:text-blue-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13.5V17h3.5l9.5-9.5a2.121 2.121 0 00-3-3L9 13.5z" />
                                </svg>
                            </a>
                            <a href="/pedidos/deleteview/<?= $pedido->id ?>" class="text-red-500 hover:text-red-700 transition ml-2">
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
    
<?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>
