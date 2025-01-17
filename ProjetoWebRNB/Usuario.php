<?php
session_start();

include_once 'db_config.php';

// Conexão com o banco de dados
$database = new Database();
$conn = $database->getConnection();

// Verifica se o formulário foi enviado para criar ou atualizar um usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $sexo = $_POST['sexo'];
    $data_nasc = $_POST['data_nasc'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];
    $senha = isset($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : '';

    if ($id) {
        // Atualiza o usuário existente
        $query = "UPDATE usuario SET nome = :nome, email = :email, telefone = :telefone, sexo = :sexo, data_nasc = :data_nasc, cidade = :cidade, estado = :estado, endereco = :endereco" . ($senha ? ", senha = :senha" : "") . " WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
    } else {
        // Cria um novo usuário
        $query = "INSERT INTO usuario (nome, email, telefone, sexo, data_nasc, cidade, estado, endereco, senha) VALUES (:nome, :email, :telefone, :sexo, :data_nasc, :cidade, :estado, :endereco, :senha)";
        $stmt = $conn->prepare($query);
    }

    // Vincula os parâmetros comuns
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':data_nasc', $data_nasc);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':endereco', $endereco);
    if ($senha) {
        $stmt->bindParam(':senha', $senha);
    }

    if ($stmt->execute()) {
        $mensagem = $id ? "Usuário atualizado com sucesso!" : "Usuário criado com sucesso!";
    } else {
        $mensagem = "Erro ao salvar o usuário.";
    }
}

// Verifica se há uma solicitação para excluir um usuário
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM usuario WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $mensagem = "Usuário excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir o usuário.";
    }
}

// Busca todos os usuários para exibição
$query = "SELECT * FROM usuario";
$stmt = $conn->prepare($query);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica se há uma solicitação para editar um usuário
$usuario_atual = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "SELECT * FROM usuario WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $usuario_atual = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
</head>
<body>
    <h2>Gerenciamento de Usuários</h2>

    <?php if (isset($mensagem)): ?>
        <p style="color: green;"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <!-- Formulário para criar/atualizar usuário -->
    <form action="usuario.php" method="POST">
        <input type="hidden" name="id" value="<?php echo isset($usuario_atual['id']) ? $usuario_atual['id'] : ''; ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo isset($usuario_atual['nome']) ? $usuario_atual['nome'] : ''; ?>" required>
        <br>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($usuario_atual['email']) ? $usuario_atual['email'] : ''; ?>" required>
        <br>
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" value="<?php echo isset($usuario_atual['telefone']) ? $usuario_atual['telefone'] : ''; ?>">
        <br>
        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="M" <?php echo isset($usuario_atual['sexo']) && $usuario_atual['sexo'] == 'M' ? 'selected' : ''; ?>>Masculino</option>
            <option value="F" <?php echo isset($usuario_atual['sexo']) && $usuario_atual['sexo'] == 'F' ? 'selected' : ''; ?>>Feminino</option>
            <option value="Outro" <?php echo isset($usuario_atual['sexo']) && $usuario_atual['sexo'] == 'Outro' ? 'selected' : ''; ?>>Outro</option>
        </select>
        <br>
        <label for="data_nasc">Data de Nascimento:</label>
        <input type="date" id="data_nasc" name="data_nasc" value="<?php echo isset($usuario_atual['data_nasc']) ? $usuario_atual['data_nasc'] : ''; ?>">
        <br>
        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" value="<?php echo isset($usuario_atual['cidade']) ? $usuario_atual['cidade'] : ''; ?>">
        <br>
        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" value="<?php echo isset($usuario_atual['estado']) ? $usuario_atual['estado'] : ''; ?>">
        <br>
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?php echo isset($usuario_atual['endereco']) ? $usuario_atual['endereco'] : ''; ?>">
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha">
        <small>Deixe em branco para não alterar a senha</small>
        <br>
        <button type="submit"><?php echo isset($usuario_atual) ? 'Atualizar' : 'Criar'; ?> Usuário</button>
    </form>

    <h2>Lista de Usuários</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Sexo</th>
            <th>Data de Nascimento</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Endereço</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><?php echo $usuario['nome']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
            <td><?php echo $usuario['telefone']; ?></td>
            <td><?php echo $usuario['sexo']; ?></td>
            <td><?php echo $usuario['data_nasc']; ?></td>
            <td><?php echo $usuario['cidade']; ?></td>
            <td><?php echo $usuario['estado']; ?></td>
            <td><?php echo $usuario['endereco']; ?></td>
            <td>
                <a href="usuario.php?edit=<?php echo $usuario['id']; ?>">Editar</a>
                <a href="usuario.php?delete=<?php echo $usuario['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
