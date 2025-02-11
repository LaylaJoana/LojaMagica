<?php
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

<div class="container mx-auto px-4 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold text-gray-800">Pedidos</h1>
        <a href="/pedidos/create" class="bg-blue-500 text-white px-4 py-2 rounded">Cadastrar Pedido</a>
    </div>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b text-left">Id</th>
                <th class="py-2 px-4 border-b text-left">Cliente</th>
                <th class="py-2 px-4 border-b text-left">Status</th>
                <th class="py-2 px-4 border-b text-left">Data do Pedido</th>
                <th class="py-2 px-4 border-b text-left">Edição</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($pedidos)): ?>
                <tr>
                    <td colspan="5" class="py-2 px-4 border-b text-center">Nenhum pedido encontrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?= $pedido->id ?></td>
                        <td class="py-2 px-4 border-b"><?= $pedido->cliente()->nome ?></td>
                        <td class="py-2 px-4 border-b"><?= $pedido->status ?></td>
                        <td class="py-2 px-4 border-b"><?= date('d/m/Y H:i', strtotime($pedido->data_pedido)) ?></td>
                        <td class="py-2 px-4 border-b">
                            <button class="bg-blue-500 text-white px-2 py-1 rounded" onclick="openModal()">Opções</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-4 rounded shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Opções</h2>
        <button class="bg-green-500 text-white px-4 py-2 rounded mb-2 w-full">Visualizar</button>
        <button class="bg-yellow-500 text-white px-4 py-2 rounded mb-2 w-full">Editar</button>
        <button class="bg-red-500 text-white px-4 py-2 rounded w-full">Deletar</button>
        <button class="mt-4 bg-gray-500 text-white px-4 py-2 rounded w-full" onclick="closeModal()">Fechar</button>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
function closeAlert(button) {
    button.parentElement.style.display = 'none';
}
</script>