
<?php
session_start();

// Verifica se o usuário está conectado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: ../login.php");
    exit();
}

// Aceita somente o envio do formulário por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: cadastrarCategoria.php");
    exit();
}

// Recupera o ID do usuário da sessão
$idUsuario = (int) $_SESSION['idUsuario'];

// Recebe e limpa o nome enviado pelo formulário
$nomeCategoria = trim($_POST['nome_categoria'] ?? '');

// Valida o nome.
if ($nomeCategoria === '' || mb_strlen($nomeCategoria) > 500) {
    header("Location: cadastrarCategoria.php?status=nome_invalido");
    exit();
}

// Inclui a conexão com o banco
require_once '../conecta/conecta.php';

// Prepara o comando SQL.
$sql = "INSERT INTO tb_categoria (nomeCategoria, idUsuario)
        VALUES (?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: cadastrarCategoria.php?status=erro");
    exit();
}

//  Informa os valores dos parâmetros
$stmt->bind_param("si", $nomeCategoria, $idUsuario);

// 9. Executa o cadastro
if ($stmt->execute()) {
    $stmt->close();
    $conn->close();

    header("Location: cadastrarCategoria.php?status=sucesso");
    exit();
}

// Se o cadastro falhar, ira informa o erro pela URL
$stmt->close();
$conn->close();

header("Location: cadastrarCategoria.php?status=erro");
exit();
