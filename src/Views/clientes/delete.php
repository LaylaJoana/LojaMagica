<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function confirmDelete() {
            return confirm('Tem certeza de que deseja deletar este cliente? os pedidos dele serão removidos juntos e esta ação não pode ser desfeita.');
        }
    </script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4 text-center text-green-600">Deletar Cliente</h1>
        <form action="" method="POST" onsubmit="return confirmDelete();">
            <p class="text-gray-700 text-center mb-6">Tem certeza de que deseja deletar o cliente <strong><?= $cliente->nome ?></strong>?</p>

            <div class="flex justify-center mt-4">
                <a href="/clientes/delete/<?= $cliente->id ?>" class="bg-red-600 text-white py-2 px-6 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300" onclick="return confirmDelete();">Deletar</a>
                <a href="/clientes" class="ml-4 bg-gray-600 text-white py-2 px-6 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>