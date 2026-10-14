<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - controlStoke</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">

    <div class="login-card">
        <div class="login-header">
            <div class="line"></div>
            <h2>LOGIN</h2>
            <div class="line"></div>
        </div>
        <p class="login-subtitle">Faça seu login</p>

        <form action="processa_login.php" method="POST">
            <div class="form-group">
                <label for="usuario">USUÁRIO</label>
                <div class="input-container">
                    <input type="text" id="usuario" name="usuario" placeholder="Digite seu usuário" required autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <label for="senha">SENHA</label>
                <div class="input-container">
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                    <i class="fa-regular fa-eye toggle-password" id="btn-toggle-password" title="Mostrar/Ocultar Senha"></i>
                </div>
            </div>

            <p class="login-register-text">
                Não possui cadastro? <a href="cadastro.php">Clique aqui!</a>
            </p>

            <button type="submit" class="btn-login-submit">ENTRAR</button>

            <p class="login-register-text">
                Voltar ao <a href="index.php">início!</a>
            </p>

        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('btn-toggle-password');
            const passwordInput = document.getElementById('senha');

            togglePassword.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>
</html>