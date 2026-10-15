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
    <title>Alterar Produto - controlStoke</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <?php include 'menu.php'; ?>

    <main class="page-container">
        
        <div class="form-card">
            
            <div class="card-header-title">
                <a href="exibirEstoque.php" class="btn-back" title="Voltar ao Estoque">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
                <h2>ALTERAR PRODUTO</h2>
            </div>

            <form action="processa_alteracao.php" method="POST" class="product-form" id="form-altera-produto">
                
                <!-- Nome do Produto -->
                <div class="form-group">
                    <label for="nome_produto">NOME PRODUTO</label>
                    <input type="text" id="nome_produto" name="nome_produto" value="PRODUTO1" required autocomplete="off">
                </div>

                <!-- Código de Barras (Max 10) -->
                <div class="form-group">
                    <label for="codigo_barras">CÓDIGO BARRAS (MÁX: 10 CARACTERES)</label>
                    <input type="text" id="codigo_barras" name="codigo_barras" value="7891234567890" maxlength="10" required autocomplete="off">
                </div>

                <!-- Categoria -->
                <div class="form-group">
                    <label for="categoria">CATEGORIA</label>
                    <select id="categoria" name="categoria" required>
                        <option value="bebida_alcool" selected>BEBIDA C. ALCOOL</option>
                        <option value="bebida_sem_alcool">BEBIDA S. ALCOOL</option>
                        <option value="doce">DOCE</option>
                        <option value="eletronicos">ELETRÔNICOS</option>
                    </select>
                </div>

                <!-- Preço -->
                <div class="form-group">
                    <label for="preco">PREÇO</label>
                    <input type="text" id="preco" name="preco" value="R$00,00" required>
                </div>

                <!-- Estoque Mínimo -->
                <div class="form-group">
                    <label for="estoque_minimo">ESTOQUE MÍNIMO</label>
                    <input type="text" id="estoque_minimo" name="estoque_minimo" value="R$00,00" required>
                </div>

                <!-- Botão Salvar -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function applyCurrencyMask(input) {
                input.addEventListener('input', function (e) {
                    let value = e.target.value.replace(/\D/g, '');
                    value = (value / 100).toFixed(2) + '';
                    value = value.replace(".", ",");
                    value = value.replace(/(\d)(\d{3})(,\d{2})$/, "$1.$2$3");
                    e.target.value = value ? 'R$' + value : '';
                });
            }

            applyCurrencyMask(document.getElementById('preco'));
            applyCurrencyMask(document.getElementById('estoque_minimo'));
        });
    </script>
</body>
</html>