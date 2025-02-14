<?php
ob_start();
?>

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
                    <a href="/" class="text-white hover:text-gray-200">Loja Mágica</a>
                </div>
                <div>
                    <a href="/clientes" class="text-white hover:text-gray-200 px-4 py-2 rounded">Clientes</a>
                    <a href="/pedidos" class="text-white hover:text-gray-200 px-4 py-2 rounded">Pedidos</a>
                    <a href="/produtos" class="text-white hover:text-gray-200 px-4 py-2 rounded">Produtos</a>
                    <a href="/importacoes" class="text-white hover:text-gray-200 px-4 py-2 rounded">Importações</a>
                    <a href="/promocoes" class="text-white hover:text-gray-200 px-4 py-2 rounded">Promoções</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 mt-6 bg-white p-6 shadow-md rounded">
        <?php
        if (hasFlash('success')) {
        ?>
            <div role="alert" class="mb-4 relative flex w-full p-3 text-sm text-white bg-green-600 rounded-md">
                <?= flash('success'); ?>
                <button class="flex items-center justify-center transition-all w-8 h-8 rounded-md text-white hover:bg-white/10 active:bg-white/10 absolute top-1.5 right-1.5" type="button" onclick="closeAlert(this)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        <?php
        }
        ?>
        <?= $router->dispatch($request) ?>
    </div>


    <script>
        function closeAlert(button) {
            button.parentElement.style.display = 'none';
        }
    </script>

    <?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>


<?php
// Envie a saída do buffer
ob_end_flush();
?>