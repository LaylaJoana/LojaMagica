
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Cadastrar Pedido</h1>
    <form action="/pedidos/store" method="POST">
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Cliente</h2>
            <div class="p-4 border rounded-lg bg-green-200">
                <label for="cliente" class="block text-gray-700">Cliente:</label>
                <select name="cliente_id" id="cliente" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" required>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?= $cliente->id ?>"><?= $cliente->nome ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Adicionar Produtos</h2>
            <div class="p-4 border rounded-lg bg-green-200">
                <select id="product-select" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                    <option value="">Selecione um produto</option>
                    <?php foreach ($produtos as $produto): ?>
                        <option value="<?= $produto->id ?>" data-price="<?= $produto->preco ?>"><?= $produto->nome ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Produtos Selecionados</h2>
            <div id="product-list" class="p-4 border rounded-lg bg-green-200">
            </div>
        </div>

        <div class="flex justify-between items-center mt-4">
            <button type="submit" class="button bg-green-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-green-700">Confirmar Pedido</button>
            <h3 class="text-lg font-semibold">Total: R$ <span id="total-value">0.00</span></h3>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

<script>
    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.product-row').forEach(row => {
            const price = parseFloat(row.querySelector('.product-price').innerText.replace('R$ ', '').replace(',', '.'));
            const quantity = parseInt(row.querySelector('.product-quantity').value);
            total += price * quantity;
        });
        document.getElementById('total-value').innerText = total.toFixed(2).replace('.', ',');
    }

    function addProduct() {
        const productSelect = document.getElementById('product-select');
        const selectedProduct = productSelect.options[productSelect.selectedIndex];
        const productId = selectedProduct.value;
        const productName = selectedProduct.text;
        const productPrice = selectedProduct.getAttribute('data-price').replace('.', ',');

        if (productId === '') return;

        // Check if product is already added
        if (document.getElementById(`product-row-${productId}`)) {
            alert('Produto já adicionado.');
            return;
        }

        const productRow = document.createElement('div');
        productRow.className = 'product-row flex items-center mb-2';
        productRow.id = `product-row-${productId}`;
        productRow.innerHTML = `
            <span class="product-name w-1/3">${productName}</span>
            <span class="product-price w-1/3">R$ ${productPrice}</span>
            <input type="number" name="produtos[${productId}]" class="product-quantity w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" value="1" min="1" onchange="updateTotal()">
            <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-2 py-1 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 mx-auto ml-2 h-8 flex items-center justify-center" onclick="removeProduct(${productId})">X</button>
        `;
        document.getElementById('product-list').appendChild(productRow);
        updateTotal();
    }

    function removeProduct(productId) {
        const productRow = document.getElementById(`product-row-${productId}`);
        if (productRow) {
            productRow.remove();
            updateTotal();
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('product-select').addEventListener('change', addProduct);
    });
</script>
</body>
</html>
