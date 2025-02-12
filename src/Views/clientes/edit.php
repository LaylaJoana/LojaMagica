<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        // Validação simples de e-mail
        function validateEmail() {
            const email = document.getElementById('email').value;
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            const emailError = document.getElementById('email-error');
            if (!email.match(emailPattern)) {
                emailError.classList.remove('hidden');
            } else {
                emailError.classList.add('hidden');
            }
        }
    </script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4 text-center text-green-600">Editar Cliente</h1>
        <form action="/clientes/update" method="POST">
            <input type="hidden" id="id" name="id" value="<?= $cliente->id ?>">

            <div class="mb-6">
                <label for="nome" class="block text-gray-700 text-sm font-semibold mb-2">Nome:</label>
                <input type="text" id="nome" name="nome" class="w-full bg-transparent text-sm text-gray-700 border border-slate-200 rounded p-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm" value="<?= $cliente->nome ?>" required>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email:</label>
                <input type="email" id="email" name="email" class="w-full bg-transparent text-sm text-gray-700 border border-slate-200 rounded p-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm" value="<?= $cliente->email ?>" oninput="validateEmail()" required>
                <p id="email-error" class="text-red-600 text-xs hidden">Por favor, insira um e-mail válido.</p>
            </div>

            <div class="mb-6">
                <label for="endereco" class="block text-gray-700 text-sm font-semibold mb-2">Endereço:</label>
                <input type="text" id="endereco" name="endereco" class="w-full bg-transparent text-sm text-gray-700 border border-slate-200 rounded p-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm" value="<?= $cliente->endereco ?>" required>
            </div>

            <div class="mb-6">
                <label for="telefone" class="block text-gray-700 text-sm font-semibold mb-2">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" class="w-full bg-transparent text-sm text-gray-700 border border-slate-200 rounded p-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm" value="<?= $cliente->telefone ?>" required>
            </div>

            <div class="flex justify-center mt-4">
                <button type="submit" class="bg-green-600 text-white py-2 px-6 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">Salvar Alterações</button>
            </div>
        </form>
    </div>
</body>
</html>