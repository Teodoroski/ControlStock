<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
    <form class="" method="POST" action="exibeLogin.php">

        <div class="form-group">
            <label for="usuarioLogin" class="form-label">Código Funcionário </label>
            <input type="text" id="usuarioLogin" name="usuarioLogin" class="form-control" placeholder="Digite seu código de funcionario" required>
        </div>

        <div class="form-group">
            <label for="loginSenha" class="form-label">Senha</label>
            <input type="password" id="loginSenha" name="loginSenha" class="form-control" placeholder="Digite sua senha" required>
            <!-- <span class="password-toggle" onclick="togglePassword()"> (precisa de javaScript para funcionar)
                <i class="fas fa-eye-slash"></i>
            </span> -->
        </div>

        <button type="submit" class="btn btn-primary">Entrar</button>

        <div class="form-footer">
            <p>Não possui conta? <a href="cadastro.html">Cadastre-se</a></p>
            <p><a href="index.php">Voltar à página inicial</a></p>
        </div>
    </form>
    
</body>
</html>