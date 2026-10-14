<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - controlStoke</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">

    <div class="login-card">
        <div class="login-header">
            <div class="line"></div>
            <h2>CADASTRO</h2>
            <div class="line"></div>
        </div>
        <p class="login-subtitle">Faça seu cadastro</p>

        <form action="cadastraUsuario.php" method="POST">
            
            <div class="form-group">
                <label for="nome">NOME COMPLETO</label>
                <div class="input-container">
                    <input type="text" id="nomeCompleto" name="nomeCompleto" placeholder="Digite seu nome completo" required autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <div class="input-container">
                    <input type="text" id="cpf" name="cpf" placeholder="Digite seu CPF" maxlength="14" required autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <label for="email">EMAIL</label>
                <div class="input-container">
                    <input type="email" id="email" name="email" placeholder="Digite seu email" required autocomplete="off">
                </div>
            </div>

            <!-- Telefone -->
            <div class="form-group">
                <label for="telefone">TELEFONE</label>
                <div class="input-container">
                    <input type="tel" id="telefone" name="telefone" placeholder="Digite seu telefone" maxlength="15" required autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <label for="senha">SENHA</label>
                <div class="input-container">
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" 
                        required
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&.\-_#]).{8,}"
                        title="A senha deve ter no mínimo 8 caracteres, conter pelo menos uma letra maiúscula, uma minúscula, um número e um caractere especial."
                    >
                    <i class="fa-regular fa-eye toggle-password" id="btn-toggle-senha" title="Mostrar/Ocultar Senha"></i>
                </div>
            </div>

            <div class="form-group">
                <label for="confirma_senha">CONFIRME SUA SENHA</label>
                <div class="input-container">
                    <input type="password" id="confirma_senha" name="confirma_senha" placeholder="Confirme sua senha" required>
                    <i class="fa-regular fa-eye toggle-password" id="btn-toggle-confirma" title="Mostrar/Ocultar Senha"></i>
                </div>
            </div>

            <p class="login-register-text">
                Já possui cadastro? <a href="login.php">Clique aqui!</a>
            </p>

            <button type="submit" class="btn-login-submit">CADASTRAR</button>

            <p class="login-register-text">
                Voltar ao <a href="index.php">início!</a>
            </p>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        function exibirErro(mensagem) {
                const erroDiv = document.getElementById('erro-mensagem');
                erroDiv.innerHTML = mensagem;
                erroDiv.style.display = 'block';
        }

        function ocultarErro() {
            const erroDiv = document.getElementById('erro-mensagem');
            erroDiv.style.display = 'none';
            erroDiv.innerHTML = '';
        }
        
        // Alternar visualização da senha
        function setupPasswordToggle(btnId, inputId) {
            const btn = document.getElementById(btnId);
            const input = document.getElementById(inputId);

            btn.addEventListener('click', function () {
                const isPassword = input.getAttribute('type') === 'password';
                input.setAttribute('type', isPassword ? 'text' : 'password');
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }

        setupPasswordToggle('btn-toggle-senha', 'senha');
        setupPasswordToggle('btn-toggle-confirma', 'confirma_senha');

        // Máscara CPF
        const cpfInput = document.getElementById('cpf');
        cpfInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            e.target.value = value;
        });

        // Máscara Telefone
        const telInput = document.getElementById('telefone');
        telInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);
            value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
            e.target.value = value;
        });

        // --- VALIDAÇÃO DA SENHA NO FORMULÁRIO ---
        const form = document.querySelector('form');
        const senhaInput = document.getElementById('senha');
        const confirmaSenhaInput = document.getElementById('confirma_senha');

        form.addEventListener('submit', function (e) {
            const senha = senhaInput.value;
            const confirmaSenha = confirmaSenhaInput.value;

            // Expressão regular (Regex) para os requisitos:
            // - Pelo menos 8 caracteres
            // - Pelo menos 1 letra maiúscula (?=.*[A-Z])
            // - Pelo menos 1 letra minúscula (?=.*[a-z])
            // - Pelo menos 1 número (?=.*\d)
            // - Pelo menos 1 caractere especial (?=.*[@$!%*?&. \-_#])
            const regexSenha = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.\-_#])[A-Za-z\d@$!%*?&.\-_#]{8,}$/;

            if (!regexSenha.test(senha)) {
                e.preventDefault(); // Impede o envio do formulário
                alert('A senha deve conter no mínimo 8 caracteres, incluindo ao menos uma letra maiúscula, uma minúscula, um número e um caractere especial (!@#$%^&* etc).');
                senhaInput.focus();
                return;
            }

            if (senha !== confirmaSenha) {
                e.preventDefault(); // Impede o envio do formulário
                alert('As senhas não coincidem. Por favor, verifique.');
                confirmaSenhaInput.focus();
                return;
            }
        });
    });
</script>
</body>
</html>