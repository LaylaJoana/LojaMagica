<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Importações</h1>
    <form action="/importacoes/upload" method="POST" enctype="multipart/form-data" class="mb-4">
        <input type="file" name="arquivo" class="mb-2" accept=".xls,.xlsx">
        <button type="submit" class="button bg-green-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-green-700">Importar</button>
    </form>
    
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-200 text-left">ID</th>
                <th class="py-2 px-4 border-b border-gray-200 text-left">Nome do Arquivo</th>
                <th class="py-2 px-4 border-b border-gray-200 text-left">Tipo</th>
                <th class="py-2 px-4 border-b border-gray-200 text-left">Data de Criação</th>
                <th class="py-2 px-4 border-b border-gray-200 text-left">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($importacoes as $importacao): ?>
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200"><?= $importacao->id ?></td>
                    <td class="py-2 px-4 border-b border-gray-200"><?= $importacao->arquivo ?></td>
                    <td class="py-2 px-4 border-b border-gray-200"><?= $importacao->tipo ?></td>
                    <td class="py-2 px-4 border-b border-gray-200"><?= $importacao->data_importacao ?></td>
                    <td class="py-2 px-4 border-b border-gray-200">
                        <a href="/importacoes/download/<?= $importacao->id ?>" class="text-blue-500 hover:text-blue-700 flex items-center">
                            <i class="fas fa-download mr-2"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
