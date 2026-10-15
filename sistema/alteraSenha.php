<?php
session_start();

if (!isset($_SESSION['idUsuario'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../conecta/conecta.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario     = (int)$_SESSION['idUsuario'];
    $senhaAtual    = $_POST['senha_atual'] ?? '';
    $novaSenha     = $_POST['nova_senha'] ?? '';
    $confirmaSenha = $_POST['confirma_senha'] ?? '';

    if (empty($senhaAtual) || empty($novaSenha) || empty($confirmaSenha)) {
        header("Location: configuracao.php?status=campos_vazios");
        exit();
    }

    if ($novaSenha !== $confirmaSenha) {
        header("Location: configuracao.php?status=senhas_diferentes");
        exit();
    }

    // Regra dos 8 caracteres, maiúscula, minúscula, número e caractere especial
    $padraoSenha = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    if (!preg_match($padraoSenha, $novaSenha)) {
        header("Location: configuracao.php?status=senha_fraca");
        exit();
    }

    $sql = "SELECT senhaUsuario FROM tb_usuario WHERE idUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($usuario = $result->fetch_assoc()) {
        $senhaHashBanco = $usuario['senhaUsuario'];

        // Compara a senha digitada
        $senhaValida = password_verify($senhaAtual, $senhaHashBanco) || ($senhaAtual === $senhaHashBanco);

        if ($senhaValida) {
            $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

            $sqlUpdate = "UPDATE tb_usuario SET senhaUsuario = ? WHERE idUsuario = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $novaSenhaHash, $idUsuario);

            if ($stmtUpdate->execute()) {
                header("Location: configuracao.php?status=senha_alterada");
                exit();
            } else {
                header("Location: configuracao.php?status=erro");
                exit();
            }
        } else {
            header("Location: configuracao.php?status=senha_incorreta");
            exit();
        }
    } else {
        header("Location: ../login.php");
        exit();
    }
} else {
    header("Location: configuracao.php");
    exit();
}
?>