
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Excluir Promoção</h1>
    <p>Tem certeza que deseja excluir a promoção <strong><?= $promocao->nome ?></strong>?</p>
    <form action="/promocoes/delete/<?= $promocao->id ?>" method="POST">
            <div class="flex justify-end">
                <a href="/promocoes/delete/<?= $promocao->id ?>" class="button bg-red-600 text-white py-2 px-6 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300" onclick="return confirmDelete();">Deletar</a>
                <a href="/promocoes" class="button bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition mr-2">Cancelar</a>
            </div>
        </form>
</div>
</body>
</html>
