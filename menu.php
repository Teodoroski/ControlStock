<!-- desenvolver o menu onde será possível acessar outras páginas aqui, depois somente dar 
um include.php nas de mais páginas. O css do menu pode ser aqui dentro, mas cuidado pq pode não funcionar quando der o include nas de mais paginas! -->

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    </head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png">
            <a href="funcionario/home.php">ControlStoke</a>
        </div>

        <nav>
            <ul>
            <li><a href="funcionario/home.php">Home</a></li>
            <li><a href="funcionario/cadastroProduto.php">Cadastro Produtos</a></li>
            <li><a href="funcionario/exibirEstoque.php">Controle Estoque</a></li>
            <li><a href="funcionario/alteraProduto.php">Alterar Cadastro Produtos</a></li>
            <li><a href="funcionario/excluirProduto.php">Excluir Produtos</a></li>
            <li><a href="funcionario/entradaEstoque.php">Entrada Estoque</a></li>
            <li><a href="funcionario/lancaPedido.php">Lançar Pedidos</a></li>
            <li><a href="funcionario/statusPedido.php">Status Pedidos</a></li>
            <li><a href="funcionario/configuracao.php">Configuração</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>