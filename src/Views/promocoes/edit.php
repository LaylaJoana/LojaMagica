<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Editar Promoção</h1>
    <form action="/promocoes/update" method="POST">
        <input type="hidden" name="id" value="<?= $promocao->id ?>">
        <div class="mb-6">
            <label for="nome" class="block text-gray-700">Nome:</label>
            <input type="text" name="nome" id="nome" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" value="<?= $promocao->nome ?>" required>
        </div>
        <div class="mb-6">
            <label for="desconto" class="block text-gray-700">Desconto (%):</label>
            <input type="number" name="desconto" id="desconto" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" value="<?= $promocao->desconto ?>" required>
        </div>
        <div class="mb-6">
            <label for="nome" class="block text-gray-700">Descrição:</label>
            <textarea name="descricao" id="descricao" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" required><?= $promocao->descricao ?></textarea>
        </div>
        <div class="mb-6">
            <label for="data_inicio" class="block text-gray-700">Data Início:</label>
            <input type="date" name="data_inicio" id="data_inicio" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" value="<?= $promocao->data_inicio ?>" required>
        </div>
        <div class="mb-6">
            <label for="data_fim" class="block text-gray-700">Data Fim:</label>
            <input type="date" name="data_fim" id="data_fim" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" value="<?= $promocao->data_fim ?>" required>
        </div>
        <div class="flex justify-between items-center mt-4">
            <button type="submit" class="button bg-green-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-green-700">Atualizar Promoção</button>
        </div>
    </form>
</div>
</body>
</html>
