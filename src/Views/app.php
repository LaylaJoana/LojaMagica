<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="text-lg font-semibold">
                    <a href="#" class="text-gray-800">Loja Mágica</a>
                </div>
                <div>
                    <a href="/clientes" class="text-gray-800 hover:text-gray-600 px-3">Clientes</a>
                    <a href="/pedidos" class="text-gray-800 hover:text-gray-600 px-3">Pedidos</a>
                    <a href="/promocoes" class="text-gray-800 hover:text-gray-600 px-3">Promoções</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 mt-6">
        <?= $router->dispatch($request) ?>
    </div>

</body>
</html>