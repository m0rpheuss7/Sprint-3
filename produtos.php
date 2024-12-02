<?php include('valida_sessao.php'); ?>
<?php include('conexao.php'); ?>

<?php
// Obter lista de produtos disponíveis
$produtos = $conn->query("SELECT * FROM produtos WHERE concluido = 0");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produtos Disponíveis</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<header class="header">
    <div class="logo">
        <h1>Hidratec</h1>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href="home.php">Início</a></li>
            <li><a href="carrinho.php">Meu Carrinho</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>
</header>

<div class="container1">
    <h2>Produtos Disponíveis</h2>
    <table>
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Ação</th>
        </tr>
        <?php while ($produto = $produtos->fetch_assoc()): ?>
        <tr>
            <td>
                <!-- Exibe a imagem do produto -->
                <?php if ($produto['imagem']): ?>
                    <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>" width="100">
                <?php else: ?>
                    <img src="imagens/default.jpg" alt="Imagem padrão" width="100"> <!-- Imagem padrão caso não tenha uma imagem definida -->
                <?php endif; ?>
            </td>
            <td><?php echo $produto['nome']; ?></td>
            <td><?php echo $produto['descricao']; ?></td>
            <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
            <td>
                <a href="carrinho.php?add_id=<?php echo $produto['id']; ?>">Adicionar ao Carrinho</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>

