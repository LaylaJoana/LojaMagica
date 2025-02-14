<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Cadastrar Cliente</h1>
        <form action="/clientes/new" method="POST">
            <div class="mb-6">
                <label for="tipo" class="block text-gray-700 text-sm font-semibold mb-2">Tipo:</label>
                <select name="tipo" id="tipo" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" required>
                    <option value="PF">Pessoa Física</option>
                    <option value="PJ">Pessoa Jurídica</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="nome" class="block text-gray-700 text-sm font-semibold mb-2">Nome:</label>
                <input type="text" id="nome" name="nome" class="w-full bg-transparent text-sm text-gray-700 border border-slate-200 rounded p-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm" required>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email:</label>
                <input type="email" id="email" name="email" class="w-full bg-transparent text-sm text-gray-700 border border-slate-200 rounded p-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm" oninput="validateEmail()" required>
                <p id="email-error" class="text-red-600 text-xs hidden">Por favor, insira um e-mail válido.</p>
            </div>

            <div class="mb-6">
                <label for="endereco" class="block text-gray-700 text-sm font-semibold mb-2">Endereço:</label>
                <input type="text" id="endereco" name="endereco" class="w-full bg-transparent text-sm text-gray-700 border border-slate-200 rounded p-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm" required>
            </div>

            <div class="mb-6">
                <label for="telefone" class="block text-gray-700 text-sm font-semibold mb-2">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" class="w-full bg-transparent text-sm text-gray-700 border border-slate-200 rounded p-3 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm" oninput="validatePhone()" required>
                <p id="phone-error" class="text-red-600 text-xs hidden">Por favor, insira um telefone válido.</p>
            </div>

            <div class="mb-6">
                <label for="receber_emails" class="block text-gray-700 text-sm font-semibold mb-2">
                    <input type="checkbox" id="receber_emails" name="receber_emails" class="mr-2">
                    Desejo receber emails de promoções
                </label>
            </div>

            <div class="flex justify-between items-center mt-4">
                <button type="submit" class="button bg-green-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-green-700">Cadastrar Cliente</button>
            </div>
    </div>
    </form>
    </div>

    <script>
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

        function validatePhone() {
            const phone = document.getElementById('telefone').value;
            const phonePattern = /^\(\d{2}\) \d{4,5}-\d{4}$/;
            const phoneError = document.getElementById('phone-error');
            if (!phone.match(phonePattern)) {
                phoneError.classList.remove('hidden');
            } else {
                phoneError.classList.add('hidden');
            }
        }

        document.getElementById('telefone').addEventListener('input', function(e) {
            let x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
            e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
        });
    </script>
</body>

</html>