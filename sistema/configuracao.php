<?php
session_start();

if (!isset($_SESSION['idUsuario'])) {
    header("Location: ../login.php");
    exit();
}

// 1. Conexão com a base de dados
require_once '../conecta/conecta.php'; 

$idUsuario = (int)$_SESSION['idUsuario'];

// 2. Consulta dos dados do utilizador
$sql = "SELECT nomeUsuario, emailUsuario, cpfUsuario, telefoneUsuario FROM tb_usuario WHERE idUsuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();

if ($usuario = $result->fetch_assoc()) {
    $nomeUsuario     = $usuario['nomeUsuario'];
    $emailUsuario    = $usuario['emailUsuario'];
    $cpfUsuario      = $usuario['cpfUsuario'];
    $telefoneUsuario = $usuario['telefoneUsuario'];
} else {
    $nomeUsuario = $emailUsuario = $cpfUsuario = $telefoneUsuario = '';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações - controlStoke</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .alert-container {
            margin-bottom: 20px;
            width: 100%;
        }
        .alert-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 20px;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .alert-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .alert-close-btn {
            background: transparent;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: inherit;
            opacity: 0.7;
            padding: 0 5px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .alert-close-btn:hover {
            opacity: 1;
        }
        /* Cores do Alerta */
        .alert-sucesso {
            background-color: #e6f4ea;
            color: #137333;
            border-left: 5px solid #34a853;
        }
        .alert-erro {
            background-color: #fce8e6;
            color: #c5221f;
            border-left: 5px solid #ea4335;
        }
        .alert-aviso {
            background-color: #fef7e0;
            color: #b06000;
            border-left: 5px solid #fbbc04;
        }
        </style>
</head>
<body>

    <?php include 'menu.php'; ?>

    <main class="page-container" style="display: block;">
        
        <div class="settings-header">
            <i class="fa-solid fa-gear settings-header-icon"></i>
            <div class="settings-header-text">
                <h2>CONFIGURAÇÕES DA CONTA</h2>
                <span>CONFIGURAÇÕES DA CONTA</span>
            </div>
        </div>

       <?php if (isset($_GET['status'])): ?>
            <div class="alert-container" id="box-alerta">
                <?php
                    $status = $_GET['status'];
                    
                    if ($status === 'dados_sucesso') {
                        echo '
                        <div class="alert-custom alert-sucesso">
                            <div class="alert-content">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Dados pessoais atualizados com sucesso!</span>
                            </div>
                            <button type="button" class="alert-close-btn" onclick="document.getElementById(\'box-alerta\').remove()">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>';
                    } elseif ($status === 'senha_alterada') {
                        echo '
                        <div class="alert-custom alert-sucesso">
                            <div class="alert-content">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Sua senha foi alterada com sucesso!</span>
                            </div>
                            <button type="button" class="alert-close-btn" onclick="document.getElementById(\'box-alerta\').remove()">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>';
                    } elseif ($status === 'senha_incorreta') {
                        echo '
                        <div class="alert-custom alert-erro">
                            <div class="alert-content">
                                <i class="fa-solid fa-circle-xmark"></i>
                                <span>A senha atual informada está incorreta.</span>
                            </div>
                            <button type="button" class="alert-close-btn" onclick="document.getElementById(\'box-alerta\').remove()">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>';
                    } elseif ($status === 'senhas_diferentes') {
                        echo '
                        <div class="alert-custom alert-erro">
                            <div class="alert-content">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                <span>A nova senha e a confirmação não coincidem.</span>
                            </div>
                            <button type="button" class="alert-close-btn" onclick="document.getElementById(\'box-alerta\').remove()">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>';
                    } elseif ($status === 'senha_fraca') {
                        echo '
                        <div class="alert-custom alert-aviso">
                            <div class="alert-content">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                <span>A senha deve conter no mínimo 8 caracteres, incluindo letra maiúscula, minúscula, número e caractere especial.</span>
                            </div>
                            <button type="button" class="alert-close-btn" onclick="document.getElementById(\'box-alerta\').remove()">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>';
                    } elseif ($status === 'campos_vazios') {
                        echo '
                        <div class="alert-custom alert-aviso">
                            <div class="alert-content">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                <span>Por favor, preencha todos os campos obrigatórios.</span>
                            </div>
                            <button type="button" class="alert-close-btn" onclick="document.getElementById(\'box-alerta\').remove()">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>';
                    }
                ?>
            </div>
        <?php endif; ?>

        <div class="settings-grid">
            
            <!-- COLUNA 1: DADOS DA CONTA -->
            <div class="settings-card">
                <div class="settings-card-title">
                    <i class="fa-regular fa-user"></i>
                    <span>DADOS DA CONTA</span>
                </div>

                <form action="alteraDados.php" method="POST" id="form-dados-conta" class="product-form">
                    
                    <div class="form-group">
                        <label for="nome_completo">Nome Completo</label>
                        <div class="input-icon-wrapper">
                            <i class="fa-regular fa-user input-icon"></i>
                            <input type="text" id="nome_completo" name="nome_completo" value="<?php echo htmlspecialchars($nomeUsuario); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <div class="input-icon-wrapper">
                            <i class="fa-regular fa-id-card input-icon"></i>
                            <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($cpfUsuario); ?>" maxlength="14" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <div class="input-icon-wrapper">
                            <i class="fa-regular fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($emailUsuario); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-phone input-icon"></i>
                            <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefoneUsuario); ?>" maxlength="15" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-dark-save">SALVAR ALTERAÇÕES</button>

                </form>
            </div>

            <!-- COLUNA 2: ALTERAR SENHA + EXCLUIR CONTA -->
            <div>
                <div class="settings-card">
                    <div class="settings-card-title">
                        <i class="fa-regular fa-user"></i>
                        <span>ALTERAR SENHA</span>
                    </div>

                    <form action="alteraSenha.php" method="POST" class="product-form">
                        
                        <div class="form-group">
                            <label for="senha_atual">Senha atual</label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <input type="password" id="senha_atual" name="senha_atual" placeholder="Digite sua senha atual" required>
                                <i class="fa-regular fa-eye toggle-password" onclick="togglePassword('senha_atual', this)"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nova_senha">Nova senha</label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <input type="password" id="nova_senha" name="nova_senha" placeholder="Digite sua nova senha" required>
                                <i class="fa-regular fa-eye toggle-password" onclick="togglePassword('nova_senha', this)"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirma_senha">Confirme a nova senha</label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <input type="password" id="confirma_senha" name="confirma_senha" placeholder="Confirme sua nova senha" required>
                                <i class="fa-regular fa-eye toggle-password" onclick="togglePassword('confirma_senha', this)"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn-cyan-save">ATUALIZAR SENHA</button>

                    </form>
                </div>

                <!-- CARD: EXCLUIR CONTA -->
                <div class="delete-account-card">
                    <div class="delete-account-header">
                        <div class="delete-account-title">
                            <i class="fa-regular fa-trash-can"></i>
                            <span>EXCLUIR CONTA</span>
                        </div>
                        <button class="btn-outline-delete" onclick="openDeleteAccountModal()">EXCLUIR</button>
                    </div>
                    <p class="delete-account-desc">Essa ação é permanente e remove acesso a conta!</p>
                </div>
            </div>

        </div>

    </main>

    <!-- MODAL DE CONFIRMAÇÃO DE EXCLUSÃO DE CONTA -->
    <div class="modal-overlay" id="modal-excluir-conta">
        <div class="modal-card">
            <button class="modal-close-btn" onclick="closeDeleteAccountModal()"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="modal-title">EXCLUIR CONTA</h3>
            <p class="modal-text">
                TEM CERTEZA QUE DESEJA EXCLUIR SUA CONTA? <strong>TODOS OS DADOS E REGISTROS SERÃO REMOVIDOS PERMANENTEMENTE.</strong>
            </p>
            <button class="btn-confirm-delete" onclick="confirmDeleteAccount()">
                <i class="fa-regular fa-trash-can"></i>
                <span>EXCLUIR CONTA</span>
            </button>
        </div>
    </div>

    <footer class="footer">
        <p>© <?php echo date('Y'); ?> controlStoke — Sistema de Controle de Estoque</p>
        <p><a href="politica.php">Política de Privacidade</a></p>
    </footer>

    <script>
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        const modalDeleteAccount = document.getElementById('modal-excluir-conta');

        function openDeleteAccountModal() {
            modalDeleteAccount.classList.add('active');
        }

        function closeDeleteAccountModal() {
            modalDeleteAccount.classList.remove('active');
        }

        function confirmDeleteAccount() {
            window.location.href = 'excluirConta.php';
        }

        modalDeleteAccount.addEventListener('click', function(e) {
            if (e.target === modalDeleteAccount) closeDeleteAccountModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modalDeleteAccount.classList.contains('active')) closeDeleteAccountModal();
        });

        // Máscara de CPF em JavaScript
        document.addEventListener('DOMContentLoaded', function () {
            const cpfInput = document.getElementById('cpf');
            const formDados = document.getElementById('form-dados-conta');

            function aplicarMascaraCPF(valor) {
                let v = valor.replace(/\D/g, '');
                if (v.length > 11) v = v.slice(0, 11);

                v = v.replace(/(\d{3})(\d)/, '$1.$2');
                v = v.replace(/(\d{3})(\d)/, '$1.$2');
                v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                return v;
            }

            if (cpfInput && cpfInput.value) {
                cpfInput.value = aplicarMascaraCPF(cpfInput.value);
            }

            if (cpfInput) {
                cpfInput.addEventListener('input', function (e) {
                    e.target.value = aplicarMascaraCPF(e.target.value);
                });
            }

            if (formDados) {
                formDados.addEventListener('submit', function () {
                    cpfInput.value = cpfInput.value.replace(/\D/g, '');
                });
            }
        });
    </script>
</body>
</html>