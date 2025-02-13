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
<h1 class="text-2xl font-bold mb-4">Editar Cliente</h1>
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
                <input type="tel" id="telefone" name="telefone" class="w-full bg-transparent text-sm text-gray-700 border border-slate-200 rounded p-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm" value="<?= preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $cliente->telefone) ?>" required oninput="validateTelefone()">
                <p id="telefone-error" class="text-red-600 text-xs hidden">Por favor, insira um telefone válido.</p>
            </div>
            <script>
                function validateTelefone() {
                    const telefone = document.getElementById('telefone').value;
                    const telefonePattern = /^\(\d{2}\) \d{5}-\d{4}$/;
                    const telefoneError = document.getElementById('telefone-error');
                    if (!telefone.match(telefonePattern)) {
                        telefoneError.classList.remove('hidden');
                    } else {
                        telefoneError.classList.add('hidden');
                    }
                }

                document.getElementById('telefone').addEventListener('input', function (e) {
                    let x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
                    e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
                });
            </script>

            <div class="flex justify-between items-center mt-4">
            <button type="submit" class="button bg-green-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-green-700">Salvar Alterações</button>
        </div>
        </form>
    </div>
</body>
</html>