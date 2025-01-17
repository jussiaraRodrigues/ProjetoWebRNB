<?php
session_start();

include_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $database = new Database();
    $conn = $database->getConnection();

    // Busca o login pelo nome de usuário
    $query = "SELECT * FROM login WHERE usuario = :usuario";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $login = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($login && password_verify($senha, $login['senha'])) {
        // Login bem-sucedido, armazena as informações na sessão
        $_SESSION['usuario_id'] = $login['usuario_id'];
        header("Location: dashboard.php");
        exit();
    } else {
        $mensagem = "Usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php if (isset($mensagem)): ?>
        <p style="color: red;"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
