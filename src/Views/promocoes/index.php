
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
<div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Promoções</h1>
        <a href="/promocoes/create" class="button bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition">Nova Promoção</a>
    </div>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-200">ID</th>
                <th class="py-2 px-4 border-b border-gray-200">Nome</th>
                <th class="py-2 px-4 border-b border-gray-200">Desconto</th>
                <th class="py-2 px-4 border-b border-gray-200">Descrição</th>
                <th class="py-2 px-4 border-b border-gray-200">Data Início Promoção</th>
                <th class="py-2 px-4 border-b border-gray-200">Data Fim Promoção</th>
                <th class="py-2 px-4 border-b border-gray-200">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($promocoes as $promocao): ?>
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200"><?= $promocao->id ?></td>
                    <td class="py-2 px-4 border-b border-gray-200"><?= $promocao->nome ?></td>
                    <td class="py-2 px-4 border-b border-gray-200"><?= $promocao->desconto ?>%</td>
                    <td class="py-2 px-4 border-b border-gray-200"><?= $promocao->descricao ?></td>
                    <td class="py-3 px-4 "><?= date('d/m/Y H:i', strtotime($promocao->data_inicio)) ?></td>
                    <td class="py-3 px-4 "><?= date('d/m/Y H:i', strtotime($promocao->data_fim)) ?></td>

                    <td class="py-3 px-4 ">
                        <a href="/promocoes/edit/<?= $promocao->id ?>" class="text-blue-500 hover:text-blue-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13.5V17h3.5l9.5-9.5a2.121 2.121 0 00-3-3L9 13.5z" />
                            </svg>
                        </a>
                        <a href="/promocoes/deleteview/<?= $promocao->id ?>" class="text-red-500 hover:text-red-700 transition ml-2">
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

<?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>
