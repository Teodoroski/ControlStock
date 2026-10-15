<?php
session_start();

if (!isset($_SESSION['idUsuario'])) {
    header("Location: ../login.php");
    exit();
}

$idUsuario = (int)$_SESSION['idUsuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações - controlStoke</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
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

        <div class="settings-grid">
            
            <!-- COLUNA 1: DADOS DA CONTA -->
            <div class="settings-card">
                <div class="settings-card-title">
                    <i class="fa-regular fa-user"></i>
                    <span>DADOS DA CONTA</span>
                </div>

                <form action="processa_dados_conta.php" method="POST" class="product-form">
                    
                    <div class="form-group">
                        <label for="nome_completo">Nome Completo</label>
                        <div class="input-icon-wrapper">
                            <i class="fa-regular fa-user input-icon"></i>
                            <input type="text" id="nome_completo" name="nome_completo" value="Gabrieli Gonaçalve Barbosa" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <div class="input-icon-wrapper">
                            <i class="fa-regular fa-id-card input-icon"></i>
                            <input type="text" id="cpf" name="cpf" value="000.000.000-00" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <div class="input-icon-wrapper">
                            <i class="fa-regular fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email" value="gabrieli@gmail.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-phone input-icon"></i>
                            <input type="text" id="telefone" name="telefone" value="(00) 00000-0000" required>
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
                        <span>DADOS DA CONTA</span>
                    </div>

                    <form action="processa_altera_senha.php" method="POST" class="product-form">
                        
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
        // Função para mostrar/ocultar senha
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

        // Modal Excluir Conta
        const modalDeleteAccount = document.getElementById('modal-excluir-conta');

        function openDeleteAccountModal() {
            modalDeleteAccount.classList.add('active');
        }

        function closeDeleteAccountModal() {
            modalDeleteAccount.classList.remove('active');
        }

        function confirmDeleteAccount() {
            alert('Sua conta foi excluída com sucesso.');
            window.location.href = 'login.php';
        }

        modalDeleteAccount.addEventListener('click', function(e) {
            if (e.target === modalDeleteAccount) closeDeleteAccountModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modalDeleteAccount.classList.contains('active')) closeDeleteAccountModal();
        });
    </script>
</body>
</html>