<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto - controlStoke</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <?php include 'menu.php'; ?>

    <main class="page-container">
        
        <div class="form-card">
            <h2>CADASTRAR PRODUTO</h2>

            <form action="processa_produto.php" method="POST" class="product-form" id="form-cadastrar-produto">
                
                <!-- Nome do Produto -->
                <div class="form-group">
                    <label for="nome_produto">NOME PRODUTO</label>
                    <input type="text" id="nome_produto" name="nome_produto" required autocomplete="off">
                </div>

                <!-- Código de Barras (Max 10) -->
                <div class="form-group">
                    <label for="codigo_barras">CÓDIGO BARRAS (MAX: 10 CARACTERES)</label>
                    <input type="text" id="codigo_barras" name="codigo_barras" maxlength="10" required autocomplete="off">
                </div>

                <!-- Quantidade Inicial -->
                <div class="form-group">
                    <label for="quantidade_inicial">QUANTIDADE INICIAL</label>
                    <input type="number" id="quantidade_inicial" name="quantidade_inicial" min="0" required>
                </div>

                <!-- Preço -->
                <div class="form-group">
                    <label for="preco">PREÇO</label>
                    <input type="text" id="preco" name="preco" placeholder="R$ 0,00" required>
                </div>

                <!-- Estoque Mínimo -->
                <div class="form-group">
                    <label for="estoque_minimo">ESTOQUE MÍNIMO</label>
                    <input type="number" id="estoque_minimo" name="estoque_minimo" min="0" required>
                </div>

                <!-- Categoria -->
                <div class="form-group">
                    <label for="categoria">CATEGORIA</label>
                    <select id="categoria" name="categoria" required>
                        <option value="" disabled selected>NENHUMA OPÇÃO SELECIONADA</option>
                        <option value="eletronicos">ELETRÔNICOS</option>
                        <option value="informatica">INFORMÁTICA</option>
                        <option value="acessorios">ACESSÓRIOS</option>
                    </select>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const precoInput = document.getElementById('preco');

            precoInput.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, '');
                value = (value / 100).toFixed(2) + '';
                value = value.replace(".", ",");
                value = value.replace(/(\d)(\d{3})(,\d{2})$/, "$1.$2$3");
                e.target.value = value ? 'R$ ' + value : '';
            });
        });
    </script>
</body>
</html>