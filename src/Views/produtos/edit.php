
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Editar Produto</h1>
    <form action="/produtos/update" method="POST">
        <input type="hidden" name="id" value=<?= $produto->id ?>>
        <div class="mb-6">
            <label for="nome" class="block text-gray-700">Nome:</label>
            <input type="text" name="nome" id="nome" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" value="<?= $produto->nome ?>" required>
        </div>
        <div class="mb-6">
            <label for="preco" class="block text-gray-700">Preço:</label>
            <input type="text" name="preco" id="preco" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" value="<?= $produto->preco ?>" required>
        </div>
        <div class="mb-6">
            <label for="preco" class="block text-gray-700">Estoque:</label>
            <input type="text" name="estoque" id="estoque" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" value="<?= $produto->estoque ?>" required>
        </div>
        <div class="flex justify-between items-center mt-4">
            <button type="submit" class="button bg-green-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-green-700">Atualizar Produto</button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>
