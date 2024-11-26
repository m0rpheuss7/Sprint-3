<?php include('valida_sessao.php'); ?>
<?php include('conexao.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    if ($id) {
        $sql = "UPDATE fornecedores SET nome='$nome', email='$email', telefone='$telefone' WHERE id='$id'";
        $mensagem = "Funcionário atualizado com sucesso!";
    } else {
        $sql = "INSERT INTO fornecedores (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')";
        $mensagem = "Funcionário cadastrado com sucesso!";
    }

    if ($conn->query($sql) !== TRUE) {
        $mensagem = "Erro: " . $conn->error;
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM fornecedores WHERE id='$delete_id'";
    if ($conn->query($sql) === TRUE) {
        $mensagem = "Funcionário excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir funcionário: " . $conn->error;
    }
}

$fornecedores = $conn->query("SELECT * FROM fornecedores");

$fornecedor = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $fornecedor = $conn->query("SELECT * FROM fornecedores WHERE id='$edit_id'")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Fornecedor</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<header class="header">
    <div class="logo">
        <h1>Hidratec</h1>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="cadastro_fornecedor.php">cadastro de funcionários</a></li>
            <li><a href="cadastro_produto.php">cadastro de serviços</a></li>
            <li><a href="listagem_produtos.php">lista de serviços</a></li>
            <li><a href="mes.php">Destaques do Mês</a></li>
            <li><a href="login.php">Sair</a></li>
        </ul>
    </nav>
</header>
    <div class="container1">
        <h2>Cadastro de Funcionário</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $fornecedor['id'] ?? ''; ?>">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo $fornecedor['nome'] ?? ''; ?>" required>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $fornecedor['email'] ?? ''; ?>">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" value="<?php echo $fornecedor['telefone'] ?? ''; ?>">
            <button type="submit"><?php echo $fornecedor ? 'Atualizar' : 'Cadastrar'; ?></button>
        </form>
        <?php if (isset($mensagem)) echo "<p class='message " . ($conn->error ? "error" : "success") . "'>$mensagem</p>"; ?>

        <h2>Listagem de Funcionários</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $fornecedores->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['telefone']; ?></td>
                <td>
                    <a href="?edit_id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
      
    </div>
</body>
</html>
