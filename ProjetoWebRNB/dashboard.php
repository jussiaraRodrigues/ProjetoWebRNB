<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

echo "Bem-vindo, " . $_SESSION['nome'] . "!";
echo "<br><a href='logout.php'>Sair</a>";
?>
