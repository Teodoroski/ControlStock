<?php
session_start();

if (!isset($_SESSION['idUsuario'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../conecta/conecta.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario       = (int)$_SESSION['idUsuario'];
    $nomeCompleto   = trim($_POST['nome_completo']);
    $cpf            = preg_replace('/[^0-9]/', '', $_POST['cpf']); // Limpa pontuação do CPF
    $email          = trim($_POST['email']);
    $telefone       = trim($_POST['telefone']);

    if (!empty($nomeCompleto) && !empty($cpf) && !empty($email) && !empty($telefone)) {
        
        $sql = "UPDATE tb_usuario SET nomeUsuario = ?, emailUsuario = ?, cpfUsuario = ?, telefoneUsuario = ? WHERE idUsuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $nomeCompleto, $email, $cpf, $telefone, $idUsuario);

        if ($stmt->execute()) {
            // REDIRECIONA COM O PARAMETRO DE SUCESSO
            header("Location: configuracao.php?status=dados_sucesso");
            exit();
        } else {
            header("Location: configuracao.php?status=erro");
            exit();
        }
    } else {
        header("Location: configuracao.php?status=campos_vazios");
        exit();
    }
} else {
    header("Location: configuracao.php");
    exit();
}
?>