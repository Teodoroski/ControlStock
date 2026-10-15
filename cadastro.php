<?php
$mensagem = '';
$tipoMensagem = '';

if (isset($_GET['erro'])) {
    $tipoMensagem = 'erro';
    switch ($_GET['erro']) {
        case 'campos_vazios':
            $mensagem = 'Por favor, preencha todos os campos obrigatórios.';
            break;
        case 'senhas_diferentes':
            $mensagem = 'As senhas informadas não coincidem.';
            break;
        case 'email_invalido':
            $mensagem = 'O e-mail informado é inválido.';
            break;
        case 'cpf_invalido':
            $mensagem = 'O CPF informado deve conter 11 dígitos.';
            break;
        case 'usuario_existente':
            $mensagem = 'E-mail ou CPF já cadastrados em nosso sistema.';
            break;
        case 'cadastro_falhou':
            $mensagem = 'Ocorreu um erro ao realizar o cadastro. Tente novamente.';
            break;
        default:
            $mensagem = 'Erro inesperado ao processar o cadastro.';
            break;
    }
} elseif (isset($_GET['sucesso'])) {
    $tipoMensagem = 'sucesso';
    if ($_GET['sucesso'] === 'cadastrado') {
        $mensagem = 'Cadastro realizado com sucesso! Você já pode fazer login.';
    }
}
?>
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

        <!-- Bloco para Exibição das Mensagens do PHP -->
        <?php if (!empty($mensagem)): ?>
            <div class="alert-box <?php echo $tipoMensagem; ?>">
                <i class="fa-solid <?php echo $tipoMensagem === 'erro' ? 'fa-triangle-exclamation' : 'fa-circle-check'; ?>"></i>
                <span><?php echo htmlspecialchars($mensagem); ?></span>
            </div>
        <?php endif; ?>

        <form action="cadastraUsuario.php" method="POST">
            
            <div class="form-group">
                <label for="nomeCompleto">NOME COMPLETO</label>
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
        
        // Alternar visualização da senha
        function setupPasswordToggle(btnId, inputId) {
            const btn = document.getElementById(btnId);
            const input = document.getElementById(inputId);

            if (btn && input) {
                btn.addEventListener('click', function () {
                    const isPassword = input.getAttribute('type') === 'password';
                    input.setAttribute('type', isPassword ? 'text' : 'password');
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            }
        }

        setupPasswordToggle('btn-toggle-senha', 'senha');
        setupPasswordToggle('btn-toggle-confirma', 'confirma_senha');

        // Máscara CPF
        const cpfInput = document.getElementById('cpf');
        if (cpfInput) {
            cpfInput.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 11) value = value.slice(0, 11);
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = value;
            });
        }

        // Máscara Telefone
        const telInput = document.getElementById('telefone');
        if (telInput) {
            telInput.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 11) value = value.slice(0, 11);
                value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
                value = value.replace(/(\d{5})(\d)/, '$1-$2');
                e.target.value = value;
            });
        }

        // Validação da Senha antes do envio no Frontend
        const form = document.querySelector('form');
        const senhaInput = document.getElementById('senha');
        const confirmaSenhaInput = document.getElementById('confirma_senha');

        if (form) {
            form.addEventListener('submit', function (e) {
                const senha = senhaInput.value;
                const confirmaSenha = confirmaSenhaInput.value;

                const regexSenha = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.\-_#])[A-Za-z\d@$!%*?&.\-_#]{8,}$/;

                if (!regexSenha.test(senha)) {
                    e.preventDefault();
                    alert('A senha deve conter no mínimo 8 caracteres, incluindo ao menos uma letra maiúscula, uma minúscula, um número e um caractere especial (!@#$%^&* etc).');
                    senhaInput.focus();
                    return;
                }

                if (senha !== confirmaSenha) {
                    e.preventDefault();
                    alert('As senhas não coincidem. Por favor, verifique.');
                    confirmaSenhaInput.focus();
                    return;
                }
            });
        }
    });
    </script>
</body>
</html>