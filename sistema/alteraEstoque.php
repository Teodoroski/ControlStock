<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

$idUsuario = (int)$_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar/Entrada Estoque - controlStoke</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <?php include 'menu.php'; ?>

    <main class="page-container">
        
        <div class="form-card" style="max-width: 580px;">
            
            <div class="card-header-title">
                <a href="exibirEstoque.php" class="btn-back" title="Voltar ao Estoque">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
                <h2>ALTERAR/ENTRADA ESTOQUE</h2>
            </div>

            <form action="processa_movimentacao.php" method="POST" class="product-form" id="form-altera-estoque">
                
                <!-- Campos Bloqueados (Não Editáveis) - Lado a Lado -->
                <div class="form-row-2col">
                    <div class="form-group">
                        <label for="nome_produto">NOME PRODUTO</label>
                        <input type="text" id="nome_produto" name="nome_produto" value="PRODUTO1" readonly>
                    </div>

                    <div class="form-group">
                        <label for="codigo_barras">CÓDIGO BARRAS</label>
                        <input type="text" id="codigo_barras" name="codigo_barras" value="7891234567890" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="estoque_atual">ESTOQUE ATUAL</label>
                    <input type="text" id="estoque_atual" name="estoque_atual" value="250" readonly>
                </div>

                <hr class="form-divider">

                <!-- Campos Editáveis (Abaixo da Linha) -->
                <div class="form-group">
                    <label for="tipo_opcao">ESCOLHA UM OPÇÃO</label>
                    <select id="tipo_opcao" name="tipo_opcao" required>
                        <option value="" disabled selected>NENHUMA OPÇÃO SELECIONA</option>
                        <option value="adicionar">ADICIONAR</option>
                        <option value="retirada">RETIRADA</option>
                        <option value="ajustar">AJUSTAR</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="atualizar_estoque">ATUALIZAR ESTOQUE</label>
                    <input type="number" id="atualizar_estoque" name="atualizar_estoque" value="0" min="0" required>
                </div>

                <button type="submit" class="btn-save">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span>SALVAR</span>
                </button>
            </form>
        </div>

    </main>

    <footer class="footer">
        <p>© <?php echo date('Y'); ?> controlStoke — Sistema de Controle de Estoque[cite: 2]</p>
        <p><a href="politica.php">Política de Privacidade</a></p>
    </footer>

</body>
</html>