<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Excluir Promoção</h1>
    <p>Tem certeza que deseja excluir a promoção <strong><?= $promocao->nome ?></strong>?</p>
    <form action="/promocoes/<?= $promocao->id ?>" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <div class="flex justify-between items-center mt-4">
            <button type="submit" class="button bg-red-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-700">Excluir Promoção</button>
            <a href="/promocoes" class="button bg-gray-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-gray-700">Cancelar</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>
