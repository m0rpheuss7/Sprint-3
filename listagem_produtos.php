<?php include('valida_sessao.php'); ?>
<?php include('conexao.php'); ?>

<?php
if (isset($_GET['concluir_id'])) {
    $concluir_id = $_GET['concluir_id'];
    $sql = "UPDATE produtos SET concluido = NOT concluido WHERE id='$concluir_id'";
    if ($conn->query($sql) === TRUE) {
        $mensagem = "Status do produto atualizado com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar status do serviço: " . $conn->error;
    }
}
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM produtos WHERE id='$delete_id'";
    if ($conn->query($sql) === TRUE) {
        $mensagem = "Serviço excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir serviço: " . $conn->error;
    }
}

$produtos = $conn->query("SELECT p.id, p.nome, p.descricao, p.preco, f.nome AS fornecedor_nome, p.concluido FROM produtos p JOIN fornecedores f ON p.fornecedor_id = f.id");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de serviços</title>
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
    <div class="container">
        <h2>Listagem de Serviços</h2>
        <?php if (isset($mensagem)) echo "<p class='message " . ($conn->error ? "error" : "success") . "'>$mensagem</p>"; ?>
       
        <table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Fornecedor</th>
        <th>Concluído</th>
        <th>Ações</th>
    </tr>
    <?php while ($row = $produtos->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nome']; ?></td>
        <td><?php echo $row['descricao']; ?></td>
        <td><?php echo $row['preco']; ?></td>
        <td><?php echo $row['fornecedor_nome']; ?></td>
        <td>
            <a href="?concluir_id=<?php echo $row['id']; ?>">
                <?php echo $row['concluido'] ? "✅" : "❌"; ?>
            </a>
        </td>
        <td>
            <a href="cadastro_produto.php?edit_id=<?php echo $row['id']; ?>">Editar</a>
            <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
    
    </div>
</body>
</html>