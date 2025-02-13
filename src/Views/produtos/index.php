
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Produtos</h1>
        <a href="/produtos/create" class="button bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition">Novo Produto</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 text-left">ID</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-left">Nome</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-left">Preço</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-left">Estoque</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-left">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200"><?= $produto->id ?></td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= $produto->nome ?></td>
                        <td class="py-2 px-4 border-b border-gray-200">R$ <?= number_format($produto->preco, 2, ',', '.') ?></td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= $produto->estoque ?></td>

                        <td class="py-3 px-4 ">
                        <a href="/produtos/edit/<?= $produto->id ?>" class="text-blue-500 hover:text-blue-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13.5V17h3.5l9.5-9.5a2.121 2.121 0 00-3-3L9 13.5z" />
                            </svg>
                        </a>
                        <a href="/produtos/deleteview/<?= $produto->id ?>" class="text-red-500 hover:text-red-700 transition ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</body>
</html>
