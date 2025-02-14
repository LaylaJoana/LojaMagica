<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo à Loja Mágica Tecnologia</title>
    <style>
        .login-form {
            max-width: 300px;
            margin: 0 auto;
            padding: 1em;
            border: 1px solid #ccc;
            border-radius: 1em;
        }
        .login-form div {
            margin-bottom: 1em;
        }
        .login-form label {
            margin-bottom: .5em;
            color: #333333;
        }
        .login-form input {
            border: 1px solid #ccc;
            padding: .5em;
            font-size: 1em;
            width: 100%;
            box-sizing: border-box;
        }
        .login-form button {
            padding: 0.7em;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 1em;
            cursor: pointer;
            width: 100%;
        }
        .login-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo à Loja Mágica Tecnologia</h1>
        <p>Explore nossos produtos e promoções!</p>
        
        <div class="login-form">
            <form action="login.php" method="post">
                <div>
                    <label for="username">Usuário:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div>
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <button type="submit">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>