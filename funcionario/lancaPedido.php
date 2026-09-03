<!-- <?php

// Verificando se está logado
session_start();
if (isset($_SESSION['id'])) {
    $id_sessao = $_SESSION["id"];
} else {
    header("Location: ../login.php");
    exit(); // Adicionado para garantir que o script pare de executar após o redirecionamento
}

?>

cria um form para lançamento de pedidos, possibilitanto incluir produtos e quantidades -->

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lançar Pedidos</title>
</head>

<body>
    <?php include '../menu.php'; ?>
    <?php include '../rodape.php'; ?>
</body>
</html>