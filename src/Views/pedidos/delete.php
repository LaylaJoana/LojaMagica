
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Excluir Pedido</h1>
    <div class="bg-white shadow-lg rounded-lg p-6">
        <p class="mb-4">Tem certeza de que deseja excluir o pedido do cliente <strong><?= $cliente->nome ?></strong>?</p>
        <form action="/pedidos/delete/<?= $pedido->id ?>" method="POST">
            <div class="flex justify-end">
                <a href="/pedidos/delete/<?= $pedido->id ?>" class="button bg-red-600 text-white py-2 px-6 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300" onclick="return confirmDelete();">Deletar</a>
                <a href="/pedidos" class="button bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition mr-2">Cancelar</a>
            </div>
        </form>
    </div>
</div>
