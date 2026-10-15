<?php
session_start();

require_once 'conecta/conecta.php';

if ($conn->connect_error) {
    die('Erro de conexão: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $inputUsuario = trim($_POST['usuario'] ?? '');
    $loginSenha   = $_POST['senha'] ?? '';

    if (empty($inputUsuario) || empty($loginSenha)) {
        header("Location: login.php?erro=campos_vazios");
        exit();
    }

    $cpfLimpo = preg_replace('/[^0-9]/', '', $inputUsuario);

    $sql = "SELECT idUsuario, nomeUsuario, emailUsuario, cpfUsuario, senhaUsuario FROM tb_usuario WHERE emailUsuario = ? OR cpfUsuario = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar consulta: " . $conn->error);
    }

    $stmt->bind_param("ss", $inputUsuario, $cpfLimpo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $senha_hash = $row["senhaUsuario"];

        if (password_verify($loginSenha, $senha_hash)) {
            
            $_SESSION['idUsuario']   = $row["idUsuario"];
            $_SESSION['nomeUsuario'] = $row["nomeUsuario"];
            $_SESSION['emailUsuario']= $row["emailUsuario"];
            $_SESSION['cpfUsuario']  = $row["cpfUsuario"];

            $stmt->close();
            $conn->close();

            header("Location: sistema/home.php");
            exit();

        } else {
            // Senha incorreta
            $stmt->close();
            $conn->close();

            header("Location: login.php?erro=dados_invalidos");
            exit();
        }
    } else {
        // Usuário não encontrado
        $stmt->close();
        $conn->close();

        header("Location: login.php?erro=dados_invalidos");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>