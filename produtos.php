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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header">
    <div class="logo">
        <h1>Hidratec</h1>
    </div>
    <nav class="navigation">
    <ul>
            <li><a href="home.php">Início</a></li>
            <li><a href="produtos.php">Produtos</a></li>
            <li><a href="contrato.php">Contrato de serviços</a></li>
            <li><a href="login.php">Sair</a></li>
            <li><a href="carrinho.php"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
</svg></li></a>
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
                <a href="contrato.php?add_id=<?php echo $produto['id']; ?>">Adicionar ao Carrinho</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>

