<!-- <?php

// Inicie a sessão ANTES de qualquer saída
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificando se está logado
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}
$id = $_SESSION['id'];
$plano = $_SESSION['planoUsuario'];

?>

Só uma página para encher, não precisa contar nada muito importante -->

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>
    <?php include '../menu.php'; ?>
    <?php include '../rodape.php'; ?>
</body>
</html>