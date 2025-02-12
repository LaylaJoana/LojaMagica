
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Editar Pedido</h1>
    <form action="/pedidos/update" method="POST">
        <input type="hidden" name="id" value="<?= $pedido->id ?>">
        <input type="hidden" id="total-input" name="valor_total" value="0.00">
        <div class="mb-6">
            <div class="p-4 border rounded-lg bg-gray-50">
                <label for="cliente" class="block text-gray-700">Cliente:</label>
                <select name="cliente_id" id="cliente" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" required>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?= $cliente->id ?>" <?= $cliente->id == $pedido->cliente_id ? 'selected' : '' ?>><?= $cliente->nome ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="mb-6">
            <div class="p-4 border rounded-lg bg-gray-50">
                <label for="status" class="block text-gray-700">Status:</label>
                <select name="status" id="status" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" required>
                    <option value="pendente" <?= $pedido->status == 'pendente' ? 'selected' : '' ?>>Pendente</option>
                    <option value="enviado" <?= $pedido->status == 'enviado' ? 'selected' : '' ?>>Enviado</option>
                    <option value="concluido" <?= $pedido->status == 'concluido' ? 'selected' : '' ?>>Concluído</option>
                    <option value="cancelado" <?= $pedido->status == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                </select>
            </div>
        </div>

        <div class="mb-6">
            <div class="p-4 border rounded-lg bg-gray-50">
                <label for="cliente" class="block text-gray-700">Produtos:</label>
                <select id="product-select" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                    <option value="">Selecione um produto</option>
                    <?php foreach ($produtos as $produto): ?>
                        <option value="<?= $produto->id ?>" data-price="<?= $produto->preco ?>"><?= $produto->nome ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="mb-6">
            <div id="product-list" class="p-4 border rounded-lg bg-gray-50">
                <label for="cliente" class="block text-gray-700">Produtos Selecionados:</label>
                <?php foreach ($itens as $item): ?>
                    <div class="product-row flex items-center mb-2" id="product-row-<?= $item->produto_id ?>">
                        <span class="product-name w-1/3"><?= $item->produto()->nome ?></span>
                        <span class="product-price w-1/3">R$ <?= number_format($item->preco_unitario, 2, ',', '.') ?></span>
                        <input type="number" name="produtos[<?= $item->produto_id ?>]" class="product-quantity w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" value="<?= $item->quantidade ?>" min="1" onchange="updateTotal()">
                        <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-2 py-1 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 mx-auto ml-2 h-8 flex items-center justify-center" onclick="removeProduct(<?= $item->produto_id ?>)">X</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="flex justify-between items-center mt-4">
            <button type="submit" class="button bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700">Salvar Alterações</button>
            <h3 class="text-lg font-semibold">Total: R$ <span id="total-value">0.00</span></h3>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
