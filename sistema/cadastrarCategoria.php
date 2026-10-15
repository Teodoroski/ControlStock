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
    <title>Cadastrar Categoria - controlStoke</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <?php include 'menu.php'; ?>

    <main class="page-container" style="display: block;">
        
        <div class="form-card" style="max-width: 520px; margin: 0 auto;">
            <h2>CADASTRAR CATEGORIAS</h2>

            <form action="processa_categoria.php" method="POST" class="product-form" id="form-cadastrar-categoria">
                <div class="form-group">
                    <label for="nome_categoria">CATEGORIA</label>
                    <input type="text" id="nome_categoria" name="nome_categoria" required autocomplete="off">
                </div>

                <button type="submit" class="btn-save">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span>SALVAR</span>
                </button>
            </form>
        </div>

        <div class="categories-list-container">
            <h3 class="categories-title">CATEGORIAS</h3>
            <div class="divider" style="margin-bottom: 15px;"></div>

            <div class="categories-table-card">
                <table class="categories-table">
                    <thead>
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>CATEGORIA</th>
                            <th style="width: 100px; text-align: center;">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>01</strong></td>
                            <td>BEBIDA C. ALCOOL</td>
                            <td style="text-align: center;">
                                <div class="table-actions" style="justify-content: center;">
                                    <!-- Botão Excluir que abre o Modal de Exclusão -->
                                    <button class="action-icon-btn delete" onclick="openDeleteCategoryModal('BEBIDA C. ALCOOL')" title="Excluir Categoria">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                    <!-- Botão Editar que abre o Modal de Alteração -->
                                    <button class="action-icon-btn edit" onclick="openEditCategoryModal('BEBIDA C. ALCOOL')" title="Editar Categoria">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>02</strong></td>
                            <td>BEBIDA S. ALCOOL</td>
                            <td style="text-align: center;">
                                <div class="table-actions" style="justify-content: center;">
                                    <button class="action-icon-btn delete" onclick="openDeleteCategoryModal('BEBIDA S. ALCOOL')" title="Excluir Categoria">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                    <button class="action-icon-btn edit" onclick="openEditCategoryModal('BEBIDA S. ALCOOL')" title="Editar Categoria">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>03</strong></td>
                            <td>DOCE</td>
                            <td style="text-align: center;">
                                <div class="table-actions" style="justify-content: center;">
                                    <button class="action-icon-btn delete" onclick="openDeleteCategoryModal('DOCE')" title="Excluir Categoria">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                    <button class="action-icon-btn edit" onclick="openEditCategoryModal('DOCE')" title="Editar Categoria">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- MODAL 1: ALTERAR CATEGORIA -->
    <div class="modal-overlay" id="modal-editar-categoria">
        <div class="modal-card-category">
            <button class="modal-close-btn" onclick="closeEditCategoryModal()"><i class="fa-solid fa-xmark"></i></button>
            <h3>ALTERAR CATEGORIA</h3>

            <form action="processa_altera_categoria.php" method="POST" class="product-form">
                <div class="form-group">
                    <label for="nome_atual_cat">NOME ATUAL</label>
                    <input type="text" id="nome_atual_cat" name="nome_atual_cat" value="" readonly>
                </div>

                <hr class="form-divider" style="margin: 15px 0;">

                <div class="form-group">
                    <label for="novo_nome_cat">NOVO NOME</label>
                    <input type="text" id="novo_nome_cat" name="novo_nome_cat" placeholder="BEBIDA COM ALCOOL" required autocomplete="off">
                </div>

                <button type="submit" class="btn-save">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span>SALVAR</span>
                </button>
            </form>
        </div>
    </div>

    <!-- MODAL 2: EXCLUIR CATEGORIA (IMAGEM ENVIADA) -->
    <div class="modal-overlay" id="modal-excluir-categoria">
        <div class="modal-card">
            <button class="modal-close-btn" onclick="closeDeleteCategoryModal()"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="modal-title">EXCLUIR CATEGORIA</h3>
            <p class="modal-text">
                TEM CERTEZA QUE DESEJA EXCLUIR <span id="nome-categoria-excluir">CATEGORIA</span>? 
                <strong>NÃO SERÁ POSSÍVEL RESTAURAR APÓS EXCLUSÃO E TODOS OS PRODUTOS VINCULADOS A ESSA CATEGORIA SERÃO EXCLUÍDOS PERMANENTEMENTE.</strong>
            </p>
            <button class="btn-confirm-delete" onclick="confirmDeleteCategory()">
                <i class="fa-regular fa-trash-can"></i>
                <span>EXCLUIR</span>
            </button>
        </div>
    </div>

    <footer class="footer">
        <p>© <?php echo date('Y'); ?> controlStoke — Sistema de Controle de Estoque[cite: 2]</p>
        <p><a href="politica.php">Política de Privacidade</a></p>
    </footer>

    <script>
        // Elementos Modal Editar
        const modalEdit = document.getElementById('modal-editar-categoria');
        const inputNomeAtual = document.getElementById('nome_atual_cat');
        const inputNovoNome = document.getElementById('novo_nome_cat');

        // Elementos Modal Excluir
        const modalDelete = document.getElementById('modal-excluir-categoria');
        const spanNomeCategoriaExcluir = document.getElementById('nome-categoria-excluir');

        // Funções Modal Editar
        function openEditCategoryModal(nomeCategoria) {
            inputNomeAtual.value = nomeCategoria;
            inputNovoNome.value = nomeCategoria;
            modalEdit.classList.add('active');
        }

        function closeEditCategoryModal() {
            modalEdit.classList.remove('active');
        }

        // Funções Modal Excluir
        function openDeleteCategoryModal(nomeCategoria) {
            spanNomeCategoriaExcluir.textContent = nomeCategoria;
            modalDelete.classList.add('active');
        }

        function closeDeleteCategoryModal() {
            modalDelete.classList.remove('active');
        }

        function confirmDeleteCategory() {
            alert('Ação de exclusão executada com sucesso!');
            closeDeleteCategoryModal();
        }

        // Fechar ao clicar fora do modal
        window.addEventListener('click', function(e) {
            if (e.target === modalEdit) closeEditCategoryModal();
            if (e.target === modalDelete) closeDeleteCategoryModal();
        });

        // Fechar ao pressionar a tecla ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditCategoryModal();
                closeDeleteCategoryModal();
            }
        });
    </script>
</body>
</html>