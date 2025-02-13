
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Cadastrar Produto</h1>
    <form action="/produtos/new" method="POST">
        <div class="mb-6">
            <label for="nome" class="block text-gray-700">Nome:</label>
            <input type="text" name="nome" id="nome" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" required>
        <div class="mb-6">
            <label for="preco" class="block text-gray-700">Preço:</label>
            <input type="text" name="preco" id="preco" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" required>
        <div class="mb-6">
            <label for="estoque" class="block text-gray-700">Estoque:</label>
            <input type="text" name="estoque" id="estoque" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" required>
        </div>
        <div class="flex justify-between items-center mt-4">
            <button type="submit" class="button bg-green-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-green-700">Cadastrar Produto</button>
        </div>
    </form>
</div>
</body>
<script>
            document.addEventListener('DOMContentLoaded', function() {
            var precoInput = document.getElementById('preco');
            precoInput.addEventListener('input', function(e) {
                var value = e.target.value;
                value = value.replace(/\D/g, '');
                value = (value / 100).toFixed(2) + '';
                value = value.replace('.', ',');
                value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
                e.target.value = value;
            });
            });
        </script>
</html>
