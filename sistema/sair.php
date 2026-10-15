
<?php
session_start();

// Limpa os dados da sessão
$_SESSION = [];

// Encerra a sessão
session_destroy();

// Redireciona para a página inicial
header("Location: ../index.php");
exit();
?>
