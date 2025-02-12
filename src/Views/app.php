<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/js/all.min.js"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-green-600 shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="text-lg font-semibold flex items-center">
                    <i class="fas fa-magic text-white mr-2"></i>
                    <a href="#" class="text-white hover:text-gray-200">Loja Mágica</a>
                </div>
                <div>
                    <a href="/clientes" class="text-white hover:text-gray-200 px-4 py-2 rounded">Clientes</a>
                    <a href="/pedidos" class="text-white hover:text-gray-200 px-4 py-2 rounded">Pedidos</a>
                    <a href="/produtos" class="text-white hover:text-gray-200 px-4 py-2 rounded">Produtos</a>
                    <a href="/importacoes" class="text-white hover:text-gray-200 px-4 py-2 rounded">Importacoes</a>
                    <a href="/promocoes" class="text-white hover:text-gray-200 px-4 py-2 rounded">Promoções</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 mt-6 bg-white p-6 shadow-md rounded">
        <?= $router->dispatch($request) ?>
    </div>

</body>
</html>
