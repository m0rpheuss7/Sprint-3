<?php include('valida_sessao.php'); ?>
<?php include('conexao.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $imagem = '';

    // Verificar se o arquivo de imagem foi enviado
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        // Diretório onde as imagens serão salvas
        $diretorio = 'imagens/';
        
        // Criar o diretório caso não exista
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagem = $diretorio . uniqid() . '.' . $extensao;

        // Mover o arquivo para o diretório
        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem)) {
            $mensagem = "Erro ao enviar a imagem.";
        }
    } else {
        // Caso seja edição e nenhuma nova imagem tenha sido enviada
        if ($id) {
            $imagem = $_POST['imagem_atual'] ?? '';
        }
    }

    if ($id) {
        $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco='$preco', imagem='$imagem' WHERE id='$id'";
        $mensagem = "Produto atualizado com sucesso!";
    } else {
        $sql = "INSERT INTO produtos (nome, descricao, preco, imagem) VALUES ('$nome', '$descricao', '$preco', '$imagem')";
        $mensagem = "Produto cadastrado com sucesso!";
    }

    if ($conn->query($sql) !== TRUE) {
        $mensagem = "Erro: " . $conn->error;
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM produtos WHERE id='$delete_id'";
    if ($conn->query($sql) === TRUE) {
        $mensagem = "Produto excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir produto: " . $conn->error;
    }
}

$produtos = $conn->query("SELECT * FROM produtos");

$produto = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $produto = $conn->query("SELECT * FROM produtos WHERE id='$edit_id'")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<header class="header">
    <div class="logo">
        <h1>Hidratec</h1>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="cadastro_fornecedor.php">Cadastro de Fornecedores</a></li>
            <li><a href="cadastro_produto.php">Cadastro de Produtos</a></li>
            <li><a href="listagem_produtos.php">Lista de Produtos</a></li>
            <li><a href="mes.php">Destaques do Mês</a></li>
            <li><a href="login.php">Sair</a></li>
        </ul>
    </nav>
</header>
<div class="container1">
    <h2>Cadastro de Produtos</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $produto['id'] ?? ''; ?>">
        <input type="hidden" name="imagem_atual" value="<?php echo $produto['imagem'] ?? ''; ?>">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo $produto['nome'] ?? ''; ?>" required>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required><?php echo $produto['descricao'] ?? ''; ?></textarea>

        <label for="preco">Preço:</label>
        <input type="number" step="0.01" name="preco" value="<?php echo $produto['preco'] ?? ''; ?>" required>

        <label for="imagem">Imagem:</label>
        <input type="file" name="imagem" accept="image/*">
        <?php if (!empty($produto['imagem'])): ?>
            <p>Imagem Atual:</p>
            <img src="<?php echo $produto['imagem']; ?>" alt="Imagem do Produto" width="100">
        <?php endif; ?>

        <button type="submit"><?php echo $produto ? 'Atualizar' : 'Cadastrar'; ?></button>
    </form>
    <?php if (isset($mensagem)) echo "<p class='message " . ($conn->error ? "error" : "success") . "'>$mensagem</p>"; ?>

    <h2>Listagem de Produtos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th></th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $produtos->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['descricao']; ?></td>
            <td>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
            <td>
                <?php if ($row['imagem']): ?>
                    <img src="<?php echo $row['imagem']; ?>" alt="Imagem do Produto" width="100">
                <?php else: ?>
                    <p>Sem imagem</p>
                <?php endif; ?>
            </td>
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



