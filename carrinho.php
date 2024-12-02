<?php
include 'conexao.php'; // Conexão com o banco de dados

// Consulta para buscar os contratos e os produtos relacionados, incluindo o preço
$sql = "SELECT 
            contratos.id AS contrato_id,
            produtos.nome AS produto_nome,
            contratos.quantidade,
            contratos.data_contrato,
            contratos.cliente_nome,
            contratos.cliente_email,
            contratos.observacoes,
            produtos.preco
        FROM contratos
        JOIN produtos ON contratos.produto_id = produtos.id";

$result = $conn->query($sql);

// Inicializar a variável para o valor total
$total = 0;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header">
    <div class="logo">
        <h1>HidratecShop</h1>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href=".php">Início</a></li>
            <li><a href="produtos.php">Produtos</a></li>
            <li><a href="contrato.php">Contrato de serviços</a></li>
            <li><a href="login.php">Sair</a></li>
            <li><a href="carrinho.php"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
</svg></li></a>
        </ul>
    </nav>
</header>
    <h1>Carrinho</h1>
    <h2>Listagem de Contratos</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Data</th>
                <th>Cliente</th>
                <th>E-mail</th>
                <th>Observações</th>
                <th>Preço Unitário</th>
                <th>Valor Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Calcular o valor total do contrato
                    $valor_total = $row['preco'] * $row['quantidade'];
                    $total += $valor_total;  // Acumular o valor total

                    echo "<tr>
                            <td>{$row['contrato_id']}</td>
                            <td>{$row['produto_nome']}</td>
                            <td>{$row['quantidade']}</td>
                            <td>{$row['data_contrato']}</td>
                            <td>{$row['cliente_nome']}</td>
                            <td>{$row['cliente_email']}</td>
                            <td>{$row['observacoes']}</td>
                            <td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>
                            <td>R$ " . number_format($valor_total, 2, ',', '.') . "</td>
                            <td>
                                <a href='contrato.php?edit_id={$row['contrato_id']}'>Editar</a>
                                <a href='contrato.php?delete_id={$row['contrato_id']}' onclick=\"return confirm('Tem certeza que deseja excluir?')\">Excluir</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='10'>Nenhum contrato encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Exibir o valor total -->
    <h3>Total do Carrinho: R$ <?php echo number_format($total, 2, ',', '.'); ?></h3>

    <!-- Botão para finalizar a compra -->
    <a href="finalizar_compra.php" class="btn-finalizar">Finalizar Compra</a>

    <br><br>
    <a href="contrato.php">Adicionar mais contratos</a>
</body>
</html>
